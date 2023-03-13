<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Package;
use App\Models\Category;
use App\Models\Menuitem;
use App\Models\Venuetype;

use Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::with(['menuitem', 'venuetype'])->orderBy('id', 'DESC')->get();
        return view('dashboard.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allmenus = Menuitem::where(['status' => 1])->get();
        $items = Menu::where(['status' => 1])->orderBy('id', 'DESC')->get()->append('mediacollection');
        $categories = Category::with('menu')->where(['status' => 1])->get();
        $venueTypes = Venuetype::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('dashboard.package.create', compact('items', 'categories', 'allmenus', 'venueTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'package_name' => 'required|unique:packages',
                'category' => 'required_without_all'
            ]
        );
        $extraitem = [];
        $catarra = $request->category;
        $itemarra = $request->no_of_items;
        $no_of_items = array_combine($catarra, $itemarra);
        if (!empty($request->extraitmQty)) {
            foreach ($request->extraitmQty as $key => $qty) {
                if ($qty > 0) {
                    $extraitem[$request->catId[$key]] = [
                        'qty' => $qty,
                        'price' => $request->extraitmPrice[$key]
                    ];
                }
            }
        }
        $arrdata = array(
            'user_id' => Auth::user()->id,
            // 'category_id' => $catarra,
            'package_name' => $request->package_name,
            'menu_id' => $request->menu_id,
            'no_of_items' => $no_of_items,
            // 'package_type' => $request->package_type,
            'price' => $request->price,
            // 'extra_price_item' => $request->extra_price_item,
            'venue_type' => $request->venue_type,
            'custom_fields' => $extraitem,
            'slug' => $this->slug($request->package_name),
            'status' => $request->status
        );
        try {
            $save = new Package($arrdata);
            $save->save();
            return redirect()->back()->with('success', 'Package successfully saved.');
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
        $package = Package::find($id);

        $allmenus = Menuitem::where(['status' => 1])->get();
        // $categories = Category::with('cuisine')->with('menu')->where(['status'=>1,'user_id'=>Auth::user()->id])->get();
        $menuItems = Menuitem::where('id', $package->menu_id)->first()->append('avaragemenu');
        $venueTypes = Venuetype::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('dashboard.package.edit', compact('package', 'allmenus', 'menuItems', 'venueTypes'));
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
        $catarra = $request->category;
        $itemarra = $request->no_of_items;
        $no_of_items = array_combine($catarra, $itemarra);
        $extraitem = [];
        if (!empty($request->extraitmQty)) {
            foreach ($request->extraitmQty as $key => $qty) {
                if ($qty > 0) {
                    $extraitem[$request->catId[$key]] = [
                        'qty' => $qty,
                        'price' => $request->extraitmPrice[$key]
                    ];
                }
            }
        }
        $arrdata = array(
            //'category_id' => $catarra,
            'package_name' => $request->package_name,
            'menu_id' => $request->menu_id,
            'no_of_items' => $no_of_items,
            // 'package_type' => $request->package_type,
            'price' => $request->price,
            // 'extra_price_item' => $request->extra_price_item,
            'venue_type' => $request->venue_type,
            'custom_fields' => $extraitem,
            'slug' => $this->slug($request->package_name),
            'status' => $request->status
        );
        try {
            $update = Package::where('id', $id)->update($arrdata);
            return redirect()->back()->with('success', 'Package successfully updated.');
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
        if (Package::find($id)->delete()) {
            return redirect()->back()->with('success', 'Package deleted.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function slug($name)
    {
        $slug = strtolower(str_replace(' ', '-', $name));
        $slug = strtolower(str_replace('/', '-', $slug));
        return $slug;
    }

    public function showItems(Request $request)
    {
        $catItems = [];
        $catIds = $request->serviceValue;
        if (!empty($catIds)) {
            foreach ($catIds as $catId) {
                $categories = Category::with('menu')->where('id', $catId)->first()->toArray();
                $catItems[] = $categories;
            }
        }
        $returnData = view('dashboard.package.itemList')->with('catItems', $catItems)->render();
        if (!empty($returnData)) {
            return $returnData;
        } else {
            return false;
        }
    }

    public function menuwisecategory(Request $request)
    {
        $cat_array = array();
        $id = $request->id;
        // return $id;
        $menu = Menuitem::where('id', $id)->first()->append('avaragemenu');
        $menucat = view('dashboard.package.catwiseitems')->with('menu', $menu)->render();
        return $menucat;
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if ($sts == 1) {
            Package::where('id', $id)->update(['status' => 2]);
        } else {
            Package::where('id', $id)->update(['status' => 1]);
        }
        return true;
    }
}