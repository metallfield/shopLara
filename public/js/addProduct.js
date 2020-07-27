$(document).ready(function () {
    $('#addProduct').on('click', function () {
        let product_id = $('#addProduct').data('product');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('/basket/add/'+product_id, (data) =>{
            $('#addProduct').text('product added in your basket');
            $('#addProduct').prop("disabled", true);
            console.log(JSON.stringify(data));
        })
    });


})
