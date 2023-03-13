<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Party;
use App\Models\User;
use Auth;

class EventBookingController extends Controller
{
	//

	public function create_event()
	{
		$parties = Party::orderBy('id', 'DESC')->get();
		return view('dashboard.bookings.create_event', compact('parties'));
	}

	public function save_event(Request $request)
	{
		// dd($request->all());
		$cus_id = $request->cus_id;
		$customer_name = $request->customer_name;
		$email = $request->email;
		$mobile = $request->mobile;
		$event_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->event_date)));
		$event_time = $request->event_time;
		$gathering = $request->no_of_gathering;
		$price = $request->price;
		$venu_or_hall = $request->venu_or_hall;
		$type = $request->type;
		$is_exist_mobile = Customer::where('mobile', $mobile)->get()->count();
		if ($cus_id == '') {
			if ($is_exist_mobile > 0) {
				return redirect()->back()->with('error', 'Customer already exist with same mobile number');
			}
		}
		try {
			if ($cus_id == '') {
				$cus = new Customer(['customer_name' => $customer_name, 'email_id' => $email, 'mobile' => $mobile]);
				$cus->save();
				$cust_id = $cus->id;
			} else {
				$cust_id = $cus_id;
			}
			$data = [
				'customer_id' => $cust_id,
				'event_date' => $event_date,
				'event_time' => $event_time,
				'amount_of_gathering' => $gathering,
				'price' => $price,
				'venue_or_hall' => $venu_or_hall,
				'type' => $type
			];
			$event = new Event($data);
			$save_event = $event->save();
			if ($save_event) {
				return redirect()->back()->with('success', 'New Event Created');
			} else {
				return redirect()->back()->with('error', 'Something went wrong');
			}
		} catch (\Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function customer_mob_search(Request $request)
	{
		$customerdtls = Customer::where('mobile', $request->mobile)->first();
		return $customerdtls;
	}

	public function event_bookings()
	{
		$eventbooks = Event::with('customer')->orderBy('id', 'DESC')->get();
		$data['eventbooks'] = $eventbooks;
		return view('dashboard.bookings.all_events_booking', $data);
	}

	public function payment_details(Request $request)
	{
		$event = Event::where('id', $request->id)->first();
		$data['paymet_dtls'] = $event->advance_details;
		$data['followup_dtls'] = $event->followup_details;
		return $data;
	}

	public function save_payment(Request $request)
	{
		$event = Event::where('id', $request->event_id)->first();
		$data = $event->advance_details;
		$data[] = [
			'adv_payment' => $request->adv_payment,
			'pay_type' => $request->payment_type,
			'payment_date' => $request->payment_date
		];
		try {
			$update_payment = $event->update(['advance_details' => $data]);
			if ($update_payment) {
				return redirect()->back()->with('success', 'Advance payment saved');
			} else {
				return redirect()->back()->with('error', 'Something went wrong');
			}
		} catch (\Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function save_followup(Request $request)
	{
		$event = Event::where('id', $request->eventfoll_id)->first();

		try {
			$data = ['followed_date' => $request->followup_date, 'remarks' => $request->remark];
			$update_followup = $event->update(['followup_details' => $data]);
			if ($update_followup) {
				return redirect()->back()->with('success', 'Your Follow Up has saved');
			} else {
				return redirect()->back()->with('error', 'Something went wrong');
			}
		} catch (\Exception $e) {
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function event_status_change(Request $request)
	{
		if ($request->val == 2) {
			Event::where('id', $request->event_id)->update(['event_status' => 'confirmed']);
		} else {
			Event::where('id', $request->event_id)->update(['event_status' => null]);
		}
		return true;
	}

	public function export_event_bookings()
	{
		$eventbooks = Event::with('customer')->orderBy('id', 'DESC')->get();
		$data['eventbooks'] = $eventbooks;
		$data['title'] = ['Date', 'Day', 'MG', 'Rate', 'Time', 'Venue/ Hall', 'Type', 'Guest Name', 'Contact No', 'Status'];
		return view('dashboard.bookings.export_event_bookings', $data);
	}
}