<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Menuitem;
use Auth;

class CustomPackageController extends Controller
{
    public function custom_package(){
    	$allpackages = Package::where(['status'=>'1'])->get();
    	return view('front.custom_package',compact('allpackages'));
    }

    public function single_package($slug)
    {
    	$singlePkg = Package::with(['menuitem','venuetype'])->where('slug',$slug)->first();
        // dd($singlePkg->subcategory);
    	return view('front.single_package',compact('singlePkg'));
    }

    public function show_packages()
    {
        $allpackages = Package::where(['status'=>'1'])->get();
       
        return view('dashboard.packagebooking',compact('allpackages'));
    }

    public function package_details($slug)
    {
        $singlePkg = Package::with(['menuitem','venuetype'])->where(['slug'=>$slug])->first();
        return view('dashboard.single_package_booking',compact('singlePkg'));
    }
}
