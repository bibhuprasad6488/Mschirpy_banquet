<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;

use App\Models\Supplier;
use App\Models\IngredientCategory;
use Illuminate\Http\Request;
use Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('id', 'DESC')->get();
        return view('dashboard.supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = IngredientCategory::where('status', 'active')->orderBy('id', 'DESC')->pluck('category_name', 'id');
        return view('dashboard.supplier.create', compact('cats'));
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
        $data['valid_from'] = date('Y-m-d', strtotime($request->valid_from));
        $data['valid_to'] = date('Y-m-d', strtotime($request->valid_to));
        $data['bank_details'] = ['bank_name' => $request->bank_name, 'account_no' => $request->account_no, 'ifsc_code' => $request->ifsc_code, 'gstin' => $request->gstin];
        try {
            $save = new Supplier($data);
            $save->save();
            return redirect()->back()->with('success', 'Supplier successfully saved.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $cats = IngredientCategory::where('status', 'active')->orderBy('id', 'DESC')->pluck('category_name', 'id');
        return view('dashboard.supplier.edit', compact('supplier', 'cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        try {

            $data = $supplier->bank_details;
            $data['bank_name'] = $request->bank_name;
            $data['account_no'] = $request->account_no;
            $data['ifsc_code'] = $request->ifsc_code;
            $data['gstin'] = $request->gstin;

            $supplier->update(
                [
                    'supplier_name' => $request->supplier_name,
                    'cat_id' => $request->cat_id,
                    'contact_no' => $request->contact_no,
                    'email' => $request->email,
                    'valid_from' => date('Y-m-d', strtotime($request->valid_from)),
                    'valid_to' => date('Y-m-d', strtotime($request->valid_to)),
                    'address' => $request->address,
                    'bank_details' => $data,
                    'status' => $request->status
                ]
            );
            return redirect()->back()->with('success', 'Supplier successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        if ($supplier->delete()) {
            return redirect()->back()->with('success', 'Supplier deleted.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if ($sts == 'active') {
            Supplier::where('id', $id)->update(['status' => 'inactive']);
        } else {
            Supplier::where('id', $id)->update(['status' => 'active']);
        }
        return true;
    }

    public function show_supplier_cats(Request $request)
    {
        $supplier = Supplier::where('id', $request->supp_id)->first();
        $allcats = IngredientCategory::whereIn('id', $supplier->cat_id)->get();
        return $allcats;
    }

    public function url_generate(Request $request)
    {
        $encrypted_id =Crypt::encrypt($request->supp_id);
        $encodeUrl = "http://venuetomenu.com/supplier/price-chart/" . $encrypted_id;
        $data['encodeurl'] =  $encodeUrl;
        $data['sup_id'] = $request->supp_id;
        return $data;
    }

    public function save_supplier_url(Request $request)
    {
        $supplier = Supplier::where('id', $request->hdnSup_id)->first();
        $details = $supplier->bank_details;
        $details['supplier_url'] = $request->url;
        $supplier->update(['bank_details' => $details]);
        return redirect()->back()->with('success', 'Supplier URL updated');
    }
}