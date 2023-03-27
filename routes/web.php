<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
// Route::resource('page', 'ContentManagementController');

Route::get('/test/permission', 'TestingController@create_permission');
Route::get('/testing', 'TestingController@testing');

Route::get('/addPermission', 'TestingController@addPermission');

Route::get('/testdate', 'TestingController@testdate');

Route::get('/testFor', 'TestingController@testFor');

Auth::routes();

Route::group(['middleware' => 'AuthenticateUser'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/staff/login', function () {
        return view('dashboard.staff_login');
    });
    Route::get('/vendor/login', function () {
        return view('dashboard.vendor_login');
    });

    Route::get('/staff_home', 'HomeController@staff_home');
    Route::get('/vendor_home', 'HomeController@vendor_home');
    Route::post('/show_Cuisine', 'CategoryController@showCuisines');


    Route::resource('menu', 'MenuController');
    Route::resource('category', 'CategoryController');
    Route::resource('venue', 'VenueController');
    Route::resource('cuisine', 'CuisineController');
    Route::resource('package', 'PackageController');
    Route::resource('subcategory', 'SubCategoryController');
    Route::resource('/menu_for_items', 'MenuforitemsController');
    Route::resource('/venuetype', 'VenuetypeController');
    Route::resource('/amenity', 'AmenityController');
    Route::resource('/business', 'BusinessController');


    Route::post('/subcategory_change_sts', 'SubCategoryController@change_status');
    Route::post('/amenity_change_status', 'AmenityController@change_status');
    Route::post('/item_category_status', 'MenuController@change_status');
    Route::post('/menu_change_status', 'MenuforitemsController@change_status');
    Route::post('/supplier_change_status', 'SupplierController@change_status');
    Route::post('/ingredient_change_status', 'IngredientItemController@change_status');

    Route::post('/ingredient_category_status', 'IngredientCategoryController@change_status');
    Route::post('/party_change_status', 'PartyController@change_status');
    Route::post('/brand_change_status', 'BrandController@change_status');
    Route::post('/menu_items_status', 'MenuforitemsController@changestatus');
    Route::post('/tax_subcategory_status', 'TaxCategoryController@change_status');
    Route::post('/package_status', 'PackageController@change_status');
    Route::post('/venue_change_sts', 'VenuetypeController@change_sts');
    Route::post('/venue_sts', 'VenueController@change_sts');
    Route::post('/add_category_to_booked_items', 'CommonController@add_category_to_booked_items');



    Route::resource('ingredient_category', 'IngredientCategoryController');
    Route::resource('/ingredient-item', 'IngredientItemController');
    Route::resource('/supplier', 'SupplierController');
    Route::resource('/party', 'PartyController');
    Route::resource('/brand', 'BrandController');
    Route::resource('/tax_category', 'TaxCategoryController');
    Route::get('/taxcreate_subcategory', 'TaxCategoryController@create_tax_subcategory');
    Route::post('/store_subcat', 'TaxCategoryController@save_sub_cat');
    Route::get('/list_subcat', 'TaxCategoryController@list_subcat');
    Route::get('/edit_subcat/{id}', 'TaxCategoryController@edit_subcat');
    Route::post('/update_subcat', 'TaxCategoryController@update_subcat');
    Route::post('/dlt_subcat', 'TaxCategoryController@dlt_subcat');

    Route::post('/set_brand_default', 'BrandController@set_brand_default');
    Route::post('/change_dept_brand', 'IngredientItemController@change_dept_brand');
    Route::prefix('supplier')->group(function () {
        Route::post('/change_validity', 'IngredientItemController@change_validity');
        Route::post('/view_history', 'IngredientItemController@view_history');
        Route::post('/show_supplier_cats', 'SupplierController@show_supplier_cats');
        Route::post('/save_final_price', 'IngredientItemController@save_final_price');
        Route::post('/show_department', 'IngredientItemController@show_department');
        Route::post('/item_wise_brand', 'IngredientItemController@item_wise_brand');
        Route::post('/url_generate', 'SupplierController@url_generate');
        Route::post('/save_supplier_url', 'SupplierController@save_supplier_url');
    });

    Route::prefix('report')->group(function () {
        Route::any('/price_chart_report', 'CommonController@price_chart_report');
        Route::post('/price_chart_show', 'CommonController@price_chart_show');
        Route::get('/view_book_data/{id}', 'CommonController@view_book_data');
        Route::get('/booking-report', 'Front\IndexController@booking_reports');
        Route::post('/export_booking_report', 'CommonController@export_booking_report');
    });


    Route::any('/add_department', 'CommonController@add_department');
    Route::get('/edit_department/{id}', 'CommonController@edit_department');
    Route::post('/update_department', 'CommonController@update_department');
    Route::post('/department_change_status', 'CommonController@change_status');
    Route::post('/delete_department', 'CommonController@delete_department');
    Route::get('/show_review', 'CommonController@show_review');

    Route::get('/department_list', 'CommonController@department_list');
    Route::get('/price-chart', 'IngredientItemController@price_chart');
    Route::get('/export_price_chart', 'IngredientItemController@price_chart');
    Route::post('/statewisecitychange', 'BusinessController@state_wise_city_change');
    Route::post('/change_status', 'BusinessController@change_status');
    Route::get('/businessphotos/{businessid}', 'BusinessController@businessphotos');
    Route::post('/save_business_photo', 'BusinessController@save_business_photo');
    Route::post('/delete_business_photo', 'BusinessController@delete_business_photo');
    Route::get('/businessbank/{businessid}', 'BusinessController@businessbank');
    Route::post('/save_business_bank', 'BusinessController@save_business_bank');
    Route::get('/business_trm_cnd/{businessid}', 'BusinessController@business_trm_cnd');
    Route::post('/save_business_trm_cnd', 'BusinessController@save_business_trm_cnd');
    Route::get('/business_seo/{businessid}', 'BusinessController@business_seo');
    Route::post('/save_business_seo', 'BusinessController@save_business_seo');
    Route::get('/business_gstdetail/{businessid}', 'BusinessController@business_gstdetail');
    Route::post('/save_business_gst', 'BusinessController@save_business_gst');
    Route::get('/business_policy/{businessid}', 'BusinessController@business_policy');
    Route::post('/save_business_policy', 'BusinessController@save_business_policy');
    Route::post('/catItems', 'PackageController@showItems');
    Route::post('/cat', 'MenuController@cat_wise_cuisine');
    Route::post('/showallitems', 'MenuforitemsController@showallitems');
    Route::post('/showallimages', 'VenueController@showallimages');
    Route::post('/showallamenity', 'VenueController@showallamenity');
    Route::post('/deleteImage', 'VenueController@deleteImages');
    Route::post('/menuwisecategory', 'PackageController@menuwisecategory');

    Route::get('/vendor_list', 'AuthenticationController@vendor_list');
    Route::get('/edit_vendor/{id}', 'AuthenticationController@edit_vendor');
    Route::get('/add_vendor', 'AuthenticationController@add_vendor');
    Route::post('/save_vendor', 'AuthenticationController@save_vendor');
    Route::post('/update_vendor', 'AuthenticationController@update_vendor');
    Route::post('/delete_vendor', 'AuthenticationController@delete_vendor');

    Route::get('/add_staff', 'AuthenticationController@add_staff');
    Route::post('/save_staff', 'AuthenticationController@save_staff');
    Route::get('/staff_list', 'AuthenticationController@staff_list');
    Route::get('/edit_staff/{id}', 'AuthenticationController@edit_staff');
    Route::post('/update_staff', 'AuthenticationController@update_staff');
    Route::post('/delete_staff', 'AuthenticationController@delete_staff');
    Route::get('/itemlist', 'HomeController@itemlist');
    Route::get('/permission', 'AuthenticationController@permission');
    Route::post('/save_staff_permission', 'AuthenticationController@staff_permission');
    Route::post('/save_vendor_permission', 'AuthenticationController@vendor_permission');
    Route::any('/change_password', 'AuthenticationController@change_password');
    Route::any('/add_roles', 'PermissionController@add_roles');
    Route::get('/manage_roles', 'PermissionController@manage_roles');
    Route::get('/role_edit/{id}', 'PermissionController@role_edit');
    Route::post('/delete_roles', 'PermissionController@delete_role');
    Route::get('/edit_privilige/{id}', 'PermissionController@edit_privilige');
    Route::post('/showpermission', 'PermissionController@showpermission');
    Route::get('/customer_list', 'HomeController@customer_list');
    Route::get('create-event', 'EventBookingController@create_event');
    Route::post('/save_event', 'EventBookingController@save_event');

    Route::get('/all-event-bookings', 'EventBookingController@event_bookings');
    Route::post('/customer_mob_search', 'EventBookingController@customer_mob_search');
    Route::post('/payment_details', 'EventBookingController@payment_details');
    Route::post('/save_payment', 'EventBookingController@save_payment');
    Route::post('/save_followup', 'EventBookingController@save_followup');
    Route::post('/event_status_change', 'EventBookingController@event_status_change');
    Route::get('/export_event_bookings', 'EventBookingController@export_event_bookings');
    Route::get('/request-form', 'CommonController@request_form');
    Route::post('/save_department_request', 'CommonController@save_department_request');
    Route::post('/changestatus', 'CuisineController@changestatus');
    Route::post('/category_change_status', 'CategoryController@change_status');


    Route::get('/create_page', 'ContentManagementController@create_page');
    Route::get('/page_create', 'ContentManagementController@page_create');
    Route::post('/store_pages', 'ContentManagementController@store_page');
    Route::get('/edit_pages/{id}', 'ContentManagementController@edit_page');
    Route::post('/pages/update_page', 'ContentManagementController@update_page');
    Route::post('/page/delete_page', 'ContentManagementController@delete_page');

    Route::get('/content', 'ContentManagementController@index');
    Route::get('/create', 'ContentManagementController@create');
    Route::post('/content_store', 'ContentManagementController@store');
    Route::get('/edit/{id}', 'ContentManagementController@edit');
    Route::post('/content/update', 'ContentManagementController@update');
    Route::post('/delete', 'ContentManagementController@delete');

    Route::get('/faq', 'ContentManagementController@faq');
    Route::get('/faq_create', 'ContentManagementController@faq_create');
    Route::post('/faq_store', 'ContentManagementController@faq_store');
    Route::get('/faq_edit/{id}', 'ContentManagementController@faq_edit');
    Route::post('/faq_update', 'ContentManagementController@faq_update');
    Route::post('/faq_delete', 'ContentManagementController@faq_delete');
});

