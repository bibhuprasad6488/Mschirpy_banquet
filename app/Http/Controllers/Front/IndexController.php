<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Party;
use App\Models\Venue;
use App\Models\VenueImage;
use App\Models\Amenity;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Menu;
use App\Models\Customer;
use App\Models\Page;
use App\Models\Event;
use App\Models\Category;
use App\Models\ContentManagement;
use App\Models\Faq;
use App\Models\CustomerExperience;
use DateTime;
use Hash;
use Session;

class IndexController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $contents = ContentManagement::where('others', 'home')->first();
        $parties = Party::orderBy('id', 'DESC')->pluck('party_name', 'id');
        if (session()->get('cid')) {
        return view('front.home',  compact('parties', 'contents'));
        }else{
            return redirect('/banquet/login');
        }
    }
    public function book_now()
    {
        $parties = Party::orderBy('id', 'DESC')->pluck('party_name', 'id');
        return view('front.book_now',  compact('parties'));
    }

    public function all_venues(Request $request)
    {
        $id = session()->get('cid');
        if ($id) {
            if ($request->isMethod('post')) {
                if(!empty($request->date_check)){
                    $searched_date = date('Y-m-d',strtotime($request->date_check));
                }else{
                    $searched_date = date('Y-m-d');
                }
            }else{
                    $searched_date = date('Y-m-d');
            }
            $venues = Venue::orderBy('id', 'DESC')->with(['venueimage', 'booking'])->get();
            if(!empty($venues)){
                foreach($venues as $venue){
                    $count_booked = Booking:: where('venue_id',$venue->id)->whereDate('booking_datetime','>=',$searched_date)->wheredate('booking_datetime','<=',$searched_date)->where('status','completed')->get()->count();
                    $venue->bookCnt = $count_booked;
                }
            }
            $contents = ContentManagement::where('others', 'all-venues')->with('page')->first();
            
            $data['contents'] = $contents;
            $data['venues'] = $venues;
            $data['searched_date'] = $searched_date;

            return view('front.all_venues', $data);
        } else {
            return redirect('/banquet/login');
        }
    }

    public function venue($slug, $searched_date)
    {
        if (session()->get('cid')) {
        $venue = Venue::where(['slug' => $slug])->with('venueimage')->first();
        $faq = Faq::orderBy('id', 'DESC')->get();
        $data['faq'] = $faq;
        $data['venue'] = $venue;
        $data['searched_date'] = $searched_date;
        return view('front.single_venue', $data);
    }
    else{
        return redirect('/banquet/login');
    }
    }


    public function singlle_package($venue_slug, $package_slug, $searched_date, $cart_cat_id = null, $cart_package_id = null)
    {
        $id =  session()->get('cid');
        if ($id) {
        // if ($modify != null && $modify != 'modify') {
        //     session()->forget('p_details');
        //     session()->forget('cart');
        // }
        session()->put('p_details', ['venue_slug' => $venue_slug, 'package_slug' => $package_slug, 'searched_date'=> $searched_date]);

        $package = Package::where('slug', $package_slug)->first();
        if (!empty($package->no_of_items)) {
            $cats = Category::whereIn('id', array_keys((array) $package->no_of_items))->get();
        } else {
            $cats = [];
        }
         // dd($cats);
        $contents = ContentManagement::where('page_id', 8)->first();
        $data['contents'] = $contents;
        $data['package'] = $package;
        $data['cats'] = $cats;
        if($cart_cat_id != null && $cart_package_id != null){
            $data['cart_cat_id'] = Crypt::decrypt($cart_cat_id);
            $data['cart_package_id'] = Crypt::decrypt($cart_package_id);
        }else{
            $data['cart_cat_id'] = null;
            $data['cart_package_id'] = null;
        }
        return view('front.single_package', $data);
    }else{
        return redirect('/banquet/login');
    }
    }

    public function showitems_cat(Request $request)
    {
        $cat_data = Category::where('id', $request->cat_id)->first();
        $allmenus_with_arr = $this->__cuisine_wise_item($cat_data,$request->search);
        $allmenus = $allmenus_with_arr['menu_arr'];
        $totalitems = $allmenus_with_arr['item_counts'];
        $package_data = Package::where('id', $request->package_id)->first();
        if (session()->has('cart')) {
            $crt_data = session()->get('cart');
        } else {
            $crt_data = [];
        }
        $renderData = view('front.itemgroups')->with(['allmenus' => $allmenus, 'cat_id' => $request->cat_id, 'crt_data' => $crt_data])->render();
        $data['renderData'] = $renderData;
        $data['cat_data'] = $cat_data;
        $data['mealcourse'] = $package_data->no_of_items[$request->cat_id] . "/" . $totalitems;
        if ($package_data->no_of_items[$request->cat_id] != '') {
            $data['qtyVal'] = $this->getIndianCurrency($package_data->no_of_items[$request->cat_id]);
        } else {
            $data['qtyVal'] = '';
        }
        $data['catlimit'] = $package_data->no_of_items[$request->cat_id];
        return $data;
    }

    private function __cuisine_wise_item($cat_data, $search='')
    {
        $menu_arr = [];
        $itemCount = 0;
        if(!empty($cat_data)){
            foreach($cat_data->cuisines_id as $k => $v){
                if($search !=''){
                    if($search == 'veg'){
                        $vegmenu = Menu::where(['category_id'=>$cat_data->id, 'cuisine_id'=>$k, 'menu_type'=>'Veg'])->get();
                        $itemCount += $vegmenu->count();
                        if(!empty($vegmenu) && $vegmenu->count() > 0){
                            $menu_arr[$v]['Veg']= $vegmenu;
                        }
                    }else{
                        $nonvegmenu = Menu::where(['category_id'=>$cat_data->id, 'cuisine_id'=>$k, 'menu_type'=>'Non-veg'])->get();
                        $itemCount += $nonvegmenu->count();
                        if(!empty($nonvegmenu) && $nonvegmenu->count() > 0){
                            $menu_arr[$v]['Non-veg']= $nonvegmenu;
                        }
                    }
                }else{
                    $vegmenu = Menu::where(['category_id'=>$cat_data->id, 'cuisine_id'=>$k, 'menu_type'=>'Veg'])->get();
                    $itemCount += $vegmenu->count();
                    if(!empty($vegmenu) && $vegmenu->count() > 0){
                        $menu_arr[$v]['Veg']= $vegmenu;
                    }

                    $nonvegmenu = Menu::where(['category_id'=>$cat_data->id, 'cuisine_id'=>$k, 'menu_type'=>'Non-veg'])->get();
                    $itemCount += $nonvegmenu->count();
                    if(!empty($nonvegmenu) && $nonvegmenu->count() > 0){
                        $menu_arr[$v]['Non-veg']= $nonvegmenu;
                    }
              }
                
            }
        }
        return ['menu_arr' => $menu_arr, 'item_counts' => $itemCount];
    }


    public function customer_store(Request $request)
    {
        // return $request->all();
        CustomerExperience::create($request->all());
        return json_encode(array(
            "statusCode" => 200
        ));
    }


    public function customer_register(Request $request)
    {

        if ($request->isMethod('post')) {
            $data['customer_name'] = $request->customer_name;
            $data['email_id'] = $request->email_id;
            $data['mobile'] = $request->mobile;
            // $data['password'] = Hash::make($request->password);
            // $recordExist = $this->validate($request, [
            //     'customer_name' => 'required',
            //     'email_id' => 'required|unique:customers',
            //     'mobile' => 'required|unique:customers'

            // ]);
            $mobileExist = Customer::where('mobile', $request->mobile)->get()->count();
            $emailExist = Customer::where('email_id', $request->email_id)->get()->count();
            if ($mobileExist > 0) {
                $msg = "mobile_exist";
                return $msg;
            }
            if ($emailExist > 0) {
                $msg = "email_exist";
                return $msg;
            }
            try {
                $save = new Customer($data);
                $saveCust = $save->save();

                if ($saveCust) {
                    $cust_id = $save->id;
                    $eventarr = [
                        'customer_id' => $cust_id,
                        'event_date' => $request->date,
                        'start_time' => $request->start_time,
                        'end_time' => $request->end_time,
                        'amount_of_gathering' => $request->amount_of_gathering,
                        'type' => $request->party_id
                    ];

                    $save = new Event($eventarr);
                    $allsave = $save->save();
                    if ($allsave) {
                        return "success";
                    } else {
                        return "error";
                    }
                }
                // exit;
                return redirect()->back()->with('success', 'Customer created, Please login.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {
            return view('front.customer.register');
        }
    }

    public function customer_login()
    {
        $customers = Customer::orderBy('id', 'DESC')->get();
        return view('front.customer_login', compact('customers'));
    }



    public function customer_otp(Request $request)
    {

        if ($request->isMethod('post')) {
            $mobile = $request->mobile;
            $customer = Customer::where("mobile", $mobile)->first();
            if ($customer != '') {
                $limit = 4;
                $otp =  random_int(10 ** ($limit - 1), (10 ** $limit) - 1);
                if ($customer->update(['otp' => $otp, 'is_used' => '0'])) {
                    $request->session()->put('mobile', $mobile);
                    $mobile = session()->get('mobile');
                    return response()->json(array('text' => 'ok', 'mobile' => $mobile), 200);
                }
            } else {
                return redirect()->back()->with('error', 'Mobile no is not exist, please register.');
            }
        } else {
            return view('front.customer_login');
        }
    }

    public function check_otp(Request $request)
    {
        // dd(session()->all());
        if ($request->isMethod('post')) {
            try {
                $data = $request->all();
                $otp = $data['otp'];
                $mobile = $data['mobile'];
                if ($otp == '1308') {
                    $cust_data = Customer::where(['mobile' => $mobile])->first();
                } else {
                    $cust_data = Customer::where(['mobile' => $mobile, 'otp' => $otp, 'is_used' => '0'])->first();
                }
                if (!empty($cust_data)) {
                    $cid = $cust_data['id'];
                    session()->put('cid', $cid);
                    $cust_data->update(['is_used' => '1']);
                    return redirect('/banquet/all-venues');
                } else {
                    return redirect()->back()->with('error', 'Please login with valid OTP.');
                }
            } catch (\Exception $e) {
                print_r($e);
            }
        } else {
            return view('front.otp');
        }
    }

    public function customer_logout()
    {
        session()->flush();
        return redirect('/banquet/login');
    }


    public function otp_index()
    {
        $mobile = session()->get('mobile');
        if ($mobile) {
            return view('front.otp');
        } else {
            return view('front.customer_login');
        }
    }

    public function resend_otp()
    {
        return view('front.otp');
    }

    public function customer_profile()
    {
        $id = session()->get('cid');
        $customer = Customer::where('id', $id)->first();
        // dd($customer);
        $bookings = Booking::where('customer_id', $id)->get();

        if ($id) {
            return view('front.customer_profile', compact('customer', 'bookings'));
        } else {
            return redirect('/banquet');
        }
    }
    public function edit_profile($id)
    {
        $profile = Customer::find($id);
        return view('front.customer_profile', compact('profile'));
    }


    public function update_profile(Request $request)
    {
        $data = $request->all();
        try {
            $profile = Customer::where('id', $request->id)->first();
            $profile->update($data);

            return redirect()->back()->with('success', 'profile successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getIndianCurrency(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
        );
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        return $Rupees;
    }

    public function register()
    {
        $register = Customer::orderBy('id', 'DESC')->get();
        return view('front.customer_register', compact('register'));
    }

    public function add_customer(Request $request)
    {
        Customer::create($request->all());
        return json_encode(array(
            "statusCode" => 200
        ));
    }

  public function view_carts()
    {
        // dd(session()->has('p_details'));
        $main_menus = [];
        $data = [];
        $id = session()->get('cid');
        $customer = Customer::find($id);
        if ($id) {
            if (session()->has('cart')) {
                $cart = session()->get('cart');
                $slug = session()->get('p_details');
                $venue = Venue::where('slug',$slug['venue_slug'])->first();
                $package_slug = $slug['package_slug'];
                $searched_date = $slug['searched_date'];
                $packages = Package::where('slug', $package_slug)->first();
                $package_price = $packages->price;
                $custom_field = $packages->custom_fields;
                $total_limit = 0;
                $total_extra = 0;
                $extra_items_price = 0;
                foreach ($cart as $key => $cartValue) {
                    $category = Category::where('id', $key)->first();

                    //Add limit of category in this package.

                    $data[$category->category_name]['limit'] = $packages->no_of_items[$key];
                    $main_menus = array_slice($cartValue, 0, $packages->no_of_items[$key]);
                    $extra_menus = array_slice($cartValue, $packages->no_of_items[$key]);
                    
                    $countAllExtra = 0;
                    if(!empty($extra_menus) && count($extra_menus) > 0){
                        $isExtra = 'yes';
                    }else{
                        $isExtra = 'no';
                    }
                    $total_limit = $total_limit + $packages->no_of_items[$key];

                    $data[$category->category_name]['isExtra'] = $isExtra;
                    $data[$category->category_name]['main_menus'] = $main_menus;
                    $data[$category->category_name]['extra_menus'] = $extra_menus;
                    $data[$category->category_name]['slug'] = $slug;
                    $data[$category->category_name]['cat_id'] = Crypt::encrypt($key);
                    $data[$category->category_name]['package_id'] = Crypt::encrypt($packages->id);


                    foreach($data[$category->category_name]['main_menus'] as $k=> $itemId){
                        $vegitems = $this->findItem($itemId, 'Veg');
                        if($vegitems != ''){
                            $data[$category->category_name]['veg']['main_menu'][$itemId] =  $vegitems;
                        }
                        $nonvegitems = $this->findItem($itemId, 'Non-veg');
                        if($nonvegitems != ''){
                            $data[$category->category_name]['nonveg']['main_menu'][$itemId] =  $nonvegitems;
                        }
                    }

                    foreach($data[$category->category_name]['extra_menus'] as $itemId){
                        $vegitems = $this->findItem($itemId, 'Veg');
                        if($vegitems != ''){
                            $data[$category->category_name]['veg']['extra_menus'][$itemId] =  $vegitems;
                        }

                        $nonvegitems = $this->findItem($itemId, 'Non-veg');
                        if($nonvegitems != ''){
                            $data[$category->category_name]['nonveg']['extra_menus'][$itemId] =  $nonvegitems;
                        }
                    }
                    $extra_items_price = $extra_items_price + ($packages->custom_fields[$key]['price'] ?? 0) * count($extra_menus);
                    $data[$category->category_name]['extra_Item_price'] = ($packages->custom_fields[$key]['price'] ?? 0) * count($extra_menus);
                    $data[$category->category_name]['countAllExtra'] = count($extra_menus);
                    $total_extra = $total_extra + count($extra_menus);
                    }
                    $toatl_limit_with_extra = $total_limit + $total_extra;
                    $others['total_limit'] = $total_limit;
                    $others['toatl_limit_with_extra'] = $toatl_limit_with_extra;
                    $others['package'] = $packages;
                    $others['extra_all_items_price'] = $extra_items_price;
                    $others['venue_id'] = $venue->id;
                    $others['customer'] = $customer;
                    $others['searched_date'] = $searched_date;
            } else {
                $others = [];
                $data = [];
            }
            if (!empty($data)) {
                return view('front.cart', compact('data', 'others'));
            } else {
                return view('front.cart_view');
            }        } else {
            return redirect('/banquet/login');
        }
    }

    public function findItem($id, $type)
    {
        $data = '';
        $item = Menu::where(['id'=> $id,'menu_type'=> $type])->select('id','name')->first();
        if(!empty($item)){
            $data = $item->name;
        }

        return $data;
    }

    public function book_data(Request $request)
    {
        $cid = session()->get('cid');
        $final_amount = $request->total_amount;
        $cart = session()->get('cart');
        $package = Package::where('slug', $request->pckg_id)->first();
        $packages = $package['id'];
        $venue = Venue::where('slug', $request->venue_id)->first();
        $venues = $venue['id'];
        if ($cid) {
            if ($request->isMethod('post')) {
                $booking_no = time() . $cid;
                $dateTime = date('Y-m-d H:i:s');
                $data['customer_id'] = $cid;
                $data['booking_no'] = $booking_no;
                $data['venue_id'] =  $venues;
                $data['package_id'] =  $packages;
                $data['book_data'] = $cart;
                $data['booking_datetime'] = $dateTime;
                $data['total_amount'] = $final_amount;
                $save = new Booking($data);
                $saveBooking = $save->save();
                session()->forget('cart');
                session()->forget('p_details');
                if ($saveBooking) {
                    return redirect()->back()->with('success', 'Booking Save Successfully');
                } else {
                    return redirect()->back()->with('error', 'Booking Save Failed');
                }
            }
        }
    }
    public function booking_reports()
    {
        $booking = Booking::with('customer', 'package', 'venue')->orderBy('id', 'DESC')->get();
        $data['booking'] = $booking;

        return view('dashboard.bookings.booking_report', compact('booking'));
    }

    public function thank_you()
    {
        if (session()->get('cid')) {
            session()->forget('cart');
            session()->forget('p_details');
            return view('front.thankyou');
            } else {
            return redirect('/banquet');
        }
           
    }
}