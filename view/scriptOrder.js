$(document).ready(function() {
    var totalPrice = 0;

    $('.drink-img').on('click', function() {
        var name = $(this).data('name');
        var price = parseInt($(this).data('price'));

        var existingItem = $('#orderItems .order-item').filter(function() {
            return $(this).find('.item-quantity').data('name') === name;
        });

        if (existingItem.length > 0) {
            var quantityInput = existingItem.find('.item-quantity');
            var currentQuantity = parseInt(quantityInput.val());
            quantityInput.val(currentQuantity + 1);

            var itemPrice = parseInt(quantityInput.data('price'));
            totalPrice += itemPrice;
            $('#totalPrice').text(totalPrice);
            
            //console.log(totalPrice);
        } else {
            $('#latestOrder').append('<img src="'+$(this).attr('src')+'" alt="'+name+'" class="mr-2">');

            var item = '<div class="order-item" data-price="'+price+'">'+name+' <input type="number" value="1" min="1" class="item-quantity" data-name="'+name+'" data-price="'+price+'"> EGP '+price+' <button class="btn btn-danger btn-sm remove-item">X</button></div>';
            $('#orderItems').append(item);

            totalPrice += price;
            $('#totalPrice').text(totalPrice);
            
            //console.log(totalPrice);
        }
    });

    $(document).on('click', '.remove-item', function() {
        var item = $(this).parent();
        var itemPrice = item.data('price'); 
        var itemQuantity = $(this).siblings('.item-quantity').val();
        var itemTotalPrice = itemPrice * itemQuantity;

        totalPrice -= itemTotalPrice;
        $('#totalPrice').text(totalPrice);
        //
        console.log(totalPrice);
        item.remove();
        $('#latestOrder img[alt="'+$(this).siblings('.item-quantity').data('name')+'"]').remove();
    });

    $(document).on('input', '.item-quantity', function() { 
            var newTotalPrice = 0;
            $('.order-item').each(function() {
                newTotalPrice += $(this).data('price') * $(this).find('.item-quantity').val();
            });
            totalPrice = newTotalPrice;
            $('#totalPrice').text(totalPrice);
            //console.log(totalPrice);
        });
    });

    
    $('#search').on('input', function() {
        var searchText = $(this).val().toLowerCase();

        $('.drink-item').each(function() {
            var itemName = $(this).find('.drink-img').data('name').toLowerCase();
            if (itemName.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    $('#orderForm').on('submit', function() {
        var orderDetails = {
            items: [],
            notes: $('#notes').val(),
            totalPrice: $('#totalPrice').text()
            
        };

        $('.order-item').each(function() {
            orderDetails.items.push({
                name: $(this).find('.item-quantity').data('name'),
                quantity: $(this).find('.item-quantity').val(),
                price: $(this).find('.item-quantity').data('price')
            });
        });

        $('#orderDetails').val(JSON.stringify(orderDetails));
    });
