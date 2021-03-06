$(document).ready(function () {
    $('#radius').hide();
    $('#setRadius').on('click', function () {
        $('#radius').fadeToggle(1000);
    })
    $('#nearest').on('click', function () {
        $('#MarketList').empty();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    let lat = position.coords.latitude;
                    let lng = position.coords.longitude;
                    let radius = $('#radius').val();
                    let product_id = $('#product-id').data('id');
                    console.log([lat, lng]);
                    $.post('/getNearestMarkets', {lat:lat, lng:lng, radius:radius, product_id:product_id }, (data)=>{
                            console.log(JSON.stringify(data));
                            getTmpl(data);
                    }).fail(function () {
                        $('#MarketList').html('<h4>sorry markets not found</h4>');
                    })
                });
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }

    });

    function getTmpl(data) {
        $('#MarketList').empty();
        $.each(data, function (i , market) {
            let tmplt  = '<li class="font-weight-bold"><a href="/markets/'+market.id+'">'+market.name+'</a>: '+  market.distance.toFixed(2)+'km</li>' +
                '        <span>location: <span class="font-weight-bold">'+  market.location+'</span></span></li>';
                $('#MarketList').append(tmplt);
        });
    }
});
