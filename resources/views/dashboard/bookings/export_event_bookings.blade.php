<!DOCTYPE html>
<html>
<head>
	<title>	</title>
</head>
<!-- CSS here -->
	<link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('front/assets/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{ asset('front/assets/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/gijgo.css')}}">
	<link rel="stylesheet" href="{{ asset('front/assets/css/animate.min.css')}}">
	<link rel="stylesheet" href="{{ asset('front/assets/css/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{ asset('front/assets/css/fontawesome-all.min.css')}}">
	<link rel="stylesheet" href="{{ asset('front/assets/css/themify-icons.css')}}">
	<link rel="stylesheet" href="{{ asset('front/assets/css/slick.css')}}">
	<link rel="stylesheet" href="{{ asset('front/assets/css/nice-select.css')}}">
	<link rel="stylesheet" href="{{ asset('front/assets/css/style.css')}}">
<body>

@php  

$output='';
  $output .= '
   <table>  
        <tr> <b>   ';  
        
        foreach($title as $val) {
          $output .= "<th> {$val} </th>";
    	}
    	if(!empty($eventbooks))
        {
        	foreach($eventbooks as $event){
        	if($event->event_status == 'confirmed'){
        		$sts = "Confirmed";
        	}else{
        		$sts = "Pending";
        	}
        	$day = strtoupper(date('D', strtotime($event->event_date)));
        	$output .= "<tr>
                <td> {$event->event_date}</td>
                <td> {$day}</td>
                <td> {$event->amount_of_gathering}</td>
                <td> {$event->price}</td>
                <td> {$event->event_time}</td>

                <td> {$event->venue_or_hall}</td>
                <td> {$event->type}</td>
                <td> {$event->customer->customer_name}</td>
                <td> {$event->customer->mobile}</td>
                <td> {$sts}</td>
                </tr>";
        	}
        }
        $output .= ' </b> </tr>';

  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=event_bookings.xls');
  echo $output;
 @endphp
</body>
</html>