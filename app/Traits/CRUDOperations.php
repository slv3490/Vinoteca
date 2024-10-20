<?php

namespace App\Traits;

use App\Services\UploadService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait CRUDOperations
{
    public function model(?string $slug = null) 
    {
        if($slug) {
            return $this->model::whereSlug($slug)->firstOrFail();
        }
        return app($this->model);
    }

    public function paginate(array $count = [], array $relationship = [], int $perPage = 10) : LengthAwarePaginator
    {
        return $this->model::query()->with($relationship)->withCount($count)->paginate($perPage);
    }

    public function create(array $data) 
    {
        $image = UploadService::upload(data_get($data, "image"), strtolower(class_basename($this->model)));

        return $this->model::create(array_merge($data, ["image" => $image]));
    }

    public function update(array $data, Model $model) 
    {
        if(data_get($data, "image")) {
            UploadService::delete($model);
            data_set(
                $data,
                "image",
                UploadService::upload(data_get($data, "image"), strtolower(class_basename($this->model)))
            );
        }

        $model->update($data);

        return $model;
    }

    /**
     * @throws Exception
     */

    public function delete(Model $model) 
    {
        if(method_exists($this, "deleteCheck")) {
            $this->deleteCheck($model);
        }
        
        UploadService::delete($model);


        return $model->delete();
    }
}
