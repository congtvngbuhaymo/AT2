<?php

namespace App\Http\Controllers;

use App\Models\Employ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class EmployController extends Controller
{

    public function index()
{
    $employs = Employ::paginate(10);
    return view('employ.index', compact('employs'));
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
           'batch' => 'required|int|min:5|max:255',
            'employed' => 'required|string|min:5|max:255',
            'position' => 'required|string|max:255',
             'department' => 'required|string|max:255'
        ]);

         // Crear un nuevo estudiante usando el método `create` del modelo
        Employ::create($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('employ.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $employ = Employ::findOrFail($id);
        return view('employ.edit', compact('employ'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|min:5|max:255',
           'batch' => 'required|int|min:5|max:255',
            'employed' => 'required|string|min:5|max:255',
            'position' => 'required|string|max:255',
             'department' => 'required|string|max:255'
        ]);

        // Buscar el estudiante por su ID
        $employ = Employ::findOrFail($id);

        // Actualizar los datos del estudiante
        $employ->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('employ.index');
    }

    public function destroy(string $id)
    {
        $employ = Employ::findOrFail($id);

        $employ->delete();

        return redirect()->route('employ.index');
    }

    public function export(Request $request)
    {
        // Fetch data from database
        $employs = Employ::all();

        // Generate CSV file headers
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=employ.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        // Define CSV file columns
        $columns = array('Name', 'Batch', 'Email', 'Address');

        // Prepare CSV data
        $callback = function() use ($employs, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($employs as $employ) {
                fputcsv($file, array(
                    $employ->name,
                    $employ->batch,
                    $employ->employed,
                    $employ->position,
                    $employ->department,
                ));
            }

            fclose($file);
        };

        // Return CSV file as download
        return Response::stream($callback, 200, $headers);
    }

}
