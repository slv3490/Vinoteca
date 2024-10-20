<?php

namespace App\Repositories\Wine;

use App\Models\Wine;

interface WineRepositoryInterface
{
    public function model(?string $slug = null);

    public function paginate(array $count = [], array $relationship = [], int $perPage = 10);

    public function create(array $data);

    public function update(array $data, Wine $wine);

    public function delete(Wine $wine);
}
