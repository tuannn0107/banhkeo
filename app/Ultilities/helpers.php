<?php

if (!function_exists('twitter')) {
    function twitter($name, $slug = null)
    {
        $slug = !$slug ? request()->url() : (str($slug)->startsWith('http') ? $slug : request()->root() . $slug);
        return 'https://twitter.com/intent/tweet?url=' . $slug . '&text=' . $name;
    }
}

if (!function_exists('facebook')) {
    function facebook($slug = null)
    {
        $slug = !$slug ? request()->url() : (str($slug)->startsWith('http') ? $slug : request()->root() . $slug);
        return 'https://www.facebook.com/sharer/sharer.php?u=' . $slug;
    }
}

if (!function_exists('pinterest')) {
    function pinterest($name, $image, $slug = null)
    {
        $slug = !$slug ? request()->url() : (str($slug)->startsWith('http') ? $slug : request()->root() . $slug);
        $image = str($image)->startsWith('http') ? $image : request()->root() . $image;
        return 'https://pinterest.com/pin/create/button/?url=' . $slug . '&media=' . $image . '&description=' . $name;
    }
}

if (!function_exists('linkedin')) {
    function linkedin($name, $slug = null)
    {
        $slug = !$slug ? request()->url() : (str($slug)->startsWith('http') ? $slug : request()->root() . $slug);
        return 'https://www.linkedin.com/shareArticle?mini=true&url=' . $slug . '&title=' . $name;
    }
}

if (!function_exists('tumblr')) {
    function tumblr($name, $slug = null)
    {
        $slug = !$slug ? request()->url() : (str($slug)->startsWith('http') ? $slug : request()->root() . $slug);
        return 'https://www.tumblr.com/share?v=3&u=' . $slug . '&t=' . $name;
    }
}

if (!function_exists('price')) {
    function price($price)
    {
        if (!$price) {
            return '';
        }
        return number_format($price, 0, '.', '.') . ' ₫';
    }
}

if (!function_exists('tightPrice')) {
    function tightPrice($price)
    {
        return number_format($price, 0, '.', '.') . '₫';
    }
}

if (!function_exists('salePercent')) {
    function salePercent($price, $salePrice)
    {
        return $price && $salePrice ? '<div class="sale">-' . intval(($price - $salePrice) * 100 / $price) . '%</div>' : '';
    }
}

if (!function_exists('active')) {
    function active($slug)
    {
        return request()->is($slug) ? 'active' : '';
    }
}

if (!function_exists('href')) {
    function href($type, $slug)
    {
        return trans('slug.' . $type) . '/' . $slug;
    }
}

if (!function_exists('cartArray')) {
    function cartArray()
    {
        return session()->get('cartArray', []);
    }
}

if (!function_exists('resetCart')) {
    function resetCart()
    {
        session()->forget('cartArray');
    }
}

if (!function_exists('cartAmount')) {
    function cartAmount()
    {
        return collect(cartArray())->values()->sum(function ($cart) {
            return $cart['price'] * $cart['quantity'];
        });
    }
}
