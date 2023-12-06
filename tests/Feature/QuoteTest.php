<?php

use Storephp\Cart\Facades\CartManagement;
use Storephp\Cart\Tests\App\Models\Product;

test('Add Quote', function () {
    $product = Product::create([
        'name' => 'xBox',
        'sku' => 12345,
        'price' => 599,

    ]);

    $cart = CartManagement::initCart('01HF7V7N1MG9SDFPQYWXDNHR9Q', 'USD');
    $cart->quote()->addQuote($product, 1);

    expect($cart->quote()->getQuotes()->toArray()[0]['item'])->toMatchArray([
        'name' => 'xBox',
        'sku' => 12345,
        'price' => 599,
    ]);
});

test('Increase Quote', function () {
    $product = Product::create([
        'name' => 'xBox',
        'sku' => 12345,
        'price' => 599,

    ]);

    $cart = CartManagement::initCart('01HF7V7N1MG9SDFPQYWXDNHR9Q', 'USD');
    $cart->quote()->addQuote($product, 1);
    $cart->quote()->increaseQuote($product, 5);

    expect($cart->quote()->getQuotes()->toArray()[0]['quantity'])->toEqual(6);
});

test('Decrease Quote', function () {
    $product = Product::create([
        'name' => 'xBox',
        'sku' => 12345,
        'price' => 599,

    ]);

    $cart = CartManagement::initCart('01HF7V7N1MG9SDFPQYWXDNHR9Q', 'USD');
    $cart->quote()->addQuote($product, 1);
    $cart->quote()->increaseQuote($product, 5);
    $cart->quote()->decreaseQuote($product, 3);

    expect($cart->quote()->getQuotes()->toArray()[0]['quantity'])->toEqual(3);
});

test('Remove Quote', function () {
    $product = Product::create([
        'name' => 'xBox',
        'sku' => 12345,
        'price' => 599,

    ]);

    $cart = CartManagement::initCart('01HF7V7N1MG9SDFPQYWXDNHR9Q', 'USD');
    $cart->quote()->addQuote($product, 1);
    $cart->quote()->removeQuote($product);

    expect($cart->quote()->getQuotes())->toBeEmpty();
});
