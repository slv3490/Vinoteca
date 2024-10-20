<?php

namespace App\Traits\Traits;

use Exception;
use Illuminate\Support\Facades\Session;

trait CartActions
{
    public function addProductToCart(): void
    {
        $wineId = request()->input("wine_id");
        $quantity = request()->input("quantity", 1);

        $wine = $this->repository->find($wineId);
        $this->cart->add($wine, $quantity);

        Session::flash("success", "Producto añadido al carrito");
    }

    public function incrementProductQuantity(): void
    {
        $wine = $this->repository->find(request("wine_id"));

        try {
            $this->cart->increment($wine);
            Session::flash("success", "Cantidad incrementada");
        } catch ( Exception $exception) {
            Session::flash("error", $exception->getMessage());
        }
    }

    public function decrementProductQuantity(): void
    {
        $this->cart->decrement(request("wine_id"));

        Session::flash("success", "Cantidad Decrementada");
    }

    public function removeProduct(): void
    {
        $this->cart->remove(request("wine_id"));

        Session::flash("success", "Producto eliminado del carrito");
    }

    public function clearCart(): void
    {
        $this->cart->clear();

        Session::flash("success", "El carrito ha sido vaciado");
    }
}
