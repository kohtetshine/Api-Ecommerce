<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Front\CategoryRepo;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepo;
    public function __construct(
        CategoryRepo $categoryRepo
        ) {
        $this->categoryRepo = $categoryRepo;
    }
}
