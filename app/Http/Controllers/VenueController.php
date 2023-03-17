<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Package;
use App\Models\Venuetype;
use App\Models\Amenity;
use App\Models\VenueImage;
use App\Libraries\CustomData;
use DB;
use Auth;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::with('venuetype')->orderBy('id', 'DESC')->get();
        return view('dashboard.venue.index', compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::where(['status' => 1])->orderBy('id', 'DESC')->get();
        $venueTypes = Venuetype::orderBy('id', 'DESC')->where('status', 1)->get();
        $amenities = Amenity::where(['status' => 1])->orderBy('id', 'DESC')->get();
        return view('dashboard.venue.create', compact('packages', 'venueTypes', 'amenities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['user_id'] = Auth::user()->id;
        $data['package_id'] = $request->package_id;
        $data['venue_name'] = $request->venue_name;
        $data['venue_type'] = $request->venue_type;
        $data['slug'] = $this->slug($request->venue_name);
        $data['status'] = $request->status;
        $data['max_people'] = $request->max_people;

        $data['custom_fields']['setting'] = $request->setting;
        $data['custom_fields']['floating'] = $request->floating;
        $data['custom_fields']['amenity'] = $request->amenity_id;
        $data['custom_fields']['address'] = $request->address;

        $is_exist_venue = Venue::where(['venue_name' => $request->venue_name, 'venue_type' => $request->venue_type])->get()->count();
        if ($is_exist_venue > 0) {
            return redirect()->back()->with('error', "Venue name is already exist, Please try different one");
        } else {
            try {
                $save = new Venue($data);
                $venueSave = $save->save();
                $imagearray = [];
                if ($venueSave) {
                    if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $img) {
                        $file=$img;
                        $extention=$file->getClientOriginalExtension();
                        $filename=time().rand().'.'.$extention;
                        $file->move(public_path('/storage/images/venues'),$filename);
                        array_push(
                            $imagearray,array(
                                'venue_id' => $save->id,
                                'user_id' => $save->user_id,
                                'image' => $filename,
                                'created_at' => now(),
                                'updated_at' => now()
                            )
                        );
                    }
                    }
                $venueimgSave = VenueImage::insert($imagearray);
                }
                if($venueimgSave){
                return redirect()->back()->with('success', 'Venue successfully saved.');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
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
        $venue = Venue::where('id', $id)->with('venueimage')->first();
         // dd($venue);
        $packages = Package::where('status', 1)->orderBy('id', 'DESC')->get();
        $venueTypes = Venuetype::orderBy('id', 'DESC')->where('status', 1)->get();
        $amenities = Amenity::where('status', 1)->orderBy('id', 'DESC')->get();
        $venueImages = VenueImage::where('venue_id', $id)->orderBy('id', 'DESC')->get();

        return view('dashboard.venue.edit', compact('venue', 'packages', 'venueTypes', 'amenities'));
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
        $data['user_id'] = Auth::user()->id;
        $data['package_id'] = $request->package_id;
        $data['venue_name'] = $request->venue_name;
        $data['venue_type'] = $request->venue_type;
        $data['slug'] = $this->slug($request->venue_name);
        $data['status'] = $request->status;
        $data['max_people'] = $request->max_people;

        $data['custom_fields']['setting'] = $request->setting;
        $data['custom_fields']['floating'] = $request->floating;
        $data['custom_fields']['amenity'] = $request->amenity_id;
        $data['custom_fields']['address'] = $request->address;
        try {
            $Updatevenues = Venue::where('id', $id)->first();
            $Updatevenues->update($data);
            $imagearr = [];
            if ($Updatevenues) {
                if ($request->hasFile('venue_image')) {
                    foreach ($request->file('venue_image') as $img) {
                        $file=$img;
                        $extention=$file->getClientOriginalExtension();
                        $filename=time().rand().'.'.$extention;
                        $file->move(public_path('/storage/images/venues'),$filename);

                        array_push(
                            $imagearr,array(
                                'venue_id' => $Updatevenues->id,
                                'user_id' => $Updatevenues->user_id,
                                'image' => $filename,
                                'created_at' => now(),
                                'updated_at' => now()
                        )
                    );
                    }
                }
                $imgSave = VenueImage::insert($imagearr);
            }
            if($imgSave){
            return redirect()->back()->with('success', 'Venue successfully updated.');
            }
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
        $venue =  Venue::find($id);
        $venue_img_dlt = VenueImage::where('venue_id',$venue->id)->get();
       foreach ($venue_img_dlt as $venue_img){  
        $venueImage = public_path("/storage/images/venues/$venue_img->image"); // get previous image from folder
        if ($venueImage) { // unlink or remove previous image from folder
            $isDel = unlink($venueImage);
            if($isDel){
                $venue_img->delete();
            }
        }
       }
        if ($venue->delete()) {
            return redirect()->back()->with('success', 'Venue deleted.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function change_sts(Request $request)
    {
        $id = $request->id;
        $sts = $request->sts;
        if ($sts == 1) {
            Venue::where('id', $id)->update(['status' => 2]);
        } else {
            Venue::where('id', $id)->update(['status' => 1]);
        }
        return true;
    }

    public function slug($param)
    {
        $slug = strtolower(str_replace(' ', '-', $param));
        $slug = strtolower(str_replace('/', '-', $slug));
        return $slug;
    }
    public function showallimages(Request $request)
    {
        $venueimages = VenueImage::where('venue_id', $request->dataId)->get();
        $images = [];
        foreach ($venueimages as $v) {
            $images[] = $v->image;
        }
        return $images;
    }

    public function showallamenity(Request $request)
    {
        $venue = Venue::find($request->dataId);
        return $venue->amenity_datas;
    }
    public function deleteImages(Request $request)
    {
        $dataId = $request->dataId;
        $venue_img_dlt = VenueImage::where('id',$dataId)->first();
        $venueImage = public_path("/storage/images/venues/$venue_img_dlt->image"); // get previous image from folder
                if ($venueImage) { // unlink or remove previous image from folder
                    unlink($venueImage);
                }
        if ($venue_img_dlt->delete()) {
            return redirect()->back()->with('success', 'Venue Image Deleted');
        } else {
            return redirect()->back()->with('error', 'Venue Image Not Deleted');
        }
    }
}