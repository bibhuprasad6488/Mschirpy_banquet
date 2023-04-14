@if (!empty($veg_items))
    @foreach ($veg_items as $key => $val)
        @php
            $imgUrl = '/storage/images/items/' . $val->image;
        @endphp
        <div class="col-sm-6">
            <div class="car bg-gray border-bottom border-danger pb-2">
                <div class=" card-body py-1 px-2 d-flex">
                    <div class="p-2 w-100 col-sm-10">
                        <h6>{{ $val->name }}</h6>
                        <small>{{ $val->description }}</small><br>
                        {{-- <small>Serving Time 9am to 6pm</small> --}}
                    </div>
                    <div class="p-2 flex-shrink-1 col-sm-2">
                        <img src="{{ $imgUrl }}" alt="" class="img-responsive float-right " width="90px"
                            height="80px">
                        @php
                            if (!empty($m_crt_data[$cat_id])) {
                                $searcharr = $m_crt_data[$cat_id];
                            } else {
                                $searcharr = [];
                            }
                        @endphp

                        <!-------------------- FOR BUTTON SECTION  ---------------------->

                        @if (in_array($val->id, $searcharr))
                            <a class="nav-item nav-link act add_remove_remove" href="javascript::void(0);" aria-selected="true"
                               id="add_remove{{ $val->id }}" onclick="remove_to_box('{{ $val->id }}')" ><span id="textchng{{ $val->id }}">REMOVE</span></a>
                        @else
                            <a class="nav-item nav-link act add_remove" href="javascript::void(0);" aria-selected="true"
                              id="add_remove{{ $val->id }}"  onclick="add_to_box('{{ $val->id }}')" ><span id="textchng{{ $val->id }}">ADD</span></a>
                        @endif

                        <!-------------------- FOR BUTTON SECTION  ---------------------->
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
