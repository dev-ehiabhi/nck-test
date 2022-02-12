<?php

namespace App\Interfaces;

interface CrudInterface
{
    public function index($model);

    public function show($model, $id);

    public function store($model, $data);

    public function update($model, $id, $data);

    public function destroy($model, $id);
}
