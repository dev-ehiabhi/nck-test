<?php

namespace App\Services;

use App\Interfaces\CrudInterface;
use App\Models\Cart;
use App\Models\Inventory;

class CartService {

    private $crudInterface;
    private $cartModel;

    public function __construct(CrudInterface $crudInterface, Cart $cartModel)
    {
        $this->crudInterface = $crudInterface;
        $this->cartModel = $cartModel;
    }

    /**
     * Add cart
     * @param $request
     * @return mixed
     */
    public function storeCart($request)
    {
        $declined = [];

        foreach ($request->cart as $req) {
            $data = [
                'user_id' => auth()->user()->id,
                'inventory_id' => $req['inventory_id'],
                'quantity' => $req['quantity']
            ];

            if (Inventory::where('id', $req['inventory_id'])->where('quantity', '>=', $req['quantity'])->exists()) {
                $this->crudInterface->store($this->cartModel, $data);

                $this->updateInventory($req['inventory_id'], $req['quantity']);
            } else {
                array_push($declined, $data);
            }

        }
        if ($declined) {
            return ['declined' => $declined];
        }
        return true;
    }

    /**
     * @param $inventory_id
     * @param $quantity
     * @return mixed
     */
    public function updateInventory($inventory_id, $quantity)
    {
        return Inventory::where('id', $inventory_id)->decrement('quantity', $quantity);
    }

}
