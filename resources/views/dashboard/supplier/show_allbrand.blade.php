<label>Set As Default</label>
<div class="card">
 <div class="card-body" style="padding: 2px;">
    <table class="" id="customFields" style="margin: 5px;">
   <thead>
   	@if(!empty($datas))
   		@foreach($datas as $v)
	      <tr >
      		<td style="width:5%" class="mr-3 ml-3">
      			<input type="checkbox" name="default_brand[]" value="{{$v->id}}" style="accent-color:green;"/>
      		</td>
      		<td class="text-left">
      			<span>{{$v->brand_name}}</span> 
      		</td>
	      </tr>
      	@endforeach
     @endif
  </thead>
</table>
 </div>
</div>