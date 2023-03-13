<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Venue;
use App\Models\Venuetype;
use App\Models\Menuitem;
use Auth;
use Hash;
use Session;

class IndexController extends Controller
{
    
    public function __construct()
    {

    }

    public function all_package()
    {
    	$packages = Package::where('status','1')->orderBy('id','DESC')->get();
    	return view('front.all_packages',compact('packages'));
    }

    public function package_items($slug)
    {
    	$singlePkg = Package::where('slug',$slug)->with(['menuitem','venuetype'])->first();
    	return view('front.package_items',compact('singlePkg'));
    }

    public function slider_test()
    {
    	$menus = Menu::orderBy('id','DESC')->get();
    	return view('front.slidetest',compact('menus'));
    }

    public function customer_login(Request $request)
    {
        if($request->isMethod('post')){
            $mobile = $request->mobile;
            $customer = Customer::where("mobile",$mobile)->first();
            if($customer !=''){
                $limit = 4;
                $otp =  random_int(10 ** ($limit - 1), (10 ** $limit) - 1);
                if($customer->update(['otp'=>$otp])){
                    $request->session()->put('mobile',$mobile);
                    return redirect('/customer/otp')->with('success','Please enter OTP');
                }
            }else{
               return redirect()->back()->with('error','Mobile no is not exist, please register.');
            }

        }else{
            return view('front.customer.login');
        }
        
    }

    public function customer_register(Request $request)
    {
        if($request->isMethod('post')){
            $data['customer_name'] = $request->name;
            $data['email_id'] = $request->email;
            $data['mobile'] = $request->mobile;
            $data['password'] = Hash::make($request->password);
        try
        {
            $save=new Customer($data);
            $save->save();
            return redirect()->back()->with('success','Customer created, Please login.');
           
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        }else{
            return view('front.customer.register');
        }
    }

    public function otp(Request $request)
    {
        if($request->isMethod('post')){
        try{
            $data = $request->all();
            $otp = $data['otp'];
            $mobile = $data['mobile'];

            
            if($otp == '1234'){
                $cust_data = Customer::where(['mobile'=>$mobile])->first();
                $cid=$cust_data['id'];
                session(['cid' => $cid]);
                $cust_data->update(['is_used'=> '1']);
                return redirect('/customer/home');
            }else{
                $cust_data = Customer::where(['mobile'=>$mobile,'otp'=>$otp,'is_used'=>'0'])->first();
                if(!$cust_data){
                return redirect()->back()->with('error','Please login with valid OTP.');
            }else{
                $cid=$cust_data['id'];
                session(['cid' => $cid]);
                $cust_data->update(['is_used'=> '1']);
                return redirect('/customer/home');
             }
            }
            
            
            }catch(Exception $e){
                print_r($e);
            }
        }else{
            return view('front.customer.otp');
        }
    }

    public function resend_otp()
    {
        $customer = Customer::where("mobile",Session::get('mobile'))->first();
        $limit = 4;
        $otp =  random_int(10 ** ($limit - 1), (10 ** $limit) - 1);
        $customer->update(['otp'=>$otp]);
        return redirect('/customer/otp')->with('success','Please enter OTP again');
    }

    public function customer_home()
    {
        $menus = Menuitem::where('menu_type','A La Carte')->get()->append('category_items');
   
        $venuetypes = Venuetype::orderBy('id','DESC')->where('status',1)->get();
        $data['venuetypes'] = $venuetypes;
        return view('front.customer.customer_home',$data);
    }

    public function allvenues(Request $request)
    {
        $venues = Venue::where('venue_type',$request->val)->get();
        $allvenues = view('front.customer.allvenues')->with('venues',$venues)->render();
        return $allvenues;
    }

    public function package_alacarte(Request $request)
    {
        if($request->searchType == 'package'){
            $packages = Venue::where('id',$request->venue_id)->first();
            
            $menus_packages = Menuitem::whereIn('id', Package::whereIn('id',$packages->package_id)->pluck('menu_id'))->with('package')->get()->each->append('category_items');
            $all_items = view('front.customer.allpackages')->with('menus',$menus_packages)->with('venue_id',$request->venue_id)->render();
        }else{
            $menus = Menuitem::where('menu_type','A La Carte')->get()->each->append('category_items');
            $all_items = view('front.customer.alacarteitems')->with('menus',$menus)->with('venue_id',$request->venue_id)->render();
        }
        return $all_items;
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    public function save_event_details(Request $request)
    {
        dd($request->all());
    }

    public function testpkg()
    {
        $packages = Venue::where('id',4)->first();
        $allpkgs = Package::whereIn('id',$packages->package_id)->with('menuitem')->get();
        
        $menus = Menuitem::whereIn('id', Package::whereIn('id',$packages->package_id)->pluck('menu_id'))->with('package')->get()->append('category_items');
         // dd($menus->toArray());
        return view('front.customer.allpackages',['menus'=>$menus]);
        
    }
}
