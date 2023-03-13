<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

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
use Hash;
use Session;
use Cookie;


class OrderController extends Controller
{
    public function __construct()
    {
    }

    
    public function add_to_box(Request $request)
    {
        // session()->forget('cart');
        // return session()->all();
        // exit;
        $item_id = $request->item_id;
        $cat_id = $request->cat_id;
        $package_id = $request->package_id;
        $limit = $request->limit;
        $pckg = Package::where('id', $package_id)->first();
        $allcatin_arr = $pckg->custom_fields;
        
        $target = $cat_id;
        $currentcat = Category::where('id',$cat_id)->first();
        $targetIndex = array_search($target, array_keys($allcatin_arr));
        $rightElements = array_slice(array_keys($allcatin_arr), $targetIndex + 1);
        if(!empty($rightElements)){
            $nextcat = Category::where('id',$rightElements[0])->first();
        }else{
            $nextcat = (object)[];
        }
        if (!empty($pckg->custom_fields) && !empty($pckg->custom_fields[$cat_id])) {
            $cat_max_limit = $pckg->custom_fields[$cat_id]['qty'];
            $extraPrice = $pckg->custom_fields[$cat_id]['price'];
        } else {
            $cat_max_limit = 0;
            $extraPrice = 0;
        }
        $cat_limit = 0;
        $is_exist = 0;
        $is_limit = 0;
        $cart = [];
        $user_id = session()->get('cid');
        if (!$user_id) {
            return response()->json(array('text' => 'no_login'), 200);
        } else {
            if (session()->has('cart')) {
                $oldCart = session()->get('cart');
                $cart = $oldCart;
                if (array_key_exists($cat_id, $cart)) {
                    $countsubarrayItem = count($cart[$cat_id]);
                    if ($countsubarrayItem < (int)$limit + $cat_max_limit) {
                        if (in_array($item_id, $cart[$cat_id])) {
                            $is_exist = 1;
                        } else {
                            $cart[$cat_id][] = $item_id;
                        }
                    } else {
                        $cat_limit = 1;
                    }
                } else {
                    $cart[$cat_id][] = $item_id;
                }
            } else {
                $cart[$cat_id][] = $item_id;
            }

            session()->put('cart', $cart);
            $countsubarrayItem = count($cart[$cat_id]);
            
            if ($countsubarrayItem == (int)$limit) {
                $is_limit = 1;
            } else {
                $is_limit = 0;
            }
            //$countCart = count(session()->get('cart'), COUNT_RECURSIVE) - 1;

            $countCart = 0;
            foreach (session()->get('cart') as $data) {
                $countCart += count($data);
            }
            $data['cartCount'] = $countCart;
            $data['cartsession'] = session()->get('cart');
            $data['cat_limit'] = $cat_limit;
            $data['is_exist'] = $is_exist;
            $data['is_limit'] = $is_limit;
            $data['extraPrice'] = $extraPrice;
            $data['maxitems'] = $cat_max_limit;
            $data['currentcat'] = $currentcat;
            $data['nextcat'] = $nextcat;
            $data['category_item_count'] = $countsubarrayItem;
            return $data;
        }
    }

    public function remove_to_box(Request $request)
    {
        $item_id = $request->item_id;
        $cat_id = $request->cat_id;
        $package_id = $request->package_id;
        $limit = $request->limit;
        if (session()->has('cart')) {

            $oldCart = session()->get('cart');
            $cart = $oldCart;
            if (array_key_exists($cat_id, $cart)) {
                // $removed_cart = array_diff($cart[$cat_id],[$item_id]);
                // $crt = array_values($removed_cart);
                // $cart[$cat_id][] = $crt;
                $key = array_search($item_id, $cart[$cat_id]);
                unset($cart[$cat_id][$key]);
                if(empty($cart[$cat_id])){
                    unset($cart[$cat_id]);
                }
            }
            session()->put('cart', $cart);
            $cart = session()->get('cart');
            $countsubarrayItem = count($cart[$cat_id] ?? []);

            if ($countsubarrayItem == (int)$limit) {
                $is_limit = 1;
            } else {
                $is_limit = 0;
            }
            //$countCart = count(session()->get('cart'), COUNT_RECURSIVE) - 1;

            $countCart = 0;
            foreach (session()->get('cart') as $data) {
                $countCart += count($data);
            }
        }
        $data['cartCount'] = $countCart;
        $data['cartsession'] = $cart;
        return $data;
    }

   public function confirm_booking(Request $request)
    {
        $customer_id = $request->customer_id;
        $venue_id = $request->venue_id;
        $searched_date = $request->searched_date;   
        $package_id = $request->package_id;
        $total_amount = $request->total_amount;
        $cart = session()->get('cart');
        if (session()->has('cart') && $customer_id) {
                $booking_no = time() .rand(0,3) .$customer_id;
                // $dateTime = date('Y-m-d H:i:s');
                $data['customer_id'] = $customer_id;
                $data['booking_no'] = $booking_no;
                $data['venue_id'] =  $venue_id;
                $data['package_id'] =  $package_id;
                $data['book_data'] = $cart;
                $data['booking_datetime'] = $searched_date;
                $data['total_amount'] = $total_amount;
                // return $data;exit;der
                $book = new Booking($data);
                $saveBooking = $book->save();
                // session()->forget('cart');
                // session()->forget('p_details');
                if ($saveBooking) {
                    return ['booking_id' => $booking_no];
                } else {
                    return [];
                }
        }
    }
}