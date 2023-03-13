<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cuisine;
use App\Models\User;
use Auth;

class CuisineController extends Controller
{
    public function __construct()
    {
        $this->middleware('permissions');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cuisines = Cuisine::orderBy('id','DESC')->get();
        return view('dashboard.cuisine.index',compact('cuisines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('dashboard.cuisine.create');
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
        $this->validate($request,[
        'cuisine_name'=>'required|unique:cuisines'
        ]);
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = $this->slug($data['cuisine_name']);
        $cuisine_name = Cuisine::distinct('cuisine_name')->pluck('cuisine_name');
        try
        {
            $save=new Cuisine($data);
            $save->save();
            return redirect()->back()->with('success','Cuisine successfully saved.');
           
        }catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
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
        $cuisine = Cuisine::find($id);
        return view('dashboard.cuisine.edit',compact('cuisine'));
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
        try
        {
          $catUpdate = Cuisine::where('id', $id)->update(
            [
                'cuisine_name'=>$request->cuisine_name,
                'slug'=>$this->slug($request->cuisine_name),
                'status'=>$request->status
            ]
          );
          return redirect()->back()->with('success','Cuisine successfully updated.');
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
       if(Cuisine::find($id)->delete()){
            return redirect()->back()->with('success','Cuisine deleted.');
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

    public function changestatus(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if($sts == 1){
            Cuisine::where('id',$id)->update(['status'=>2]);
        }else{
            Cuisine::where('id',$id)->update(['status'=>1]);
        }
        return true;
    }
}
