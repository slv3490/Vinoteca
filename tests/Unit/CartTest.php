<?php

use App\Models\Category;
use App\Models\Wine;
use App\Services\Cart;

test('a product can be added to the cart', function () 
{
    $cart = app(Cart::class);

    $category = Category::create([
        "name" => "Category 1",
        "description" => "Description",
        "image" => "category-1.jpg"
    ]);
    
    $wine = Wine::create([
        "name" => "Wine 1",
        "category_id" => $category->id,
        "price" => 200.0,
        "year" => 1950,
        "description" => "Excellent Wine For The Best Moments In Your Days.",
        "stock" => 10,
        "image" => "wine-1.jpg"
    ]);

    expect($cart->isEmpty())->toBe(true);
    
    $cart->add($wine);
    
    expect($cart->isEmpty())->toBe(false)
        ->and($cart->getCart()->count())->toBe(1);
    
    $cart->clear();

    expect($cart->isEmpty())->toBe(true)
        ->and($cart->getCart()->count())->toBe(0);

    $cart->add($wine, 2);

    expect($cart->getTotalQuantity())->toBe(2)
        ->and($cart->getTotalCost())->toBe(400.00);

    $cart->increment($wine);

    expect($cart->getTotalQuantity())->toBe(3)
        ->and($cart->getTotalCost())->toBe(600.00);

    $cart->decrement($wine->id);

    expect($cart->getTotalQuantity())->toBe(2)
        ->and($cart->getTotalCost())->toBe(400.00);

    $cart->remove($wine->id);

    expect($cart->isEmpty())->toBe(true)
        ->and($cart->getTotalQuantity())->toBe(0)
        ->and($cart->getTotalCost())->toBe(0.00);

    $cart->add($wine, 10);

        expect($cart->getTotalQuantity())->toBe(10)
        ->and($cart->getTotalCost())->toBe(2000.00);

})->group("unit-cart");
