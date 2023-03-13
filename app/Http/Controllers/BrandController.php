<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Department;

use Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::with('department')->orderBy('id', 'DESC')->get();
        return view('dashboard.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('status', 'active')->orderBy('id', 'DESC')->pluck('department_name', 'id');
        return view('dashboard.brand.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brands = $request->brand_name;
        //    dd($brands);

        // $departments = $request->department_id;
        try {
            $data['user_id'] = Auth::user()->id;
            $arr = [];
            foreach ($brands as $k => $brand) {
                $arr[] = [
                    'user_id' => Auth::user()->id,
                    'brand_name' => $brand,
                    // 'department_id' => $departments[$k]
                ];
            }
            Brand::insert($arr);
            return redirect()->back()->with('success', 'Brand successfully saved.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $departments = Department::where('status', 'active')->orderBy('id', 'DESC')->pluck('department_name', 'id');
        return view('dashboard.brand.edit', compact('brand', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        try {
            $catUpdate = $brand->update(
                [
                    'brand_name' => $request->brand_name,
                    // 'department_id' => $request->department_id,
                    'status' => $request->status
                ]
            );
            return redirect()->back()->with('success', 'Brand successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if ($brand->delete()) {
            return redirect()->back()->with('success', 'Brand deleted.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    // public function set_brand_default(Request $request)
    // {
    //     $def_val = $request->def_val;
    //     $brand_id = $request->brand_id;
    //     $depart_id = $request->depat_id;
    //     $update_default = Brand::where('id',$brand_id)->first();
    //     $check_alrdy_exist = Brand::where(['department_id'=>$depart_id,'is_default'=>'yes'])->get();
    //     // if($check_alrdy_exist->count() < 1){
    //         if($def_val == 'no'){
    //             $update_default->update(['is_default'=>'yes']);
    //             return 'yes';
    //         }else{
    //             $update_default->update(['is_default'=>'no']);
    //             return 'no';
    //         }
    //     // }else{
    //     //     if($def_val == 'no'){
    //     //         return "exist";
    //     //     }else{
    //     //         $update_default->update(['is_default'=>'no']);
    //     //     }
    //     // }
    // }


    public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if ($sts == 'active') {
            Brand::where('id', $id)->update(['status' => 'inactive']);
        } else {
            Brand::where('id', $id)->update(['status' => 'active']);
        }
        return true;
    }
}
