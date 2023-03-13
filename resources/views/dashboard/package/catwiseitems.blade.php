<div class="form-group">
    <label>Category</label>

    @if (!empty($menu->avaragemenu))
        <table class="table">
            @foreach ($menu->avaragemenu as $category)
                @if ($category->menu->count() > 0)
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" class="catbox" value="{{ $category->id }}" id="category"
                                    name="category[]"> &nbsp;{{ $category->category_name }}
                            </td>
                            <td>
                                Max <span class="badge badge-success">{{ $category->menu->count() }}</span> Item(s)
                                <input type="hidden" name="itemCount" id="itemCount{{ $category->id }}"
                                    value="{{ $category->menu->count() }}">
                            </td>
                            <td style="padding-top: 0px;">
                                <span class="text-danger " style="font-size: 13px; padding-top:0px;">No of
                                    Items</span>
                                <input type="text" id="no_of_items{{ $category->id }}" name="no_of_items[]"
                                    class="noofItems form-control" placeholder="No of Items" disabled required>
                            </td>
                            <td>
                                <span class="btn btn-sm mt-3  btn-danger" id="extraItm{{ $category->id }}"
                                    onclick="addextra('{{ $category->id }}')" style="cursor: pointer; display: none">
                                    Add Extra Item </span>
                            </td>
                            <td style="padding-top: 4px;">
                                <span class="text-danger" style="font-size: 13px; padding-top:0px; display: none"
                                    id="extraitmqty{{ $category->id }}">Extra Item Quantity</span>
                                <input type="text" name="extraitmQty[]" id="extraitmQty{{ $category->id }}"
                                    placeholder="Item Quantity" style="display: none" class="form-control">
                                <input type="hidden" name="catId[]" value="{{ $category->id }}">
                            </td>
                            <td style="padding-top: 4px;">
                                <span class="text-danger" style="font-size: 13px; padding-top:0px; display: none"
                                    id="extraitmprice{{ $category->id }}">Extra Per Item Price</span>
                                <input type="text" name="extraitmPrice[]" id="extraitmPrice{{ $category->id }}"
                                    placeholder="Per Item Price" style="display: none" class="form-control">
                            </td>

                        </tr>
                    </tbody>
                @endif
            @endforeach


        </table>
    @endif
</div>
<script>
    $('.catbox').on('click', function() {
        var id = $(this).val();
        if ($(this).is(':checked')) {
            $('#no_of_items' + id).prop('disabled', false);
            $('#extraItm' + id).css('display', 'block');
        } else {
            $('#no_of_items' + id).prop('disabled', true);
            $('#no_of_items' + id).val('');
            $('#extraItm' + id).css('display', 'none');
            $('#extraitmQty' + id).val('');
            $('#extraitmQty' + id).css('display', 'none');
            $('#extraitmPrice' + id).val('');
            $('#extraitmPrice' + id).css('display', 'none');
            $('#extraitmqty' + id).css('display', 'none');
            $('#extraitmprice' + id).css('display', 'none');
        }
    });

    $('.noofItems').on('keyup', function() {
        var catId = $(this).closest('tr').find('.catbox').val();
        var noOfItems = $(this).val();
        var maxItems = $('#itemCount' + catId).val();
        if (noOfItems > maxItems) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'error',
                title: 'Cannot add more than ' + maxItems + 'items'
            })
            $('#no_of_items' + catId).val('');
        }
    });

    function addextra(id) {
        $('#extraitmQty' + id).css('display', 'block');
        $('#extraitmPrice' + id).css('display', 'block');
        $('#extraitmqty' + id).css('display', 'block');
        $('#extraitmprice' + id).css('display', 'block');
        $('#extraItm' + id).css('display', 'none');
    }
</script>
