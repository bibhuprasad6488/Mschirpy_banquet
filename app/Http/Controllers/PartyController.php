<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

use Auth;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parties = Party::orderBy('id','DESC')->get();
        return view('dashboard.party.index',compact('parties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.party.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prtyname = $request->party_name;
        $data['user_id'] = Auth::user()->id;
        try
        {
            foreach ($prtyname as $key => $value) {
                $data['party_name'] = $value;
                $save=new Party($data);
                $save->save();
            }

            
            return redirect()->back()->with('success','Party successfully saved.');
           
        }catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function show(Party $party)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function edit(Party $party)
    {
       return view('dashboard.party.edit',compact('party'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Party $party)
    {
        try
        {
          $catUpdate = $party->update(
            [
                'party_name'=>$request->party_name,
                'status'=>$request->status
            ]
          );
          return redirect()->back()->with('success','Party successfully updated.');
         }
        catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function destroy(Party $party)
    {
        if($party->delete()){
            return redirect()->back()->with('success','Party deleted.');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

 public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if($sts == 'active'){
            Party::where('id',$id)->update(['status'=>'inactive']);
        }else{
            Party::where('id',$id)->update(['status'=>'active']);
        }
        return true;
    }
}
