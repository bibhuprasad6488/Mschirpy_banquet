<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Subcategory;
use Auth;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $datas = Subcategory::with('category.cuisine')->orderBy('id','DESC')->get();
       return view('dashboard.subcategory.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::with('cuisine')->where(['status'=>1])->get();
        return view('dashboard.subcategory.create',compact('categories'));
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
        $data['slug'] = $this->slug($data['subcategory_name']);
        $countRec = Subcategory::where(['category_id'=>$request->category_id, 'subcategory_name'=> $request->subcategory_name])->first();
        if($countRec == null){
           
        try
        {
            $saveSubcat=new Subcategory($data);
            if($saveSubcat->save()){
                return redirect()->back()->with('success','Sub category successfully saved.');
            }
        }catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
        }
      }else{
        
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
        $subcat = Subcategory::find($id);
        $categories = Category::with('cuisine')->where(['status'=>1])->get();
        return view('dashboard.subcategory.edit',compact('subcat','categories'));
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
        $data['slug'] = $this->slug($data['subcategory_name']);
        try
        {
          $subcate = Subcategory::where('id', $id)->first();
           $subcate->update($data);
            return redirect()->back()->with('success','Sub Category successfully updated.');
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
       $subcate = Subcategory::where('id',$id)->first();
       if($subcate->delete()){
            return redirect()->back()->with('success','Sub category successfully deleted.');
       }else{
            return redirect()->back()->with('error','Something went wrong');
       }
    }

    public function slug($name)
    {
        $slug=strtolower(str_replace(' ', '-', $name));
        $slug=strtolower(str_replace('/', '-', $slug));
        return $slug;
    }

     public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if($sts == 1){
            Subcategory::where('id',$id)->update(['status'=>2]);
        }else{
            Subcategory::where('id',$id)->update(['status'=>1]);
        }
        return true;
    }
}
