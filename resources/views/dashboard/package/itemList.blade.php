@if(!empty($catItems))
<label>Items</label>
	<div class="form-group">
		<select class="js-example-basic-multiple form-control" name="items[]" multiple="multiple" required>
				@foreach($catItems as $category)
					@foreach($category['menu'] as $item)
				 		 <option value="{{$item['id']}}">{{$item['name']}}</option>
				  	@endforeach
				 @endforeach
		</select>
	</div>
@endif