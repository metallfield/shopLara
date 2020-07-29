$(document).ready(function () {
    $(document).on('click', '#addProduct',function () {

        let product_id = $(this).data('product');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('/basket/add/'+product_id, (data) =>{
            $(this).text('Show Basket');
            $(this).attr("id", "showBasket");
            getCountOfProducts();

            console.log(JSON.stringify(data));
        })
    });
    function show_order() {
        $('#product_list').empty();
        $.get("/getBasket").done((data) =>{
            console.log(data);
            let total_sum = 0;
            if (data.products.length === 0)
            {
                $('#product_list').html('<h3 class="text-center">Your basket is empty now</h3>');
            }
            $.each(data.products, function (i , product) {

                let productSum = product.price * product.pivot.count;
                total_sum += productSum;
                $('#total_sum').text(total_sum +'$');
               let  product_tmpl = '<div class="p-4 border-left-0 border-right-0 border"><div class="row p-2  text-center align-items-center">' +
                   '<div class="m-2 prod_img"><img src="/storage/'+product.image+'" alt="" height="100" width="100"></div>' +
                   '<div class="prod_name text-center"><span class="m-2"> name: '+product.name+' </span>' +
                   '</div><div class="forOne"><span class="m-2"> price for one: '+product.price+'$</span></div>' +
                   '<div class="forCount">' +
                   '<span class="m-2">price for count: </span>'+product.price * product.pivot.count+'$</div></div>' +
                   '<div class="row justify-content-center">' +
                   '<button class="btn btn-outline-danger rounded-circle" id="removeProd" data-product="'+product.id+'">' +
                   '<i class="fa fa-minus"></i></button><span class="mx-2">'+product.pivot.count+'</span>' +
                   '<button class="btn btn-outline-success rounded-circle" id="addProd" data-product="'+product.id+'"><i  class="fa fa-plus"></i></button></div></div>';
               $('#product_list').append(product_tmpl);
            });
        });
    }
    function make_dialog()
    {
        let modal_content = '<div id="basket" class="position-absolute border rounded  text-white font-weight-bold" title="basket">';
        modal_content += '<div class="row justify-content-around p-4"><h3>basket window</h3><h4 class="font-weight-bolder ">total price <span id="total_sum"></span></h4>' +
            '<button id="closeBasket" class="btn btn-outline-light">return to shopping</button></div>';
        modal_content += '<div style="height:600px; min-width: 800px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" >\n' +
        '<div id="product_list">';
        modal_content += show_order();
            modal_content += '</div></div>' +
                ' <a  class="align-self-center mx-5 my-3 btn btn-outline-light " href="/basket/place">Create order</a></div>';
        $(modal_content).appendTo('#basket_details');
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click','#addProd', function () {
        let id = $(this).data('product');

        $.post('/basket/add/'+id, (data)=>{
            console.log(data);
            if (data.status === false)
            {
                alert('you cant increase the number of this product');
            }
         setTimeout(show_order, 1000) ;
            getCountOfProducts();

        })
    });
    $(document).on('click','#removeProd', function () {
        let id = $(this).data('product');

        $.post('/basket/remove/'+id, (data)=>{
            console.log(data);
            setTimeout(show_order, 1000) ;
            getCountOfProducts();

        })
    });
    $(document).on('click', '#closeBasket', function () {
        $('#basket_details').empty();
    });
    $(document).on('click', '#showBasket', function (e) {
        e.preventDefault();
        make_dialog();
        $("#basket").show();

    });
    $('body').click(function(e) {
        if (!$(e.target).closest('#basket_details').length){
            $("#basket_details").empty();
        }
    });

    function getCountOfProducts()
    {
         $.get('/getCountOfProducts').done((data)=>{
           console.log(data);
           if (data >= 0)
           {
               $('#countOfProd').html('<span class="mx-1 p-1 border rounded-circle bg-warning text-center font-weight-bolder" >'+ data + '</span>');

           }
        });
    }
    getCountOfProducts();
})
