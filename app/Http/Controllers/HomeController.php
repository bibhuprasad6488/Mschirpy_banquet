<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.home');
    }

    public function itemlist()
    {
        $items = Menu::with('category')->where('status',1)->orderBy('id','DESC')->get()->append('mediacollection');;
        return view('dashboard.itemlist',compact('items'));
    }

    public function staff_home()
    {
        return view('dashboard.staff_home');
    }

    public function vendor_home()
    {
        return view('dashboard.vendor_home');
    }

    public function customer_list()
    {
        $customers = Customer::orderBy('id','DESC')->get();
        return view('dashboard.customer.customer_list',['customers'=>$customers]);
    }
}
