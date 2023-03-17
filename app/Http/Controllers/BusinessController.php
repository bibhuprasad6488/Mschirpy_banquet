<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Amenity;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use App\Models\Business;
use App\Models\Businessphoto;
use Auth;

use DB;

use Validator;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = Business::with(['vendor_user', 'user', 'states', 'cities'])->orderBy('id', 'DESC')->get();
        return view('dashboard.business.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = User::role('vendor')->get();
        $states = State::get();
        $amenities = Amenity::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->get();
        return view('dashboard.business.create', compact('vendors', 'states', 'amenities'));
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
        $data['slug'] = $this->slug($data['business_name']);
        $primary_contact = Business::distinct('primary_contact')->pluck('primary_contact');
        $secondary_contact = Business::distinct('secondary_contact')->pluck('secondary_contact');
        $admin_email = Business::distinct('admin_email')->pluck('admin_email');
        $this->validate(
            $request,
            [
                'business_name' => 'required|unique:business',
                'admin_email' => 'required|unique:business',
                'primary_contact' => 'required|unique:business',
                'secondary_contact' => 'required|unique:business'

            ]

        );
        try {
            $saveBusiness = new Business($data);
            if ($saveBusiness->save()) {
                return redirect()->back()->with('success', 'Business successfully saved.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
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
        $business = Business::find($id);
        $vendors = User::role('vendor')->get();
        $states = State::get();
        $cities = City::get();
        $amenities = Amenity::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->get();
        return view('dashboard.business.edit', compact('business', 'vendors', 'states', 'cities', 'amenities'));
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
        $data['slug'] = $this->slug($data['business_name']);
        try {
            $business = Business::where('id', $id)->first();
            $business->update($data);
            return redirect()->back()->with('success', 'Business successfully updated.');
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
        $business = Business::where('id', $id)->first();
        if ($business->delete()) {
            return redirect()->back()->with('success', 'Business successfully deleted.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function state_wise_city_change(Request $request)
    {
        $cities = City::where('state_id', $request->state)->get();
        if (!empty($cities)) {
            return response()->json($cities);
        } else {
            return response()->json([]);
        }
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $status = $request->sts;
        if ($status == 1) {
            Business::where('id', $id)->update(['status' => 2]);
        } else {
            Business::where('id', $id)->update(['status' => 1]);
        }
        return true;
    }

    public function businessphotos($userId)
    {
        $allbusinessphotos = Businessphoto::where('user_id', $userId)->get();
        return view('dashboard.business.businessphoto', compact('userId', 'allbusinessphotos'));
    }

    public function save_business_photo(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'imageUpload' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', "Please select an Image.");
        } else {
            try {
                $savephoto = new Businessphoto($data);
                if ($savephoto->save()) {
                    if ($request->hasFile('imageUpload')) {
                        $file = $request->file('imageUpload');
                        $extention = $file->getClientOriginalExtension();
                        $filename = time() . '.' . $extention;
                        $file->move(public_path('/storage/images/business_photo'), $filename);
                        $savephoto->update(['image' => $filename]);
                    }
                    return redirect()->back()->with('success', 'Photo successfully saved.');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }

    public function delete_business_photo(Request $request)
    {
        $photo_id = $request->photo_id;
        $business = Businessphoto::where('id', $photo_id)->first();
        $image = public_path("/storage/images/business_photo/$business->image");
        if (!empty($business->image)) {
            if ($image) {
                unlink($image);
            }
        }
        if ($business->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public function businessbank($businessid)
    {
        $banks = DB::table('banks')->get();
        $bankdtls = Business::where('id', $businessid)->select('others')->first();
        $data = $bankdtls->others;
        return view('dashboard.business.businessbank', compact('banks', 'businessid', 'data'));
    }

    public function save_business_bank(Request $request)
    {
        $bankdtls = Business::where('id', $request->hdn_businessId)->select('others')->first();
        $data = $bankdtls->others;
        if (!empty($data)) {
            $bnkDetails = $data;
        } else {
            $bnkDetails = [];
        }

        $user_id = Auth::user()->id;
        $bnkDetails['bank'] = [
            'id' => $request->bank,
            'account_no' => $request->account_no,
            'account_holder' => $request->account_holder,
            'ifsc' => $request->ifsc
        ];

        try {
            $update_bank = Business::where(['user_id' => $user_id, 'id' => $request->hdn_businessId])->update(['others' => $bnkDetails]);
            if ($update_bank) {
                return redirect()->back()->with('success', 'Bank details successfully saved');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function business_trm_cnd($businessid)
    {
        $termsdtls = Business::where('id', $businessid)->select('others')->first();
        $data = $termsdtls->others;
        return view('dashboard.business.businessterm_condition', compact('businessid', 'data'));
    }

    public function save_business_trm_cnd(Request $request)
    {
        $businessId = $request->hdn_businessId;
        $alldata = Business::where('id', $businessId)->select('others')->first();
        $user_id = Auth::user()->id;
        if (!empty($alldata->others)) {
            $data = $alldata->others;
        } else {
            $data = [];
        }
        $data['terms'] = [
            'title' => $request->terms_title,
            'details' => $request->terms_details
        ];
        try {
            $update_terms = Business::where(['user_id' => $user_id, 'id' => $businessId])->update(['others' => $data]);
            if ($update_terms) {
                return redirect()->back()->with('success', 'T & C details successfully saved');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e - getMessage());
        }
    }

    public function business_seo($businessid)
    {
        $seodtls = Business::where('id', $businessid)->select('others')->first();
        $data = $seodtls->others;
        return view('dashboard.business.businessseo', compact('businessid', 'data'));
    }

    public function save_business_seo(Request $request)
    {
        $businessId = $request->hdn_businessId;
        $alldata = Business::where('id', $businessId)->select('others')->first();
        $user_id = Auth::user()->id;
        if (!empty($alldata->others)) {
            $data = $alldata->others;
        } else {
            $data = [];
        }
        $data['seo'] = [
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description
        ];
        try {
            $update_seo = Business::where(['user_id' => $user_id, 'id' => $businessId])->update(['others' => $data]);
            if ($update_seo) {
                return redirect()->back()->with('success', 'SEO details successfully saved');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e - getMessage());
        }
    }

    public function business_gstdetail($businessid)
    {
        $gstdtls = Business::where('id', $businessid)->select('others')->first();
        $data = $gstdtls->others;
        $states = State::get();
        return view('dashboard.business.businessgst_details', compact('businessid', 'data', 'states'));
    }

    public function save_business_gst(Request $request)
    {
        $businessId = $request->hdn_businessId;
        $alldata = Business::where('id', $businessId)->select('others')->first();
        $user_id = Auth::user()->id;
        if (!empty($alldata->others)) {
            $data = $alldata->others;
        } else {
            $data = [];
        }
        $data['gst_info'] = [
            'gst_no' => $request->gst_no,
            'business_name' => $request->business_name,
            'address' => $request->address,
            'state' => $request->state,
            'pin_code' => $request->pin_code,
            'pan_no' => $request->pan_no,
            'name' => $request->name,
            'incorporation_date ' => $request->incorporation_date
        ];
        try {
            $update_gst = Business::where(['user_id' => $user_id, 'id' => $businessId])->update(['others' => $data]);
            if ($update_gst) {
                return redirect()->back()->with('success', 'GST details successfully saved');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e - getMessage());
        }
    }

    public function business_policy($businessid)
    {
        $policydtls = Business::where('id', $businessid)->select('others')->first();
        $data = $policydtls->others;
        return view('dashboard.business.business_policy_details', compact('businessid', 'data'));
    }

    public function save_business_policy(Request $request)
    {
        $businessId = $request->hdn_businessId;
        $alldata = Business::where('id', $businessId)->select('others')->first();
        $user_id = Auth::user()->id;
        if (!empty($alldata->others)) {
            $data = $alldata->others;
        } else {
            $data = [];
        }
        $data['policy'] = [
            'business_policy' => $request->business_policy,
            'cancellation_policy' => $request->cancellation_policy,
            'property_service' => $request->property_service
        ];
        try {
            $update_policy = Business::where(['user_id' => $user_id, 'id' => $businessId])->update(['others' => $data]);
            if ($update_policy) {
                return redirect()->back()->with('success', 'Policy details successfully saved');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e - getMessage());
        }
    }

    public function slug($category_name)
    {
        $slug = strtolower(str_replace(' ', '-', $category_name));
        $slug = strtolower(str_replace('/', '-', $slug));
        return $slug;
    }
}
