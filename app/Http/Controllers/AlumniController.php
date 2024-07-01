<?php

namespace App\Http\Controllers;
use App\Models\Under;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
class AlumniController extends Controller
{

    public function index()
{
    $alumnis = Alumni::paginate(10);
    return view('alumnis.index', compact('alumnis'));
}
    public function create()
    {
        return view('alumnis.create');
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
        Alumni::create($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('alumnis.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('alumnis.edit', compact('alumni'));
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
        $alumni = Alumni::findOrFail($id);

        // Actualizar los datos del estudiante
        $alumni->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('alumnis.index');
    }

    public function destroy(string $id)
    {
        $alumni = Alumni::findOrFail($id);

        $alumni->delete();

        return redirect()->route('alumnis.index');
    }

    public function transferData(Request $request)
    {
        // Transfer logic from Undergraduate to Alumni
        Under::chunk(100, function ($unders) {
            foreach ($unders as $under) {
                // Create Alumni record
                Alumni::create([
                    'name' => $under->name,
                    'batch' => $under->batch,
                    'email' => $under->email,
                    'address' => $under->address,
                    // Add other fields as needed
                ]);

                // Optionally, you may want to delete the undergraduate record after transfer
                $under->delete();
            }
        });

        return redirect()->route('under.index')
            ->with('success', 'Data transferred successfully!');
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

            // Create a new Alumni instance
            $alumni = new Alumni();
            $alumni->name = $row[0];
            $alumni->batch = $row[1];
            $alumni->email = $row[2];
            $alumni->address = $row[3];

            // Save the Alumni record
            $alumni->save();
        }

        return redirect()->back()->with('success', 'Alumni imported successfully.');
    }

    public function export()
    {
        // Fetch data from database
        $alumni = Alumni::all();

        // Generate CSV file headers
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=alumni.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        // Define CSV file columns
        $columns = array('Name', 'Batch', 'Email', 'Address');

        // Prepare CSV data
        $callback = function() use ($alumni, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($alumni as $alumnus) {
                fputcsv($file, array(
                    $alumnus->name,
                    $alumnus->batch,
                    $alumnus->email,
                    $alumnus->address,
                ));
            }

            fclose($file);
        };

        // Return CSV file as download
        return Response::stream($callback, 200, $headers);
    }
}
