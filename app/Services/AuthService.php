<?php

namespace App\Services;

use App\Interfaces\CrudInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService {

    private $crudInterface;
    private $userModel;

    public function __construct(CrudInterface $crudInterface, User $userModel)
    {
        $this->crudInterface = $crudInterface;
        $this->userModel = $userModel;
    }

    public function storeUser($request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        return $this->crudInterface->store($this->userModel, $data);
    }
}
