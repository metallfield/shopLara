$(document).ready(function () {

    $('.custom-control-input').each(function () {
        $(this).change(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let product_id = $(this).data('product');
            let market_id = $('#marketID').data('id');
             if ($(this).prop('checked'))
             {

                 $.post('/markets/addProduct',
                     {product_id:product_id, market_id:market_id},
                     (data) =>{
                     console.log(JSON.stringify(data));
                     });
             }
             if (!$(this).prop('checked'))
             {

                 $.post('/markets/removeProduct',
                     {product_id:product_id, market_id:market_id},
                     (data) =>{
                         console.log(JSON.stringify(data));
                     });
             }
        })
    })
})
