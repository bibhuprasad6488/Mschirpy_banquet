<input type="hidden" name="catlimit" id="catlimit">
@if (!empty($allmenus))
@foreach ($allmenus as $key => $val)
    <div class="row">
        <div class="col-md-6">
            <h4 class="p_l"><span id="cat_cusisine">{{ $key }}</span></h4>
        </div>                        
    </div>
    <!-- Nav Card -->
    @foreach ($val as $key_type => $val_type)
        <h5 class="p_l">{{ $key_type }}</h5>
        <div class="tab-content">
            <!-- card one -->
            <div class="tab-pane fade show active" id="nav-home">
                <div class="container">
                </div>
                <div class="row no-gutters">
                    @if (!empty($val_type))
                        @foreach ($val_type as $key_item => $val_item)
                            @php
                                $imgUrl = '/storage/images/items/' . $val_item->image;
                            @endphp
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="gallery-box" id="gallery-box">
                                    <div class="single-gallery">
                                        <div class="gallery-img big-img"
                                            style="background-image: url({{ $imgUrl }});background-position: center; background-repeat: no-repeat; background-size:cover ;">
                                        </div>
                                        @php
                                            if (!empty($crt_data[$cat_id])) {
                                                $searcharr = $crt_data[$cat_id];
                                            } else {
                                                $searcharr = [];
                                            }
                                        @endphp
                                        <span>
                                            @if (in_array($val_item->id, $searcharr))
                                                <a href="javascript:void(0);" class="myBtn"
                                                    id="boxbtn{{ $val_item->id }}"
                                                    onclick="remove_to_box('{{ $val_item->id }}')"><i
                                                        class="fa fa-check addd"
                                                        id="iconschng{{ $val_item->id }}"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0);" class="myBtn"
                                                    id="boxbtn{{ $val_item->id }}"
                                                    onclick="add_to_box('{{ $val_item->id }}')"><i
                                                        class="fa fa-plus addd"
                                                        id="iconschng{{ $val_item->id }}"></i>
                                                </a>
                                            @endif
                                        </span>
                                        <h4 class="c-head">{{ $val_item->name }}</h4>
                                        <p class="desc" style="text-transform: capitalize;">
                                            {{ substr($val_item->description ?? '', 0, 30) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@endforeach
@endif