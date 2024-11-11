<?php

namespace App\Http\Repositories\API;

use App\Http\Repositories\BaseRepo;
use App\Models\UserInfo;

class UserInfoRepo extends BaseRepo
{
    public function __construct(UserInfo $userInfo)
    {
        $this->model = $userInfo;
    }
}
