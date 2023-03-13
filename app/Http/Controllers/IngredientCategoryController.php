<?php

namespace App\Http\Controllers;

use App\Models\IngredientCategory;
use Illuminate\Http\Request;
Use Auth;


class IngredientCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = IngredientCategory::orderBy('id','DESC')->get();
        return view('dashboard.ingredient_category.index',compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.ingredient_category.create');
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
            $save=new IngredientCategory($data);
            $save->save();
            return redirect()->back()->with('success','Ingredient Category successfully saved.');
           
        }catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IngredientCategory  $ingredientCategory
     * @return \Illuminate\Http\Response
     */
    public function show(IngredientCategory $ingredientCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IngredientCategory  $ingredientCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(IngredientCategory $ingredientCategory)
    {
       return view('dashboard.ingredient_category.edit',compact('ingredientCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IngredientCategory  $ingredientCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IngredientCategory $ingredientCategory)
    {
        try
        {
          $ingredientCategory->update(
            [
                'category_name'=>$request->category_name,
                'status'=>$request->status
            ]
          );
          return redirect()->back()->with('success','Ingredient Category successfully updated.');
         }
        catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IngredientCategory  $ingredientCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(IngredientCategory $ingredientCategory)
    {
        if($ingredientCategory->delete()){
            return redirect()->back()->with('success','Ingredient Category deleted.');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }
     public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if($sts == 'active'){
            IngredientCategory::where('id',$id)->update(['status'=>'inactive']);
        }else{
            IngredientCategory::where('id',$id)->update(['status'=>'active']);
        }
        return true;
    }
}
