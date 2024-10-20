<?php

namespace App\Repositories\Wine;

use App\Models\Wine;
use App\Repositories\Wine\WineRepositoryInterface;
use App\Traits\CRUDOperations;

class EloquentWineRepository implements WineRepositoryInterface
{
    use CRUDOperations;
    
    protected $model = Wine::class;
}
