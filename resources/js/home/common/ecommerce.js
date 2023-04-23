let cart = new FormData();
cart.set('_token', document.querySelector('meta[name="csrf-token"]').content);

document.addEventListener('click', event => {
    let classList = event.target.classList;
    let $parentElement = event.target.closest('[data-item]');

    if ($parentElement) {
        cart.delete('_method');
        cart.set('item', $parentElement.getAttribute('data-item'));
    }

    if (classList.contains('js-add-cart')) {
        let $quantity = $parentElement.querySelector('[name="quantity"]');
        cart.set('quantity', $quantity ? Math.max(1, parseInt($quantity.value)) : 1);

        fetch('/cart/item', {method: 'POST', body: cart})
            .then(response => response.json())
            .then(data => {
                window.location = '/gio-hang';
            });
    }

    if (classList.contains('js-clear-cart')) {
        cart.set('_method', 'DELETE');
        if (!$parentElement) {
            cart.delete('item');
        }
        requestCart('/cart/item');
    }

    if (classList.contains('js-plus-quantity') || classList.contains('js-minus-quantity')) {
        let quantity = classList.contains('js-plus-quantity') ? 1 : -1;
        let $quantity = $parentElement.querySelector('[name="quantity"]');
        $quantity.value = Math.max(1, parseInt($quantity.value) + quantity);

        if (!$parentElement.hasAttribute('data-area')) {
            cart.set('_method', 'PUT');
            cart.set('quantity', $quantity.value);
            requestCart('/cart/item');
        }
    }
});

['keypress', 'click'].forEach(action => {
    document.addEventListener(action, event => {
        let $parentElement = event.target.closest('[data-item]');
        if (event.target.classList.contains('js-input-quantity')) {
            setTimeout(() => {
                cart.set('_method', 'PUT');
                cart.set('item', $parentElement.getAttribute('data-item'));
                cart.set('quantity', $parentElement.querySelector('[name="quantity"]').value);
                requestCart('/cart/update');
            }, 100);
        }
    });
});

function requestCart(url) {
    fetch(url, {method: 'POST', body: cart})
        .then(response => response.json())
        .then(data => {
            replaceView(data);
        });
}

function replaceView(data) {
    if (!data['status']) {
        return;
    }

    replaceFragment('js-navigation-cart', data['navigation']);
    replaceFragment('js-mini-cart', data['mini']);
    replaceFragment('js-large-cart', data['large']);
}

function replaceFragment(id, html) {
    if (document.getElementById(id)) {
        document.getElementById(id).innerHTML = html;
    }
}
