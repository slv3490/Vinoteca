<?php

namespace App\Http\Controllers\Wine;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function __construct(private CategoryRepositoryInterface $repository) {}

    public function index(): View
    {
        return view("wine.category.index", [
            "categories" => $this->repository->paginate(["wines"])
        ]);
    }

    public function create(): View
    {   
        return view("wine.category.create", [
            "category" => $this->repository->model(),
            "action" => route("categories.store"),
            "method" => "POST",
            "submit" => "Crear"
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());

        Session::flash("success", "¡Categoría Creada Con Éxito!");

        return redirect()->route("categories.index");
    }

    public function edit(Category $category)
    {   
        return view("wine.category.edit", [
            "category" => $category,
            "action" => route("categories.update", $category),
            "method" => "PUT",
            "submit" => "Actualizar"
        ]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $this->repository->update($request->validated(), $category);

        Session::flash("success", "¡Categoría Editada Con Éxito!");

        return redirect()->route("categories.index");
    }

    public function destroy(Category $category) 
    {
        try {
            $this->repository->delete($category);
            Session::flash("success", "¡Categoría Eliminada Con Éxito!");
        } catch (Exception $exception) {
            Session::flash("success", $exception->getMessage());
        }

        return redirect()->route("categories.index");
    }
}
