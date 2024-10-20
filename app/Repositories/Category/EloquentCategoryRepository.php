<?php

namespace App\Repositories\Category;

use Exception;
use App\Models\Category;
use App\Traits\CRUDOperations;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    use CRUDOperations;

    protected $model = Category::class;

    /**
     * @throws Exception
     */

    protected function deleteCheck(Category $category) 
    {
        if($category->wines()->exists()) {
            throw new Exception("No se puede eliminar la categoría porque tiene vinos asociados.");
        }
    }
}
