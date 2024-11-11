<?php

namespace App\Http\Repositories\API;

use App\Http\Repositories\BaseRepo;
use App\Models\User;

class UserRepo extends BaseRepo
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function findBy($column, $value)
    {
        return $this->model->where($column, $value)->first();
    }

    public function getToken($id)
    {
        return $this->model->where('id', $id)->value('remember_token');
    }
}
