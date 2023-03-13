<table class="table table-striped" id="customFields">
   <thead>
      <tr class="text-center">
         <th>#</th>
         <th>Item Name</th>
         <th>Category</th>
         <th>Department</th>
         <th>MRP</th>
         <th>Quantity</th>
         <th>Brand</th>
         <th>Supplier Price</th>
      </tr>
   </thead>
   <tbody>
      @if(!empty($datas && $datas->count() > 0))
         @foreach($datas as $k => $v)
         <tr>
            <td class="text-center" rowspan="{{count($v->data)}}">{{$k+1}}</td>
            <td class="text-center" rowspan="{{count($v->data)}}">{{$v->item->item_name}}</td>
            <td class="text-center" rowspan="{{count($v->data)}}">{{$v->ing_cat->category_name}}</td>
            <td class="text-center" rowspan="{{count($v->data)}}">{{$v->department->department_name}}</td>
            <td class="text-center" rowspan="{{count($v->data)}}">{{$v->mrp}}</td>
            <td class="text-center" rowspan="{{count($v->data)}}">{{$v->qty}}</td>
            <td class="text-center" colspan="2">
             
                     @foreach($v->get_name() as $kb => $vb)
                        {{$kb   }}   <span>&#x20b9</span>{{$vb}}</br>
                     @endforeach
            </td>

            <td class="text-center"></td>
         </tr>
         @endforeach
      @else
         <tr>
            <td colspan="6" class="text-center">No Record Found</td>
         </tr>
      @endif
   </tbody>
 </table>