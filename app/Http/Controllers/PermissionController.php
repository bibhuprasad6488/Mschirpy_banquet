<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Session;
use Exception;
use Auth;
use Hash;
use DB;

class PermissionController extends Controller
{
public function add_roles(Request $request)
{
	if($request->isMethod('post')){
		$name = $request->name;
		if(empty($request->hiddenId)){
			$this->validate($request,[
            'name' => 'required|unique:roles'
             ]
	    );
	    try{
		    $roleObj = new Role(['name'=> $name]);
	        $store = $roleObj->save();
    		return redirect()->back()->with('success','Role created successfully');
		    }catch(\Exception $e){
		    	return redirect()->back()->with('error',$e->getMessage());
		    }
		}else{
			$role = Role::find($request->hiddenId);
			$update = $role->update(['name'=>$name]);
			if($update){
				return redirect()->back()->with('success','Role updated successfully');
			}else{
				return redirect()->back()->with('error','Something went wrong');
			}
		}
		
		
	}else{
		$permissions = Permission::orderBy('id','ASC')->get();
		return view('dashboard.roles.add_roles',compact('permissions'));
	}
	
}

public function manage_roles()
{
	$permissions = Permission::orderBy('id','ASC')->get();
	$roles = Role::orderBy('id','DESC')->get();

	return view('dashboard.roles.manage_roles',compact('roles','permissions'));
}

public function showpermission(Request $request)
{
	$id = $request->id;
	$rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)
        ->get();
      $data_array = [];
      foreach($rolePermissions as $rolePermission){
      		$data_array[] = $rolePermission->name;
      }
      return response($data_array);
}

public function role_edit($id)
{
	$role = Role::find($id);
	return view('dashboard.roles.edit_roles',compact('role'));
}

public function delete_role(Request $request)
{
	$delete = Role::find($request->hiddenId)->delete();
	if($delete){
		return redirect()->back()->with('success','Role deleted');
	}else{
		return redirect()->back()->with('error','Something went wrong');
	}
}

