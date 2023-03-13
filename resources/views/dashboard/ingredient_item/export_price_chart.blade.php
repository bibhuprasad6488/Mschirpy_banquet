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
   <table class="datatable table table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Item Name</th>
                <th>SPAT</th>
                <th>MRP Price</th>
                <th>VAT Percentage</th>
                <th>Quantity</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($ingredientItems))
                @foreach($ingredientItems as $key => $val)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$val->item_name}}</td>
                <td>{{$val->custom_fields['spat'] ?? ''}}</td>
                <td>{{$val->custom_fields['mrp_price'] ?? ''}}</td>
                <td>{{$val->custom_fields['vat_perc'] ?? ''}}</td>
                <td>{{$val->custom_fields['qty'] ?? ''}}</td>
                <td>{{$val->custom_fields['amount'] ?? ''}}</td>
            </tr>
                @endforeach
            @else
            <tr><td>-- No Records Found --</td></tr>
            @endif
        </tbody>
    </table>
</body>
</html>