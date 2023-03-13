 
 <div class="row">
 	@if(!empty($venues))
 	@foreach($venues as $venue)
    <div class="col-md-3 mt-20">
    	<input type="hidden" name="venue_id" id="venue_id" value="{{$venue->id}}">
       <div class="single-services text-center mb-50 btn select-btn" id="venue_{{$venue->id}}" onclick="select_venue('{{$venue->id}}')">
      		{{$venue->venue_name}}
      </div>
    </div>
    @endforeach
    @endif
</div>