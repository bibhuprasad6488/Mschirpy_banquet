<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Venuetype;
use App\Models\User;
use Auth;

class VenuetypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venueTypes = Venuetype::orderBy('id','DESC')->get();
        return view('dashboard.venuetype.index',compact('venueTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.venuetype.create');
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
            $save=new Venuetype($data);
            $save->save();
            return redirect()->back()->with('success','Venue Type successfully saved.');
           
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
        $venuetype = Venuetype::find($id);
        return view('dashboard.venuetype.edit',compact('venuetype'));
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
         try
        {
            $update = Venuetype::find($id)->update($data);
            if($update){
                return redirect()->back()->with('success','Venue Type successfully updated.');
            }
        }catch (\Exception $e) {
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
        if(Venuetype::find($id)->delete()){
            return redirect()->back()->with('success','Venue Type deleted.');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }


public function change_sts(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if($sts == 1){
            Venuetype::where('id',$id)->update(['status'=>2]);
        }else{
            Venuetype::where('id',$id)->update(['status'=>1]);
        }
        return true;
    }
}
