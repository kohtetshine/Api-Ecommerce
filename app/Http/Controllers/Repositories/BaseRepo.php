<?php

namespace App\Http\Controllers\Repositories;

use Illuminate\Database\Eloquent\Collection;

class BaseRepo
{
    protected $model;

    public function __construct()
    {
    }

    public function all($limit = null){
        if($limit){
            $result = $this->model::orderBy('id')->limit($limit);
        }else{
            $result = $this->model::all();
        }

        return $result;
    }

    public function find($id){
        $result = $this->model::find($id);

        return $result;
    }

    public function store($data){
        $result= $this->model::create($data);

        return $result;
    }

    public function update($data,$id){
        $model = $this->find($id);

        foreach ($data as $key => $value) {
            $model->key = $value;
        }

        $model->save();
        return $model;
    }

    public function delete($id){
        $model = $this->find($id);

        if ($model) {
            $model->delete();
            return true;
        }

        return false;
    }

    public function latest($id, $limit = null): Collection{
        return $this->model->orderBy($id, 'desc')->limit($limit)->get();
    }

    public function count($data = null){
        return $this->model::count();
    }

    public function insert($data) {
        $result= $this->model::insert($data);
        return $result;
    }

}
