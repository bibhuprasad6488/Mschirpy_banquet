<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Amenity;
use App\Models\User;
use Auth;
use DB;

class AmenityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amenities = Amenity::orderBy('amenity_name', 'ASC')->get();
        return view('dashboard.amenity.index', compact('amenities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.amenity.create');
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
        $this->validate(
            $request,
            [
                'amenity_name' => 'required|unique:amenities'
            ]
        );

        $data['user_id'] = Auth::user()->id;
        $amenity_name = Amenity::distinct('amenity_name')->pluck('amenity_name');
        try {
            $save = new Amenity($data);
            $save->save();
            return redirect()->back()->with('success', 'Amenity successfully saved.');
        } catch (\Exception $e) {
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
        $amenity = Amenity::find($id);
        return view('dashboard.amenity.edit', compact('amenity'));
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
        try {
            $catUpdate = Amenity::where('id', $id)->update(
                [
                    'amenity_name' => $request->amenity_name,
                    'icon' => $request->icon,
                    'status' => $request->status
                ]
            );
            return redirect()->back()->with('success', 'Amenity successfully updated.');
        } catch (\Exception $e) {
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
        if (Amenity::find($id)->delete()) {
            return redirect()->back()->with('success', 'Amenity deleted.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if ($sts == 1) {
            Amenity::where('id', $id)->update(['status' => 2]);
        } else {
            Amenity::where('id', $id)->update(['status' => 1]);
        }
        return true;
    }
}
