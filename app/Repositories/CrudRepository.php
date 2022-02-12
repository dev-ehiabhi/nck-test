<?php

namespace App\Repositories;

use App\Interfaces\CrudInterface;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Resource_;

class CrudRepository implements CrudInterface
{
    /**
     * @return Resource collection
     */
    public function index($model)
    {
        return $model->latest()->get();
    }

    /**
     * @
     */
    public function show($model, $id)
    {
        return $model->where('id', $id)->first();
    }

    /**
     * @return Boolean
     *
     */
    public function store($model, $data)
    {
        return $model->create($data);
    }

    /**
     * @
     */
    public function update($model, $id, $data)
    {
        return $model->where('id', $id)->update($data);
    }

    /**
     * @param Resource ID $id
     * @param Resource model $model
     *
     * @return Boolean
     */
    public function destroy($model, $id)
    {
        return $model->where('id', $id)->delete();
    }
}
