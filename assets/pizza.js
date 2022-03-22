import $ from 'jquery';

$(document).ready(function () {
    function showCartDetails(data){
        $('#cartDetails').text(
           `${data.numberOfItems } produits pour ${data.totalPrice} €`
        )
    }

    $('.addToCart').on('click', function(){
        const id = $(this).data('id');
        $.ajax('/cart/ajax/addTo/' + id, {
            method: 'post'
        }).then(function(response){
            showCartDetails(response);
        });
    });

    $.get('/cart/ajax/details').then(function(response){
        console.log(response);
        showCartDetails(response);
    });

});