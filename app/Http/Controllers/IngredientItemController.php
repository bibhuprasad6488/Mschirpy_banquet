<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use App\Models\IngredientItem;
use Illuminate\Http\Request;

use App\Models\IngredientCategory;
use App\Models\Supplier;
use App\Models\SupplierPriceChart;
use App\Models\Department;
use App\Models\Brand;
use App\Models\DepartmentRequest;
use Carbon\Carbon;

use Auth;

class IngredientItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = IngredientItem::with(['ingredient_category','supplier'])->orderBy('id','DESC')->get();
        return view('dashboard.ingredient_item.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = IngredientCategory::where('status','active')->orderBy('id','DESC')->pluck('category_name','id');
        $departments = Department::orderBy('id','DESC')->pluck('department_name','id');
        $brands= Brand::where('status','active')->orderBy('id','DESC')->pluck('brand_name','id');
        // $suppliers = Supplier::where('status','active')->orderBy('id','DESC')->pluck('supplier_name','id');

        return view('dashboard.ingredient_item.create',compact('cats','departments','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['department_id'] = $request->department;
        $data['custom_fields']['default_brand'] = $request->default_brand;
        // $data['custom_fields'] = ['spat'=>$request->spat,'mrp_price'=>$request->mrp_price,'vat_perc'=>$request->vat_perc,'qty'=>$request->qty,'amount'=>$request->amount];
        try
        {
            $save=new IngredientItem($data);
            $save->save();
            return redirect()->back()->with('success','Ingredient Item successfully saved.');
           
        }catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IngredientItem  $ingredientItem
     * @return \Illuminate\Http\Response
     */
    public function show(IngredientItem $ingredientItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IngredientItem  $ingredientItem
     * @return \Illuminate\Http\Response
     */
    public function edit(IngredientItem $ingredientItem)
    {

         $cats = IngredientCategory::where('status','active')->orderBy('id','DESC')->pluck('category_name','id');
         $departments = Department::orderBy('id','DESC')->pluck('department_name','id');
         $brands = Brand::orderBy('id','DESC')->pluck('brand_name','id');
         if(!empty($ingredientItem->department_id)){
          $depArr = $ingredientItem->department_id;
         }else{
          $depArr = [];
         }
         if(!empty($ingredientItem->custom_fields) && array_key_exists('default_brand', $ingredientItem->custom_fields)){
          $def_brnds = Brand::whereIn('id',$ingredientItem->custom_fields['default_brand'])->pluck('brand_name','id');
         }else{
          $def_brnds = [];
         }
        $data['cats'] = $cats;
        $data['ingredientItem'] = $ingredientItem;
        $data['departments'] = $departments;
        $data['brands'] = $brands;
        $data['default_brands'] = $def_brnds;
        $data['depArr'] = $depArr;

        return view('dashboard.ingredient_item.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IngredientItem  $ingredientItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IngredientItem $ingredientItem)
    {
        $data = $request->all();
          $data['department_id'] = $request->department;
          if(!empty($request->default_brand)){
              $arrBrand = $request->default_brand;
          }else{
              $arrBrand = $request->default_brand_earli;
          }
        if(!empty($ingredientItem->custom_fields) && array_key_exists('default_brand',$ingredientItem->custom_fields)){
            $datacustom = $ingredientItem->custom_fields;
            $datacustom['default_brand'] = $arrBrand;
        }else{
            $datacustom['default_brand'] = $arrBrand;
        }
       try
        {
          $ingredientItem->update($data);
          $ingredientItem->update(['custom_fields'=>$datacustom]);
          return redirect()->back()->with('success','Ingredient Item successfully updated.');
         }
        catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IngredientItem  $ingredientItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(IngredientItem $ingredientItem)
    {
         if($ingredientItem->delete()){
            return redirect()->back()->with('success','Ingredient Item deleted.');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function change_dept_brand(Request $request)
    {
       $brands = Brand::whereIn('department_id',$request->dep_id)->get();
       return $brands;
    }

    public function price_chart()
    {
        $ingredientItems = IngredientItem::where('status','active')->orderBy('id','DESC')->get();
        return view('dashboard.ingredient_item.price_chart',['ingredientItems'=>$ingredientItems]);

    }

    public function export_price_chart()
    {
        $ingredientItems = IngredientItem::where('status','active')->orderBy('id','DESC')->get();

    }

    public function price_chart_list($supplier_id)
    {
      $decrypted_id = Crypt::decrypt($supplier_id);
      $supplier_id = $decrypted_id;
      $supplier = Supplier::where('id',$supplier_id)->first();
      $toDate = Carbon::parse($supplier->valid_to);
      $fromDate = Carbon::parse($supplier->valid_from);
      $cats_with_items = DepartmentRequest::whereIn('cat_id', $supplier->cat_id)->with(['department','ingredient_item','ing_cat'])->get();
      $valid_months = $toDate->diffInMonths($fromDate);
      $brands = Brand::where('status','active')->pluck('brand_name','id');
      $qry = SupplierPriceChart::where('supplier_id',$supplier_id);
      $supplierChrtDtls = $qry->get();
      $countprice = $qry->where('is_submit','yes')->get()->count();
      return view('dashboard.supplier.supplier_price_chart',compact('cats_with_items','supplier','brands','valid_months','supplierChrtDtls','countprice'));
    }

    public function save_sipplier_price(Request $request)
    {
      if(!empty($request->item_id)){
        foreach($request->item_id as $k => $v){
          $is_existing_data = SupplierPriceChart::where(['supplier_id'=>$request->supplier_id,'category_id'=>$request->cat_id[$k],'department_id'=>$request->department_id[$k],'item_id'=>$v])->first();
          if(!empty($is_existing_data)){
              $saved_data = $is_existing_data->data;
              if(!empty($request->brand[$v])){
                foreach($request->brand[$v] as $kbr => $valbrnd){
                  if(!empty($valbrnd)){
                    $saved_data[$valbrnd] = number_format($request->supplier_price[$v][$kbr],2);
                  }
                }
              }
               $updateexisting = $is_existing_data->update(['data'=>$saved_data]);
          }else{
            $data = [];
            $cat_id = $request->cat_id[$k];
            $department_id = $request->department_id[$k];
            $item_id = $v;
            $mrp = $request->mrp[$k];
            $qty = $request->qty[$k];
            foreach($request->brand[$v] as $kbr => $valbrnd){
              if($valbrnd != ''){
                $data[$valbrnd] = number_format($request->supplier_price[$v][$kbr],2);
              }  
            }
            if(!empty($data)){
              $dataArray = [
                            'supplier_id' => $request->supplier_id,
                            'category_id' => $cat_id,
                            'department_id' => $department_id,
                            'item_id' => $item_id,
                            'mrp' => $mrp,
                            'qty' => $qty,
                            'data' => $data
                        ];
            $chart = new SupplierPriceChart($dataArray);
            $chart->save();
          } 
          } 
        }
            return redirect()->back()->with('success','Price list updated successfully');
      }
    }

    public function delete_brand_price(Request $request)
    {

      $price_charts = SupplierPriceChart::where(['supplier_id'=>$request->supplier_id,'category_id'=>$request->cat_id,'department_id'=>$request->dep_id,'item_id'=>$request->item_id])->first();
       $data = $price_charts->data;
        foreach ($data as $k => $val) {
            if($k == $request->brnd_id){
                unset($data[$request->brnd_id]);
            } 
        }
        $del = $price_charts->update(['data'=>$data]);
        if(empty($data)){
          $price_charts->delete();
        }
        if($del){
            return "deleted";
        }else{
            return "not";
        }
    }

    public function change_validity(Request $request)
    {
      $updateValidity = Supplier::where('id',$request->supplier_id)->update(['valid_from'=>date('Y-m-d',strtotime($request->valid_from)),'valid_to'=>date('Y-m-d',strtotime($request->valid_to))]);
      if($updateValidity){
        return redirect()->back()->with('success','Validity Updated');
      }else{
        return redirect()->back()->with('error','Something went wrong');
      }
    }

    public function view_history(Request $request)
    {
      $datas = SupplierPriceChart::where(['supplier_id'=>$request->supplier_id])->get();
      $returnData = view('dashboard.supplier.viewsupplier_history')->with('datas',$datas)->render();
      return $returnData;
    }

    public function save_final_price(Request $request)
    {
      $updateprice = SupplierPriceChart::where('supplier_id',$request->supplier_id)->update(['is_submit'=>'yes']);
      if($updateprice){
          return 'delete';
      }else{
        return 'not';
      }
    }

    public function view_sipplier_price(Request $request)
    {
        $price_charts = SupplierPriceChart::where(['supplier_id'=>$request->supplier_id,'category_id'=>$request->cat_id,'item_id'=>$request->item_id])->first();

        $data['supplier_name'] = $this->__find_name($request->supplier_id,'Supplier','supplier_name');
        $data['cat_name'] = $this->__find_name($request->cat_id,'IngredientCategory','category_name');
        $data['item_name'] = $this->__find_name($request->item_id,'IngredientItem','item_name');
        if(!empty($price_charts->data)){
            $data['price_data'] = $price_charts->data;
        }else{
            $data['price_data'] = '';
        }

        return $data;
    }

    public function delete_sipplier_price(Request $request)
    {
        $price_charts = SupplierPriceChart::where(['supplier_id'=>$request->supplier_id,'category_id'=>$request->cat_id,'item_id'=>$request->item_id])->first();
        $data = $price_charts->data;
        foreach ($data as $k => $val) {
            if($k == $request->key){
                unset($data[$request->key]);
            } 
        }
        $del = $price_charts->update(['data'=>$data]);
        if($del){
            return "deleted";
        }else{
            return "not";
        }
        
    }

    private function __find_name($id,$modelname,$fieldname)
    {
        if($modelname == 'Supplier'){
            $obj = Supplier::where('id',$id)->first();
        }elseif($modelname == 'IngredientCategory'){
            $obj = IngredientCategory::where('id',$id)->first();
        }else{
            $obj = IngredientItem::where('id',$id)->first();
        }
        
        $name = $obj->$fieldname;
        return $name;
    }
     public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if($sts == 'active'){
            IngredientItem::where('id',$id)->update(['status'=>'inactive']);
        }else{
            IngredientItem::where('id',$id)->update(['status'=>'active']);
        }
        return true;
    }

    public static function check_existing_data($supplier_id, $cat_id, $item_id)
    {
     return SupplierPriceChart::where(['supplier_id' => $supplier_id, 'category_id'=>$cat_id, 'item_id'=> $item_id])->first();
    }

    public static function find_brand_name($id)
    {
      return Brand::where('id',$id)->first()->brand_name;
    }


 public function item_wise_brand(Request $request)
    {
        $allbrands = Brand::whereIn('id',json_decode($request->brand_ids))->get();
        $returnData = view('dashboard.supplier.show_allbrand')->with('datas',$allbrands)->render();
        return $returnData;
    }

  public function show_department(Request $request)
  {
       $dep_id = $request->department_id;
       if(!empty(json_decode($dep_id))){
          $department = json_decode($dep_id);
       }else{
          $department = [];
       }
       return Department::whereIn('id',$department)->get();
  }
}
