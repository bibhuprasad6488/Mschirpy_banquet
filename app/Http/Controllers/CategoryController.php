<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\TaxCategory;
use App\Models\Cuisine;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxsubcat = TaxCategory::orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('dashboard.category.index', compact('categories','taxsubcat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuisines = Cuisine::where(['status' => 1])->orderBy('id', 'DESC')->get();
        $taxsubcat = TaxCategory::orderBy('id', 'DESC')->get();
        // dd($taxsubcat);
        return view('dashboard.category.create', compact('cuisines','taxsubcat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cuisineData = [];
        $data = $request->all();
        $this->validate($request, ['category_name' => 'required|unique:categories']);

        $cuisines = Cuisine::whereIn('id', $request->cuisines_id)->get();
        if (!empty($cuisines)) {
            foreach ($cuisines as $key => $val) {
                $cuisineData[$val->id] = $val->cuisine_name;
            }
        }
        $data['cuisines_id'] = $cuisineData;
        $data['tax_type'] = $data['tax_type'];
        // $data['tax_percent'] = $data['tax_percent'];
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = $this->slug($data['category_name']);
        try {
            $saveCat = new Category($data);
            $saveCat->save();
            return redirect()->back()->with('success', 'Category successfully saved.');
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
        $category = Category::find($id);
        $taxsubcat = TaxCategory::orderBy('id', 'DESC')->get();
        // dd($category);
        $cuisines = Cuisine::orderBy('id', 'DESC')->get();
        return view('dashboard.category.edit', compact('category', 'cuisines','taxsubcat'));
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
        $cuisineData = [];
        $data = $request->all();
        $cuisines = Cuisine::whereIn('id', $request->cuisines_id)->get();
        if (!empty($cuisines)) {
            foreach ($cuisines as $key => $val) {
                $cuisineData[$val->id] = $val->cuisine_name;
            }
        }
        try {
            $catUpdate = Category::where('id', $id)->update(
                [
                    'category_name' => $request->category_name,
                    'cuisines_id' => $cuisineData,
                    'type' => $request->type,
                    'tax_type' => $request->tax_type,
                    // 'tax_percent' => $request->tax_percent,
                    'slug' => $this->slug($request->category_name),
                    'status' => $request->status
                ]
            );
            return redirect()->back()->with('success', 'Category successfully updated.');
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
        if (Category::find($id)->delete()) {
            return redirect()->back()->with('success', 'Category deleted.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function slug($category_name)
    {
        $slug = strtolower(str_replace(' ', '-', $category_name));
        $slug = strtolower(str_replace('/', '-', $slug));
        return $slug;
    }

    public function change_status(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if ($sts == 1) {
            Category::where('id', $id)->update(['status' => 2]);
        } else {
            Category::where('id', $id)->update(['status' => 1]);
        }
        return true;
    }

    public function showCuisines(Request $request)
    {
        $dataId = $request->dataId;
        $cuisine_data = Category::find($dataId);
        $cusData = $cuisine_data->cuisines_id;
        return $cusData;
    }
}
