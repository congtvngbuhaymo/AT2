<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Under;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UnderController extends Controller
{

    public function index()
{
    $unders = Under::paginate(10);
    return view('under.index', compact('unders'));
}
    public function create()
    {
        return view('under.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|min:5|max:255',
           'batch' => 'required|int|min:5|max:255',
            'email' => 'required|string|min:5|max:255',
            'address' => 'required|string|max:255'
        ]);

         // Crear un nuevo estudiante usando el método `create` del modelo
        Under::create($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('under.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $under = Under::findOrFail($id);
        return view('under.edit', compact('under'));
    }

    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario
        $request->validate([
           'name' => 'required|string|min:5|max:255',
           'batch' => 'required|int|min:5|max:255',
            'email' => 'required|string|min:5|max:255',
            'address' => 'required|string|max:255'
        ]);

        // Buscar el estudiante por su ID
        $under = Under::findOrFail($id);

        // Actualizar los datos del estudiante
        $under->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('under.index');
    }

    public function destroy(string $id)
    {
        $under = Under::findOrFail($id);

        $under->delete();

        return redirect()->route('under.index');
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:2048', // validate file type and size
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $file = $request->file('file');
        $filePath = $file->getRealPath();

        $csvData = array_map('str_getcsv', file($filePath));

        foreach ($csvData as $key => $row) {
            if ($key == 0) {
                continue; // Skip header row
            }

            $under = new Under();
            $under->name = $row[0];
            $under->batch = $row[1];
            $under->email = $row[2];
            $under->address = $row[3];
            $under->save();
        }

        return redirect()->back()->with('success', 'Undergraduates imported successfully.');
    }
    public function export(Request $request)
    {
        // Fetch data from database
        $unders = Under::all();

        // Generate CSV file headers
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=under.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        // Define CSV file columns
        $columns = array('Name', 'Batch', 'Email', 'Address');

        // Prepare CSV data
        $callback = function() use ($unders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($unders as $under) {
                fputcsv($file, array(
                    $under->name,
                    $under->batch,
                    $under->email,
                    $under->address,
                ));
            }

            fclose($file);
        };

        // Return CSV file as download
        return Response::stream($callback, 200, $headers);
    }
}
