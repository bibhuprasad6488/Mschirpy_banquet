<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Cuisine;
use Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
     {
    //     $menus = Menu::get();
    //     foreach($menus as $men){
    //         $cusisine_id = Category::where('id',$men->category_id)->select('cuisines_id')->first()->cuisines_id;
    //         $men->where('category_id',$men->category_id)->update(['cuisine_id'=>$cusisine_id]);
    //     }
    //     exit;
        // dd(storage_path('images/items'));
        $datas = Menu::orderBy('id','DESC')->get();
        return view('dashboard.menu.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::with('cuisine')->where('status',1)->get();
        $categories = Category::where('status',1)->get();
        return view('dashboard.menu.create',compact('categories'));
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
        $data['slug'] = $this->slug($data['name']);
        $data['menu_type'] = $request->menu_type;
        $countRec = Menu::where(['name'=>$request->name,'category_id'=>$request->category_id, 'cuisine_id'=>$request->cuisine_id])->first();
        if(empty($countRec)){          
        try
        {
            $saveMenu=new Menu($data);
            $menuSave =  $saveMenu->save();
            if($menuSave){
            $item_id = $saveMenu->id;
        if($request->hasFile('image'))
        {
            $file=$request->file('image');
            $extention=$file->getClientOriginalExtension();
            $filename=time().'.'.$extention;
            $file->move(public_path('/storage/images/items'),$filename);
            $saveMenu->update(['image'=>$filename]);
              
        }
            return redirect()->back()->with('success','Item successfully saved.');
            }
        }
        catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
        }
    }

 else{
        return redirect()->back()->with('error','Record already exist');
      }

  }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */   
    public function edit($id)
    {
        $menu = Menu::find($id);
        $categories = Category::where('status',1)->get();
        // $subcats =Subcategory::where(['category_id'=>$menu->category_id,'status'=>1])->get();
        $cuisines = Category::where('id',$menu->category_id)->first()->cuisines_id;
        return view('dashboard.menu.edit',compact('menu','categories','cuisines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['slug'] = $this->slug($data['name']);
        try
        {
          $menulst = Menu::where('id', $id)->first();
          $menulst->update($data);
          // dd($menulst->image);
           if($request->hasFile('img_file')){
                 $itemsImage = public_path("/storage/images/items/$menulst->image"); // get previous image from folder
                 if (!empty($menulst->image)) {
                    if ($itemsImage) { // unlink or remove previous image from folder
                    unlink($itemsImage);
                    }
                 }
                
            $file=$request->file('img_file');
            $extention=$file->getClientOriginalExtension();
            $filename=time().'.'.$extention;
            $file->move(public_path('/storage/images/items'),$filename);
            $menulst->update(['image'=>$filename]);

            }
            return redirect()->back()->with('success','Item successfully updated.');
         }
        catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $menuFst = Menu::where('id',$id)->first();
       $itemsImage = public_path("/storage/images/items/$menuFst->image"); // get previous image from folder
       if (!empty($menuFst->image)) {
         if ($itemsImage) { // unlink or remove previous image from folder
                    unlink($itemsImage);
                }
            }
        if($menuFst->delete()){
            return redirect()->back()->with('success','Item successfully deleted.');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function slug($category_name)
    {
        $slug=strtolower(str_replace(' ', '-', $category_name));
        $slug=strtolower(str_replace('/', '-', $slug));
        return $slug;
    }

    public function cat_wise_cuisine(Request $request)
    {
        // $subcats = Subcategory::where('category_id',$request->catId)->pluck('subcategory_name','id');
        // if(!empty($subcats)){
        //     return response()->json($subcats);
        // }else{
        //     return response()->json([]);
        // }

        $catData = Category::where('id',$request->catId)->first();
        if(!empty($catData)){
            return $catData->cuisines_id;
        }else{
            return [];
        }
    }


  public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if($sts == 1){
            Menu::where('id',$id)->update(['status'=>2]);
        }else{
            Menu::where('id',$id)->update(['status'=>1]);
        }
        return true;
    }
}
