<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Department;

use Session;
use Exception;
use Auth;
use Hash;
use DB;

class AuthenticationController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\MobileUser
     */

    public function vendor_list()
    {
        $vendors = User::role('Vendor')->orderBy('id', 'desc')->get();
        return view('dashboard.vendor.vendor_list', compact('vendors'));
    }
    public function add_vendor()
    {
        return view('dashboard.vendor.add_vendor');
    }

    public function save_vendor(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users',
            'staff_name' => 'required|unique:users',

        ]);
        $vendor_data = array(
            'name' => $request->vendor_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password)

        );
        $staff_name = User::distinct('staff_name')->pluck('staff_name');
        $email = User::distinct('email')->pluck('email');

        try {
            $user = new User($vendor_data);
            if ($user->save()) {
                $user->assignRole(1);
                return redirect()->back()->with('success', 'Vendor successfully saved.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit_vendor($id)
    {
        $user = User::find($id);
        return view('dashboard.vendor.edit_vendor', compact('user'));
    }

    public function update_vendor(Request $request)
    {
        $vendor_data = array(
            'name' => $request->vendor_name,
            'email' => $request->email,
            'mobile' => $request->mobile
        );
        try {
            $user = User::find($request->user_id);
            $update = $user->update($vendor_data);
            if ($update) {
                return redirect()->back()->with('success', 'Vendor successfully updated.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete_vendor(Request $request)
    {
        $user = User::find($request->user_id);
        $delete = $user->delete();
        if ($delete) {
            return redirect()->back()->with('success', 'Vendor Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    //Staff starts here
    public function staff_list()
    {
        $staffs = User::orderBy('id', 'desc')->with('department')->whereHas('roles', function ($query) {
            $query->where('name', '!=', 'Vendor');
        })->get();
        return view('dashboard.staff.staff_list', compact('staffs'));
    }

    public function add_staff()
    {
        $roles = Role::whereNotIn('id', [1])->get();
        $departments = Department::orderBy('id', 'DESC')->pluck('department_name', 'id');
        return view('dashboard.staff.add_staff', compact('roles', 'departments'));
    }

    public function save_staff(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users',
            'mobile' => 'required|unique:users'
        ]);
        $data = array(
            'name' => $request->staff_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'department_id' => $request->department
        );
        try {
            $user = new User($data);
            if ($user->save()) {
                $user->assignRole($request->role);
                return redirect()->back()->with('success', 'Staff successfully saved.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit_staff($id)
    {
        $user = User::find($id);
        $roles = Role::whereNotIn('id', [1])->get();
        $countrole = DB::table('model_has_roles')->where('model_id', $id)->count();
        $departments = Department::orderBy('id', 'DESC')->pluck('department_name', 'id');
        if ($countrole > 0) {
            $userRole = $user->roles->pluck('id')[0];
        } else {
            $userRole = "";
        }
        return view('dashboard.staff.edit_staff', compact('user', 'roles', 'userRole', 'departments'));
    }

    public function update_staff(Request $request)
    {
        $staff_data = array(
            'name' => $request->staff_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'department_id' => $request->department
        );
        try {
            $user = User::find($request->user_id);
            $update = $user->update($staff_data);
            if ($update) {
                $countrole = DB::table('model_has_roles')->where('model_id', $request->user_id)->count();
                if ($countrole > 0) {
                    DB::table('model_has_roles')->where('model_id', $request->user_id)->delete();
                }
                $user->assignRole($request->role);
                return redirect()->back()->with('success', 'Staff successfully updated.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete_staff(Request $request)
    {
        $user = User::find($request->user_id);
        $delete = $user->delete();
        if ($delete) {
            return redirect()->back()->with('success', 'Staff Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    // public function permission()
    // {
    //   $staffPriv = $vendorPriv = [];
    //   $staff_privilige = DB::table('role_has_permissions')->select('permission_id')->where('role_id',2)->get();
    //     if(!empty($staff_privilige)){
    //       foreach($staff_privilige as $staff_pri){
    //         $staffPriv[] = $staff_pri->permission_id;
    //       }
    //     }

    //     $vendor_privilige = DB::table('role_has_permissions')->select('permission_id')->where('role_id',1)->get();
    //     if(!empty($vendor_privilige)){
    //       foreach($vendor_privilige as $vendor_pri){
    //         $vendorPriv[] = $vendor_pri->permission_id;
    //       }
    //     }
    //   $permissions = Permission::orderBy('id','ASC')->get();
    //   return view('dashboard.module_permission',compact('permissions','staffPriv','vendorPriv'));
    // }

    public function staff_permission(Request $request)
    {
        $role = Role::findById($request->role_id);
        if ($request->isChecked == "yes") {
            $is_assigned = $role->givePermissionTo($request->permission_id);
            if ($is_assigned) {
                return "added";
            }
        } else {
            $remove_permission = $role->revokePermissionTo($request->permission_id);
            if ($remove_permission) {
                return "removed";
            }
        }
    }

    // public function vendor_permission(Request $request)
    // {
    //   $role = Role::where('name','vendor')->first();
    //    if($request->isChecked == "yes"){
    //       $is_assigned = $role->givePermissionTo($request->permission_id);
    //       if($is_assigned){
    //            return "added";
    //          }
    //       }else{
    //           $remove_permission = $role->revokePermissionTo($request->permission_id);
    //           if($remove_permission){
    //                return "removed";
    //             }
    //       }
    // }

    public function change_password(Request $request)
    {
        if ($request->isMethod('post')) {
            $new_password = Hash::make($request->new_password);

            try {
                $updatepassword = User::where('id', Auth::user()->id)->update(['password' => $new_password]);
                if ($updatepassword) {
                    return redirect()->back()->with('success', 'Password Changed Successfully');
                } else {
                    return redirect()->back()->with('error', 'Something went wrong');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {
            $user = User::find(Auth::user()->id);
            return view('dashboard.change_password', compact($user));
        }
    }
}
