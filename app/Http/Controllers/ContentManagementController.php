<?php

namespace App\Http\Controllers;

use App\Models\ContentManagement;
use App\Models\Page;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;
use Image;

class ContentManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = ContentManagement::with('page')->get();
        return view('dashboard.manage_content.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Page::orderBy('id', 'DESC')->get();
        return view('dashboard.manage_content.create', compact('pages'));
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
        $this->validate($request, [
            'page_id' => 'required|unique:content_management'
        ]);
        $page = Page::where('id', $data['page_id'])->first();
        $page_name = $page->page_name;
        $data['others'] =  $this->slug($page_name);
        $data['user_id'] = Auth::user()->id;

        try {
            $save = new ContentManagement($data);
            $save->save();
            if ($save) {
                if ($request->hasFile('image')) {
                    $file=$request->file('image');
                    $extention=$file->getClientOriginalExtension();
                    $filename=time().'.'.$extention;
                    $file->move(public_path('/storage/images/content_images'),$filename);
                    $save->update(['image'=>$filename]);
                }
            }
            return redirect()->back()->with('success', 'Content successfully saved.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContentManagement  $contentManagement
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContentManagement  $contentManagement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contents = ContentManagement::with('page')->where('id', $id)->first();
        return view('dashboard.manage_content.edit', compact('contents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContentManagement  $contentManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        try {
            $contents = ContentManagement::where('id', $request->id)->first();
            $contents->update($data);
            if ($request->hasFile('image_file')) {
                $itemsImage = public_path("/storage/images/content_images/$contents->image"); // get previous image from folder
                if ($itemsImage) { // unlink or remove previous image from folder
                    unlink($itemsImage);
                }
                $file=$request->file('image_file');
                $extention=$file->getClientOriginalExtension();
                $filename=time().'.'.$extention;
                $file->move(public_path('/storage/images/content_images'),$filename);
                $contents->update(['image'=>$filename]);
            }
            return redirect()->back()->with('success', 'Content successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContentManagement  $contentManagement
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        try {
            $deleteqry = ContentManagement::where('id', $request->id)->first();
            $itemsImage = public_path("/storage/images/content_images/$deleteqry->image"); // get previous image from folder
                if ($itemsImage) { // unlink or remove previous image from folder
                    unlink($itemsImage);
                }
            if ($deleteqry->delete()) {
                return redirect()->back()->with('success', 'Content Delete Successfully');
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    // For Page Management Methods 

    public function create_page(Request $request)
    {
        $pages = Page::orderBy('id', 'DESC')->get();
        return view('dashboard.page.index', compact('pages'));
    }
    public function page_create()
    {
        return view('dashboard.page.create');
    }

    // Page Data Store
    public function store_page(Request $request)
    {
        $pagename = $request->page_name;
         $this->validate($request,[
        'page_name'=>'required|unique:pages'
        ]
        );
        $data['user_id'] = Auth::user()->id;
        // $data['venue_type'] = $request->venue_type;
        try {
            foreach ($pagename as $key => $value) {
                $data['page_name'] = $value;
                $data['others'] = $this->slug($value);
                $save = new Page($data);
                $save->save();
            }

            return redirect()->back()->with('success', 'Page successfully saved.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function edit_page($id)
    {
        $pages = Page::find($id);
        // dd($pages);
        return view('dashboard.page.edit', compact('pages'));
    }
    public function update_page(Request $request)
    {
        try {
            $upadteqry = Page::where('id', $request->id)->update(['page_name' => $request->page_name]);
            if ($upadteqry) {
                return redirect()->back()->with('success', 'Page successfully updated.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function delete_page(Request $request)

    {
        try {
            $deleteqry = Page::where('id', $request->id)->delete();
            if ($deleteqry) {
                return redirect()->back()->with('success', 'Page Delete Successfully');
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function slug($name)
    {
        $slug = strtolower(str_replace(' ', '-', $name));
        $slug = strtolower(str_replace('/', '-', $slug));
        return $slug;
    }

    public function faq()
    {
        $faq = Faq::orderBy('id', 'DESC')->get();
        // dd($faq);
        return view('dashboard.faq.index', compact('faq'));
    }

    public function Faq_create()
    {
        return view('dashboard.faq.create');
    }

    public function faq_store(Request $request)
    {
        $data = $request->all();
        try {
            $faq = new Faq($data);
            $faq->save();
            return redirect()->back()->with('success', 'FAQ successfully created.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function faq_edit($id)
    {
        $faqs = Faq::find($id);
        return view('dashboard.faq.edit', compact('faqs'));
    }

    public function faq_update(Request $request)
    {

        $data = $request->all();

        try {
            $faqs = Faq::where('id', $request->id)->first();
            $faqs->update($data);

            if ($faqs) {
                return redirect()->back()->with('success', 'faq successfully updated.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function faq_delete(Request $request)
    {

        try {
            $deletefaq = Faq::where('id', $request->id)->delete();
            if ($deletefaq) {
                return redirect()->back()->with('success', 'Faq Delete Successfully');
            } else {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}