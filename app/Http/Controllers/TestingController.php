<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use App\Models\State;
use App\Models\City;
use Carbon\Carbon;
use DB;

class TestingController extends Controller
{
    public function create_role()
    {
        
    }

    public function create_permission()
    {
        // Categories
        // Permission::create(['name' => 'categories.read']);
        // Permission::create(['name' => 'categories.write']);
        // Permission::create(['name' => 'categories.delete']);

        //Sub Categories
        // Permission::create(['name' => 'sub_categories.read']);
        // Permission::create(['name' => 'sub_categories.write']);
        // Permission::create(['name' => 'sub_categories.delete']);

        //Venues
        // Permission::create(['name' => 'venues.read']);
        // Permission::create(['name' => 'venues.write']);
        // Permission::create(['name' => 'venues.delete']);

       // Items
        // Permission::create(['name' => 'items.read']);
        // Permission::create(['name' => 'items.write']);
        // Permission::create(['name' => 'items.delete']);

        //Packages
        // Permission::create(['name' => 'packages.read']);
        // Permission::create(['name' => 'packages.write']);
        // Permission::create(['name' => 'packages.delete']);

       // Cuisines
        // Permission::create(['name' => 'cuisine.read']);
        // Permission::create(['name' => 'cuisine.write']);
        // Permission::create(['name' => 'cuisine.delete']);

       // Staff
       // Permission::create(['name' => 'staff.read']);
       // Permission::create(['name' => 'staff.write']);
       // Permission::create(['name' => 'staff.delete']);

       // Vendor
       // Permission::create(['name' => 'vendor_list.read']);
       // Permission::create(['name' => 'vendor_list.write']);
       // Permission::create(['name' => 'vendor_list.delete']);

       //Roles
       // Permission::create(['name' => 'role.read']);
       // Permission::create(['name' => 'role.write']);
       // Permission::create(['name' => 'role.delete']);

       //Menu
       // Permission::create(['name' => 'menu.read']);
       // Permission::create(['name' => 'menu.write']);
       // Permission::create(['name' => 'menu.delete']);

      //Venue Type
       Permission::create(['name' => 'venue_type.read']);
       Permission::create(['name' => 'venue_type.write']);
       Permission::create(['name' => 'venue_type.delete']);

        //permission
       //Permission::create(['name' => 'permission_list']);
    }

    // public function role_permission()
    // {
    //     $role = Role::where('name', 'super_admin')->first();
    //     $permissions = Permission::whereIn('name', [
    //         'staff_list',
    //         'vendor_list',
    //         'permission_list'
    //     ])->get();
    //     foreach ($permissions as $key => $permission) {
    //         $permission->assignRole($role);
    //     }

        // $user = User::find(1);
        // $user->assignRole('super_admin');
    //}

    public function addPermission()
    {
        $getall = Permission::get();
        foreach ($getall as $key => $value) {
            DB::table('role_has_permissions')->insert(
                array(
                    'permission_id'  => $value->id, 
                    'role_id'   =>3
                 )
            );
        }
    }

    public function testdate()
    {
          // $currentMonth = date("F", strtotime ( date( 'Y-m-d' ))) ;
          // $months = [$currentMonth];
          // for ($i = 1; $i <= 12; $i++) 
          // {
          //  $year = date("Y", strtotime( date( 'Y-m-d' )." -$i years"));
          //    $months[$year] = date("F", strtotime( date( 'Y-m-d' )." -$i months"));
          // }
          // dd($months);
        // echo implode(",",$months);
      $state =  array
        (
            '1' => 'Andaman & Nicobar [AN]',
            '2' => 'Andhra Pradesh [AP]',
            '3' => 'Arunachal Pradesh [AR]',
            '4' => 'Assam [AS]',
            '5' => 'Bihar [BH]',
            '6' => 'Chandigarh [CH]',
            '7' => 'Chhattisgarh [CG]',
            '8' => 'Dadra & Nagar Haveli [DN]',
            '9' => 'Daman & Diu [DD]',
            '10' => 'Delhi [DL]',
            '11' => 'Goa [GO]',
            '12' => 'Gujarat [GU]',
            '13' => 'Haryana [HR]',
            '14' => 'Himachal Pradesh [HP]',
            '15' => 'Jammu & Kashmir [JK]',
            '16' => 'Jharkhand [JH]',
            '17' => 'Karnataka [KR]',
            '18' =>' Kerala [KL]',
            '19' => 'Lakshadweep [LD]',
            '20' => 'Madhya Pradesh [MP]',
            '21' => 'Maharashtra [MH]',
            '22' => 'Manipur [MN]',
            '23' => 'Meghalaya [ML]',
            '24' => 'Mizoram [MM]',
            '25' => 'Nagaland [NL]',
            '26' => 'Odisha [OD]',
            '27' => 'Pondicherry [PC]',
            '28' => 'Punjab [PJ]',
            '29' => 'Rajasthan [RJ]',
            '30' => 'Sikkim [SK]',
            '31' => 'Tamil Nadu [TN]',
            '32' => 'Tripura [TR]',
            '33' => 'Uttar Pradesh [UP]',
            '34' => 'Uttaranchal [UT]',
            '35' =>' West Bengal [WB]'
        );
        foreach($state as $k=> $sta){
          $inputs = ['name'=>$sta];
          State::create($inputs);
        }
    }

    public function testFor()
    {
      $arr['aps'] = [
        'alert'=>['title'=>'Title Here','body'=>'Body Here','subTitle'=>['name'=>'Ranjit','amount'=>'1000']],
        'category'=>'Huge category'
      ];
      $arr['game_id']="fff";
      dd(json_encode($arr));
    }

    public function nnnn()
    {
        $to = 'bibhu.prasad6488@gmail.com';
        $to_names = 'Bibhu Prasad';
        $subject = 'For Testing Purpose';
        $text = 'Testing Success';
      $r = $this->send_grid_email($to, $to_names, $subject, $text, $attachment = null, $filename = null);
      dd($r);
    }

  public  function send_grid_email($to, $to_names, $subject, $text, $attachment = null, $filename = null)
{

    // echo $to.$to_names.$subject; die;
   
    $curl = curl_init();
    $params = array();
    $params['api_user'] = "harminderEMX";
    $params['api_key'] = "Harminder@123";
    $params['from'] = "noreply@mschirpy.com";
    $params['subject'] = $subject;
    $params['html'] = stripcslashes($text);

    $params['to'] = $to;

    $params['toname'] = $to_names;

    if (!empty($attachment)) {

        $imagedata = file_get_contents($attachment);

        $params['files[' . $filename . ']'] = $imagedata;
    }



    $query = http_build_query($params);

    curl_setopt_array($curl, array(CURLOPT_URL => "https://api.sendgrid.com/api/mail.send.json", CURLOPT_HEADER => false, CURLOPT_SSLVERSION => 'CURL_SSLVERSION_TLSv1_2', CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => "", CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 300, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "POST", CURLOPT_POSTFIELDS => $query, CURLOPT_HTTPHEADER => array("cache-control: no-cache",),));



    $response = curl_exec($curl);

    $err = curl_error($curl);



    curl_close($curl);

    return true;
}

}
