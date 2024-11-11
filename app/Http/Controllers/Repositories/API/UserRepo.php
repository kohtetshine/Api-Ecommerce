<?php

namespace App\Http\Controllers\Repositories\API;

use App\Http\Controllers\Repositories\BaseRepo;
use App\Models\User;

class UserRepo extends BaseRepo
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
