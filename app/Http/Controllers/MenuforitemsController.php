<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Menuitem;
use App\Models\Menu;
use App\Models\Venuetype;

use Auth;

class MenuforitemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menuitem::with('venuetype')->get();


        return view('dashboard.menu_for_items.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::where(['status' => 1])->with('menu')->get();

        $venueTypes = Venuetype::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('dashboard.menu_for_items.create', compact('categories', 'venueTypes'));
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
        $this->validate(
            $request,
            [
                'title' => 'required|unique:menu_for_items',
            ]
        );

        $data['user_id'] = Auth::user()->id;
        $title = Menuitem::distinct('title')->pluck('title');
        try {
            $saveCat = new Menuitem($data);
            $saveCat->save();
            return redirect()->back()->with('success', 'Menu successfully saved.');
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
        $categories = Category::where(['status' => 1])->with('menu')->get();
        $menu = Menuitem::find($id);
        $venueTypes = Venuetype::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('dashboard.menu_for_items.edit', compact('menu', 'categories', 'venueTypes'));
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
        $title = $request->title;
        $items = $request->items;
        $price = $request->price;
        $status = $request->status;
        $venuetype = $request->venue_type;
        $menu_type = $request->menu_type;
        try {
            $update = Menuitem::where('id', $id)->update([
                'title' => $title,
                'items' => $items,
                'price' => $price,
                'status' => $status,
                'venue_type' => $venuetype,
                'menu_type' => $menu_type
            ]);
            return redirect()->back()->with('success', 'Menu successfully updated.');
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
        if (Menuitem::find($id)->delete()) {
            return redirect()->back()->with('success', 'Menu deleted.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function showallitems(Request $request)
    {
        $blankarr = array();
        $items = json_decode($request->valArr, true);
        $allItems = Menu::whereIn('id', $items)->get();
        foreach ($allItems as $item) {
            $blankarr[$item->name] = $item->image;
        }
        return $blankarr;
    }
    public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if ($sts == 1) {
            Menuitem::where('id', $id)->update(['status' => 2]);
        } else {
            Menuitem::where('id', $id)->update(['status' => 1]);
        }
        return true;
    }
    public function changestatus(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if ($sts == 1) {
            Menuitem::where('id', $id)->update(['status' => 2]);
        } else {
            Menuitem::where('id', $id)->update(['status' => 1]);
        }
        return true;
    }
}
