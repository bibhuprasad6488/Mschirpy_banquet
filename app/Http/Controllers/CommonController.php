<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\IngredientCategory;
use App\Models\IngredientItem;
use App\Models\Brand;
use App\Models\DepartmentRequest;
use App\Models\SupplierPriceChart;
use App\Models\Supplier;
use App\Models\Booking;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Package;
use DB;
use App\Models\CustomerExperience;
use Rap2hpoutre\FastExcel\FastExcel;


use Auth;

class CommonController extends Controller
{

    public function add_department(Request $request)
    {
        if ($request->isMethod('post')) {
            $departments = $request->department_name;
            $data['user_id'] = Auth::user()->id;
            try {
                foreach ($departments as $key => $value) {
                    $data['department_name'] = $value;
                    $save = new Department($data);
                    $save->save();
                }
                return redirect()->back()->with('success', 'Department successfully saved.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {
            return view('dashboard.common.add_department');
        }
    }

    public function department_list()
    {
        $departments = Department::orderBy('id', 'DESC')->get();
        return view('dashboard.common.all_departments', compact('departments'));
    }

    public function edit_department($id, Request $request)
    {
        $department = Department::find($id);
        return view('dashboard.common.edit_department', compact('department'));
    }

    public function update_department(Request $request)
    {
        $department = Department::where('id', $request->id)->first();

        try {
            $department->update(
                [
                    'user_id' => Auth::user()->id,
                    'department_name' => $request->department_name,
                    'status' => $request->status
                ]
            );
            return redirect()->back()->with('success', 'department successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function request_form()
    {
        $items = [];
        $department_id = Auth::user()->department_id;
        $departmentnm = Department::select('id', 'department_name')->where('id', $department_id)->first();
        $items = IngredientItem::with('ingredient_category')->whereJsonContains('department_id', "{$department_id}")->orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('id', 'ASC')->get();
        if (!empty($items)) {
            foreach ($items as $valitems) {
                $valitems->selectedbrands = Brand::whereIN('id', $valitems->brand)->orderBy('id', 'ASC')->get();
            }
        }
        // dd($items);
        return view('dashboard.common.request_form', compact('items', 'brands', 'departmentnm'));
    }

    public function save_department_request(Request $request)
    {
        $datas = $request->all();
        if (!empty($datas)) {
            foreach ($datas['item'] as $k => $data) {
                if (!empty($datas['qty'][$k])) {
                    $cats = $datas['cat_id'][$k];
                    $items = $datas['item_id'][$k];
                    $brands = $datas['brand'][$k] ?? '';
                    $qty = $datas['qty'][$k];
                    $req = new DepartmentRequest([
                        'user_id' => Auth::user()->id,
                        'department_id' => $datas['department_id'],
                        'cat_id' => $cats,
                        'item_id' => $items,
                        'brands' => $brands,
                        'qty' => $qty
                    ]);
                    $req->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Request Form has created');
    }



    public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if ($sts == 'active') {
            Department::where('id', $id)->update(['status' => 'inactive']);
        } else {
            Department::where('id', $id)->update(['status' => 'active']);
        }
        return true;
    }

    public function price_chart_report(Request $request)
    {
        if ($request->isMethod('post')) {

            $itemID = $request->item_id;
            $valid_from = $request->valid_from;
            $valid_to = $request->valid_to;
            $range = [$valid_from, $valid_to];

            $query = SupplierPriceChart::query();

            if ($itemID != '' && $valid_from == '' && $valid_to == '') {
                $query = $query->where('item_id', $itemID)->orderBy('id', 'DESC');
            } elseif ($itemID == '' && $valid_from != '' && $valid_to != '') {
                $query = $query->whereHas('supplier', function ($qry) use ($range) {
                    $qry->whereBetween('valid_from', $range)
                        ->whereBetween('valid_to', $range);
                })->orderBy('id', 'DESC');
            } elseif ($itemID != '' && $valid_from != '' && $valid_to != '') {
                $query = $query->where('item_id', $itemID)
                    ->whereHas('supplier', function ($qry) use ($range) {
                        $qry->whereBetween('valid_from', $range)->whereBetween('valid_to', $range);
                    })->orderBy('id', 'DESC');
            } else {
                $query = $query->orderBy('id', 'DESC');
            }

            $price_chart = $query->with('supplier')->get();
        } else {
            $price_chart = SupplierPriceChart::with('supplier')->orderBy('mrp', 'DESC')->get();
            $itemID = "";
        }
        $items = IngredientItem::orderBy('id', 'DESC')->pluck('item_name', 'id');

        return view('dashboard.report.price_chart', compact('price_chart', 'items', 'itemID'));
    }


    public function price_chart_show(Request $request)
    {
        $price_chart = SupplierPriceChart::where('id', $request->id)->first();

        return $price_chart->get_name();
    }


    public function delete_department(Request $request)
    {
        if (Department::find($request->delId)->delete()) {
            return redirect()->back()->with('success', 'Department deleted.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    public function show_review(Request $request)

    {
        $reviews = CustomerExperience::orderBy('id', 'DESC')->get();
        return view('dashboard.Customer_review.index', compact('reviews'));
    }

    public function view_book_data($id)
    {
        $main_menus = [];
        $booking = Booking::with('package', 'venue')->where('id', $id)->first();
        $book_datas = $booking->book_data;
        $book_amount = $booking->total_amount;
        $packages = Package::where('id', $booking->package_id)->first();
        // dd(array_keys($packages->no_of_items));
        $package_price = $packages->price;
        $custom_field = $packages->custom_fields;
        // $data['packages'] = $packages;

        foreach ($book_datas as $key => $val) {
            $category = Category::where('id', $key)->first();
            $data[$category->category_name]['limit'] = $packages->no_of_items[$key];
            $main_menus = array_slice($val, 0, $packages->no_of_items[$key]);
            $extra_menus = array_slice($val, $packages->no_of_items[$key]);
            $merged_menu = array_merge($main_menus, $extra_menus);

            foreach ($merged_menu as  $k => $val) {
                $main_menu = Menu::where('id', $val)->first();
                $data[$category->category_name]['allmenus'][] = $main_menu;
            }

            $data[$category->category_name]['others'] = ['booking_id' => $booking->id, 'cat_id' => $key];
            $data[$category->category_name]['all_items'] = Menu::where('category_id', $key)->whereNotIn('id', $main_menus)->whereNotIn('id', $extra_menus)->pluck('name', 'id');
        }
        // print_r(array_keys($book_datas));
        $pendingCat = array_diff(array_keys($packages->no_of_items), array_keys($book_datas));
        $categoryPending = Category::whereIn('id', $pendingCat)->get();
        // dd($categoryPending);
        return view('dashboard.bookings.view_book_data', compact('data', 'booking', 'categoryPending'));
    }

    public function add_category_to_booked_items(Request $request)
    {
        $booking = Booking::with('package', 'venue')->where('id', $request->booking_id)->first();
        $book_datas = $booking->book_data;
        $book_datas[$request->pendingcat] = [];
        if ($booking->update(['book_data' => $book_datas])) {
            return redirect()->back()->with('success', 'Category added successfully');
        }
    }
    public function delete_report(Request $request)
    {


        $booking = Booking::where('id', $request->id)->first();

        if ($menu->delete()) {
            return redirect()->back()->with('success', 'Report deleted.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function remove_item_cart(Request $request)
    {
        $data = $request->all();
        $booking = Booking::where('id', $request->booking_id)->first();
        $bookData = $booking->book_data;
        foreach ($bookData[$request->cat_id] as $key => $value) {
            if ($value == $request->item_id) {
                unset($bookData[$request->cat_id][$key]);
                break;
            }
        }
        if (empty($bookData[$request->cat_id])) {
            unset($bookData[$request->cat_id]);
        }
        if ($booking->update(['book_data' => $bookData])) {
            return "success";
        } else {
            return "error";
        }
    }

    public function addMoreItem(Request $request)
    {
        // $data = $request->all();
        // dd($request->items);
        $bookings =  Booking::where('id', $request->booking_id)->first();
        $bookData = $bookings->book_data;
        // $bookData[$request->cat_id] = $request->items;
        $newArr = array_merge($bookData[$request->cat_id], $request->items);
        // dd($bookData[$request->cat_id]);
        $bookData[$request->cat_id] = $newArr;
        // dd($bookData);
        try {
            $updateBooking = $bookings->update(['book_data' => $bookData]);
            return redirect()->back()->with('success', 'Items Added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function booking_change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if ($sts == 'pending') {
            Booking::where('id', $id)->update(['status' => 'completed']);
        } else {
            Booking::where('id', $id)->update(['status' => 'pending']);
        }
        return true;
    }

    public function final_price_update(Request $request)
    {
        $id = $request->id;
        $final_amount = $request->amount;
        $booking = Booking::find($id);
        $updateBooking = $booking->update(['total_amount' => $final_amount]);
        try {
            if ($updateBooking) {
                return redirect()->back()->with('success', 'Price Updated successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function booking_reports()
    {
        $booking = Booking::with('customer', 'package', 'venue')->orderBy('id', 'DESC')->get();
        $data['booking'] = $booking;

        return view('dashboard.bookings.booking_report', compact('booking'));
    }


    public function export_booking_report(Request $request)
    {

        $data = [];
        $booking = Booking::with('customer', 'package', 'venue')->orderBy('id', 'DESC')->get();
        // $data['booking'] = $booking;
        if (!empty($booking)) {

            foreach ($booking as $key => $val) {
                $data[] = [
                    'Customer Name' => $val->customer->customer_name ?? '',
                    'Booking No' => $val->booking_no ?? '',
                    'Package Name' => $val->package->package_name ?? '',
                    'Venue Name' => $val->venue->venue_name ?? '',
                    'Booking Date' => $val->booking_datetime ?? '',
                    'Status' => $val->status ?? ''

                ];
            }
            // dd($data);
            return (new FastExcel($data))->download('booking_report.xlsx');
        }
    }
}
