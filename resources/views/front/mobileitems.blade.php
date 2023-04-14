
    <input type="hidden" name="" id="category_id" value="{{ $cat_id }}">
    <input type="hidden" name="" id="m_package_id" value="{{ $package_id }}" class="">
    <input type="hidden" name="" id="change_ftype" value="{{ $ftype }}">
    @if (!empty($cuisines))
        @php
            $fst_csn = array_keys($cuisines);
        @endphp
            <nav>
                <input type="hidden" name="" id="change_cuisn_id" value="{{$fst_csn[0]}}">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <table class="table table-responsive">
                        <tbody>
                            <tr>
                                @foreach ($cuisines as $k => $v)
                                    @php
                                        if ($fst_csn[0] == $k) {
                                            $class = 'active';
                                        } else {
                                            $class = '';
                                        }
                                    @endphp
                                    <td>
                                        <a class="nav-item nav-link c_act {{ $class }}"
                                            onclick="show_cuisines_wise_itemes('', {{ $k }},'',{{ $package_id }});"
                                            style="border-radius: 50px !important;border-radius: 20px !important; padding: 4px 15px 4px 13px !important;margin: 1px 3px 1px 2px;"
                                            href="javascript::void(0);" aria-selected="true" id="c_sts{{$k}}">{{ $v }}</a>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
            </nav>
    @else
        Not Ok
    @endif
