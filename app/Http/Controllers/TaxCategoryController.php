<?php

namespace App\Http\Controllers;

use App\Models\TaxCategory;
use App\Models\TaxSubCategory;
use Illuminate\Http\Request;
use Auth;

class TaxCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $taxes = TaxCategory::orderBy('id','DESC')->get();

        return view('dashboard.tax.index',compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('dashboard.tax.create');
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
        try
        {
            $save=new TaxCategory($data);
            $save->save();
            return redirect()->back()->with('success','TaxCategory successfully saved.');
           
        }catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaxCategory  $taxCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TaxCategory $taxCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaxCategory  $taxCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TaxCategory $taxCategory)
    {

         return view('dashboard.tax.edit',compact('taxCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TaxCategory  $taxCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaxCategory $taxCategory)
    {
         try
        {
          $catUpdate = $taxCategory->update(
            [
                'category_name'=>$request->category_name,
                'status'=>$request->status
            ]
          );
          return redirect()->back()->with('success','Tax successfully updated.');
         }
        catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaxCategory  $taxCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxCategory $taxCategory)
    {
         if($taxCategory->delete()){
            return redirect()->back()->with('success','Tax deleted.');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function create_tax_subcategory()
    {
        $taxcats = TaxCategory::orderBy('id','DESC')->pluck('category_name','id');

            return view('dashboard.tax.create_subcategory',compact('taxcats'));
    }


    public function save_sub_cat(Request $request)
    {
        $data = $request->all();

        $arrdata = [
            'user_id' => Auth::user()->id,
            'category' => $data['category_id'],
            'subcat' => $data['subcategory'],
            'status' => $data['status']
        ];
        try
        {
            $save=new TaxSubCategory($arrdata);
            $save->save();
            return redirect()->back()->with('success','TaxSubcategory successfully saved.');
           
        }catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
        }
    }

 public function list_subcat()
    {
        $subcats = TaxSubCategory::with('taxcat')->orderBy('id','DESC')->get();
         return view('dashboard.tax.subcategory_list',compact('subcats'));
    }


     
    public function edit_subcat($id)
    {
        $subcat = TaxSubCategory::where('id',$id)->first();
        $taxcats = TaxCategory::orderBy('id','DESC')->pluck('category_name','id');

         return view('dashboard.tax.edit_subcategory',compact('subcat','taxcats'));
    }

 public function update_subcat(Request $request)
    {
        $subcat = TaxSubCategory::where('id',$request->hdnid)->first();

        try
        {
          $sub_Update = $subcat->update([
                'user_id' => Auth::user()->id,
                'category'=>$request->category_id,
                'subcat'=>$request->subcategory,
                'status'=>$request->status
            ]
          );
          return redirect()->back()->with('success','Tax Sub Category successfully updated.');
         }
        catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
    }

  public function dlt_subcat(Request $request)
    {
      $subcate = TaxSubcategory::where('id',$request->hdnid)->first();
       if($subcate->delete()){
            return redirect()->back()->with('success','Tax Sub category successfully deleted.');
       }else{
            return redirect()->back()->with('error','Something went wrong');
       }
    }

public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if($sts == 'active'){
            TaxSubcategory::where('id',$id)->update(['status'=>'inactive']);
        }else{
            TaxSubcategory::where('id',$id)->update(['status'=>'active']);
        }
        return true;
    }
}