public function edit_privilige($id)
{
	$permissions = Permission::orderBy('id','ASC')->get();
	$datas = [];
	if(!empty($permissions)){
		foreach($permissions as $allper){
			//For category
			if($allper->name == 'categories.read'){
				$datas['Category'][] =$allper->id;
			}
			if($allper->name == 'categories.write'){
				$datas['Category'][] =$allper->id;
			}
			 if($allper->name == 'categories.delete'){
				$datas['Category'][] =$allper->id;
			}
			//For Sub Category
			if($allper->name == 'sub_categories.read'){
				$datas['Sub Category'][] =$allper->id;
			}
			if($allper->name == 'sub_categories.write'){
				$datas['Sub Category'][] =$allper->id;
			}
			 if($allper->name == 'sub_categories.delete'){
				$datas['Sub Category'][] =$allper->id;
			}
			//For Venues
			if($allper->name == 'venues.read'){
				$datas['Venues'][] =$allper->id;
			}
			if($allper->name == 'venues.write'){
				$datas['Venues'][] =$allper->id;
			}
			 if($allper->name == 'venues.delete'){
				$datas['Venues'][] =$allper->id;
			}
			//For Items
			if($allper->name == 'items.read'){
				$datas['Items'][] =$allper->id;
			}
			if($allper->name == 'items.write'){
				$datas['Items'][] =$allper->id;
			}
			 if($allper->name == 'items.delete'){
				$datas['Items'][] =$allper->id;
			}
			//For Packages
			if($allper->name == 'packages.read'){
				$datas['Packages'][] =$allper->id;
			}
			if($allper->name == 'packages.write'){
				$datas['Packages'][] =$allper->id;
			}
			 if($allper->name == 'packages.delete'){
				$datas['Packages'][] =$allper->id;
			}
			//For Cuisine
			if($allper->name == 'cuisine.read'){
				$datas['Cuisine'][] =$allper->id;
			}
			if($allper->name == 'cuisine.write'){
				$datas['Cuisine'][] =$allper->id;
			}
			 if($allper->name == 'cuisine.delete'){
				$datas['Cuisine'][] =$allper->id;
			}

			//For Staff
			if($allper->name == 'staff.read'){
				$datas['Staff'][] =$allper->id;
			}
			if($allper->name == 'staff.write'){
				$datas['Staff'][] =$allper->id;
			}
			 if($allper->name == 'staff.delete'){
				$datas['Staff'][] =$allper->id;
			}

			//For Vendor
			if($allper->name == 'vendor_list.read'){
				$datas['Vendor'][] =$allper->id;
			}
			if($allper->name == 'vendor_list.write'){
				$datas['Vendor'][] =$allper->id;
			}
			 if($allper->name == 'vendor_list.delete'){
				$datas['Vendor'][] =$allper->id;
			}

			//For Role
			if($allper->name == 'role.read'){
				$datas['Role'][] =$allper->id;
			}
			if($allper->name == 'role.write'){
				$datas['Role'][] =$allper->id;
			}
			 if($allper->name == 'role.delete'){
				$datas['Role'][] =$allper->id;
			}

			//For Menu
			if($allper->name == 'menu.read'){
				$datas['Menu'][] =$allper->id;
			}
			if($allper->name == 'menu.write'){
				$datas['Menu'][] =$allper->id;
			}
			 if($allper->name == 'menu.delete'){
				$datas['Menu'][] =$allper->id;
			}

			//For Venue Type
			if($allper->name == 'venue_type.read'){
				$datas['Venue Type'][] =$allper->id;
			}
			if($allper->name == 'venue_type.write'){
				$datas['Venue Type'][] =$allper->id;
			}
			 if($allper->name == 'venue_type.delete'){
				$datas['Venue Type'][] =$allper->id;
			}
			//Bookings event
			if($allper->name == 'event_booking.read'){
				$datas['Event Bookings'][] =$allper->id;
			}
			if($allper->name == 'event_booking.write'){
				$datas['Event Bookings'][] =$allper->id;
			}
			if($allper->name == 'event_booking.delete'){
				$datas['Event Bookings'][] =$allper->id;
			}

			//Amenity
			if($allper->name == 'amenity.read'){
				$datas['Amenities'][] =$allper->id;
			}
			if($allper->name == 'amenity.write'){
				$datas['Amenities'][] =$allper->id;
			}
			if($allper->name == 'amenity.delete'){
				$datas['Amenities'][] =$allper->id;
			}

			//Business
			if($allper->name == 'manage_business.read'){
				$datas['Manage Business'][] =$allper->id;
			}
			if($allper->name == 'manage_business.write'){
				$datas['Manage Business'][] =$allper->id;
			}
			if($allper->name == 'manage_business.delete'){
				$datas['Manage Business'][] =$allper->id;
			}

			//Brand
			if($allper->name == 'brand.read'){
				$datas['Brand'][] =$allper->id;
			}
			if($allper->name == 'brand.write'){
				$datas['Brand'][] =$allper->id;
			}
			if($allper->name == 'brand.delete'){
				$datas['Brand'][] =$allper->id;
			}

			//Ingredient Item
			if($allper->name == 'ingredient_item.read'){
				$datas['Ingredient Item'][] =$allper->id;
			}
			if($allper->name == 'ingredient_item.write'){
				$datas['Ingredient Item'][] =$allper->id;
			}
			if($allper->name == 'ingredient_item.delete'){
				$datas['Ingredient Item'][] =$allper->id;
			}

			//Ingredient Category
			if($allper->name == 'ingredient_category.read'){
				$datas['Ingredient Category'][] =$allper->id;
			}
			if($allper->name == 'ingredient_category.write'){
				$datas['Ingredient Category'][] =$allper->id;
			}
			if($allper->name == 'ingredient_category.delete'){
				$datas['Ingredient Category'][] =$allper->id;
			}

			//Supplier
			if($allper->name == 'supplier.read'){
				$datas['Supplier'][] =$allper->id;
			}
			if($allper->name == 'supplier.write'){
				$datas['Supplier'][] =$allper->id;
			}
			if($allper->name == 'supplier.delete'){
				$datas['Supplier'][] =$allper->id;
			}

			//Report
			if($allper->name == 'reports.read'){
				$datas['Reports'][] =$allper->id;
			}
		}
	}
	$staffPriv = [];
	 $staff_privilige = DB::table('role_has_permissions')->select('permission_id')->where('role_id',$id)->get();
	if($staff_privilige->count() > 0){
		foreach($staff_privilige as $staff_pri){
            $staffPriv[] = $staff_pri->permission_id;
          }
      }
	return view('dashboard.roles.add_priviliges',compact('datas','staffPriv','id'));
}

}
