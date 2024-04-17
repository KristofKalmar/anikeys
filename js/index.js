function addToCart(name, price)
{
    $.ajax({
        type: 'POST',
        url: 'add_to_cart.php',
        data: { name: name, price: price },
        success: function(response)
        {
            alert(response);
            location.reload();
        },
        error: function(xhr, status, error)
        {
            console.error(xhr.responseText);
            alert('Hiba történt a kosárhoz adás közben.');
        }
    });
}