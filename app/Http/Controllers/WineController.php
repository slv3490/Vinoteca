<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Wine;
use App\Http\Requests\WineRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Repositories\Wine\WineRepositoryInterface;

class WineController extends Controller
{
    public function __construct(protected WineRepositoryInterface $repository) {}

    public function index()
    {
        return view("wine.index", [
            "wines" => $this->repository->paginate(
                relationship: ["category"]
            )
        ]);
    }

    public function create() : View
    {
        return view("wine.create", [
            "wine" => $this->repository->model(),
            "action" => route("wines.store"),
            "method" => "POST",
            "submit" => "Crear"
        ]);
    }

    public function store(WineRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());

        Session::flash("success", "El vino ha sido creado exitosamente.");

        return redirect()->route("wines.index");
    }

    public function edit(Wine $wine)
    {   
        return view("wine.edit", [
            "wine" => $wine,
            "action" => route("wines.update", $wine),
            "method" => "PUT",
            "submit" => "Actualizar"
        ]);
    }

    public function update(WineRequest $request, Wine $wine): RedirectResponse
    {
        $this->repository->update($request->validated(), $wine);

        Session::flash("success", "¡Vino Actualizado Con Éxito!");

        return redirect()->route("wines.index");
    }

    public function destroy(Wine $wine) 
    {
        try {
            $this->repository->delete($wine);
            Session::flash("success", "¡Vino Eliminado Con Éxito!");
        } catch (Exception $exception) {
            Session::flash("error", $exception->getMessage());
        }

        return redirect()->route("wines.index");
    }
}
