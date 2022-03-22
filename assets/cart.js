import $ from 'jquery';

$(document).ready(function () {
    const $cart = $("#cart");
    const $cartTotal = $cart.find('tfoot .price');

    console.log($cart);

    $cart.delegate('.qt', 'change', function () {
        const qt = $(this).val();
        const id = $(this).data('id');

        const $itemTotal = $(this)
            .parent().next()
            .find('.price');


        if (qt <= 0) {
            $(this).parent().parent().remove();
            $.ajax('/cart/ajax/remove', {
                method: 'post',
                data: {id: id}
            })
                .then(function (response) {
                    $itemTotal.html(response.itemTotal);
                    $cartTotal.html(response.cartTotal);
                });

        } else {
            $.ajax('/cart/ajax/update', {
                method: 'post',
                data: {qt: qt, id: id}
            })
                .then(function (response) {
                    $itemTotal.html(response.itemTotal);
                    $cartTotal.html(response.cartTotal);
                });
        }
    });
});