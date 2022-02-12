<?php

namespace App\Services;

use App\Interfaces\CrudInterface;
use App\Models\Inventory;

class InventoryService {

    private $crudInterface;
    private $inventoryModel;

    public function __construct(CrudInterface $crudInterface, Inventory $inventoryModel)
    {
        $this->crudInterface = $crudInterface;
        $this->inventoryModel = $inventoryModel;
    }

    /**
     * @return mixed
     */
    public function getInventories()
    {
        return $this->crudInterface->index($this->inventoryModel);
    }

    public function getOneInventory($id)
    {
        return $this->crudInterface->show($this->inventoryModel, $id);
    }

    /**
     * Save inventory
     * @param $request
     * @return mixed
     */
    public function storeInventory($request)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity
        ];

        return $this->crudInterface->store($this->inventoryModel, $data);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function updateInventory($request)
    {
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'updated_at' => now()
        ];

        return $this->crudInterface->update($this->inventoryModel, $request->id, $data);
    }

    public function deleteOneInventory($id)
    {
        return $this->crudInterface->destroy($this->inventoryModel, $id);
    }
}