Route::get('/supplier/price-chart/{supplier_id_url}', 'IngredientItemController@price_chart_list');
Route::post('/supplier/save_sipplier_price', 'IngredientItemController@save_sipplier_price');
Route::post('/supplier/view_sipplier_price', 'IngredientItemController@view_sipplier_price');
Route::post('/supplier/delete_sipplier_price', 'IngredientItemController@delete_sipplier_price');
Route::post('/supplier/delete_brand_price', 'IngredientItemController@delete_brand_price');



// Route::prefix('customer')->group(function () {
//     Route::any('/login', 'IndexController@customer_login');
//     Route::any('/otp', 'IndexController@otp');
//     Route::get('/resend', 'IndexController@resend_otp');
//     Route::get('/home', 'IndexController@customer_home');
//     Route::get('/logout', 'IndexController@logout');
//     Route::post('/allvenues', 'IndexController@allvenues');
//     Route::post('/package_alacarte', 'IndexController@package_alacarte');
//     Route::post('/save_event_details', 'IndexController@save_event_details');
//     Route::get('/testpkg', 'IndexController@testpkg');
//     Route::get('/create', 'IndexController@create');
// });

// Route::get('/home', 'Front\IndexController@index');
Route::prefix('banquet')->group(function () {
    Route::get('/home','Front\IndexController@index');
    Route::post('/register', 'Front\IndexController@customer_register');
    Route::get('/login', 'Front\IndexController@customer_login');
    Route::get('/book_now', 'Front\IndexController@book_now');
    Route::get('/logout', 'Front\IndexController@customer_logout');
    Route::get('/profile', 'Front\IndexController@customer_profile');
    Route::get('/cart', 'Front\IndexController@view_carts');
    Route::get('/edit_profile/{id}', 'Front\IndexController@edit_profile');
    Route::post('/update_profile', 'Front\IndexController@update_profile');
    Route::get('/admin', 'Front\IndexController@admin_index');
    Route::post('/login/otp', 'Front\IndexController@customer_otp');
    Route::get('/otp', 'Front\IndexController@otp_index');
    Route::post('/check_otp', 'Front\IndexController@check_otp');
    Route::get('/resend', 'Front\IndexController@resend_otp');
    Route::any('/all-venues', 'Front\IndexController@all_venues');
    Route::get('/venue/{slug}/{date}', 'Front\IndexController@venue');
    Route::get('/{venue_slug}/{package_slug}/{date}/{cat_id?}/{package_id?}', 'Front\IndexController@singlle_package');
    Route::post('/showitems_cat', 'Front\IndexController@showitems_cat');
    Route::post('/customer_store', 'Front\IndexController@customer_store');
    Route::post('/add_to_box', 'Front\OrderController@add_to_box');
    Route::post('/remove_to_box', 'Front\OrderController@remove_to_box');
    Route::post('/book-data', 'Front\IndexController@book_data');
    Route::get('/register', 'Front\IndexController@register');
    Route::post('add_customer', 'Front\IndexController@add_customer');
    Route::post('confirm_booking', 'Front\OrderController@confirm_booking');
    Route::get('/thank_you', 'Front\IndexController@thank_you');
});


Route::get('/all-packages', 'IndexController@all_package');
Route::get('/package-items/{slug}', 'IndexController@package_items');
Route::get('/slider_test', 'IndexController@slider_test');
Route::post('/remove_item_cart', 'CommonController@remove_item_cart');
Route::post('/addMoreItems', 'CommonController@addMoreItem');
Route::post('/booking_change_status', 'CommonController@booking_change_status');
Route::post('/final_price_update', 'CommonController@final_price_update');
