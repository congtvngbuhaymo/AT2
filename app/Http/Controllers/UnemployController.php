<?php

namespace App\Http\Controllers;

use App\Models\Unemploy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
class UnemployController extends Controller
{

    public function index()
{
    $unemploys = Unemploy::paginate(10);
    return view('unemploy.index', compact('unemploys'));
}
    public function create()
    {
        return view('employ.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|min:5|max:255',
           'batch' => 'required|int|min:5|max:255'

        ]);

         // Crear un nuevo estudiante usando el método `create` del modelo
        Unemploy::create($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('unemploy.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $unemploy = Unemploy::findOrFail($id);
        return view('unemploy.edit', compact('employ'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
           'name' => 'required|string|min:5|max:255',
           'batch' => 'required|int|min:5|max:255'

        ]);

        // Buscar el estudiante por su ID
        $unemploy = Unemploy::findOrFail($id);

        // Actualizar los datos del estudiante
        $unemploy->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('unemploy.index');
    }

    public function destroy(string $id)
    {
        $unemploy = Unemploy::findOrFail($id);

        $unemploy->delete();

        return redirect()->route('unemploy.index');
    }
    public function export(Request $request)
    {
        // Fetch data from database
        $unemploys = Unemploy::all();

        // Generate CSV file headers
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=unemploy.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        // Define CSV file columns
        $columns = array('Name', 'Batch', 'Email', 'Address');

        // Prepare CSV data
        $callback = function() use ($unemploys, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($unemploys as $unemploy) {
                fputcsv($file, array(
                    $unemploy->name,
                    $unemploy->batch,
                    $unemploy->employed,
                    $unemploy->position,
                    $unemploy->department,
                ));
            }

            fclose($file);
        };

        // Return CSV file as download
        return Response::stream($callback, 200, $headers);
    }


}
