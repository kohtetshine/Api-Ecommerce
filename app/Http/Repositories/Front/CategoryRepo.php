<?php

namespace App\Http\Repositories\Front;

use App\Http\Repositories\BaseRepo;
use App\Models\Category;

class CategoryRepo extends BaseRepo {
    public function __construct() {
        $this->model = new Category();
    }
}
