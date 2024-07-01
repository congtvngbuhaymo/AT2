<x-app-layout>
    <x-slot name="header">
        <h1 class="font-bold text-xl text-gray-800 leading-[3rem] text-center">
            {{ __('Undergraduate List') }}
        </h1>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 20px;
        }

        .table th {
            background-color: #002147;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #27b8b8;
        }

        #searchInput {
            width: 25%;
            margin-bottom: 10px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }
        .btn:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
            }
    </style>
<br>
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-4">
            <!-- Add New and Complete Buttons on the Left Side -->
            <div class="btn-group">
                <form action="{{ route('under.create') }}">
                    <button type="submit" class="btn btn-success btn-add btn-sm">
                        <i class="fas fa-user-plus"></i> Add New
                    </button>
                </form>
                <form action="{{ route('transfer.data') }}">
                    <button type="submit" class="btn btn-success btn-add btn-sm">
                        <i class="fas fa-check-circle"></i> Complete
                    </button>
                </form>
            </div>

            <!-- Export, Import, and Search Input on the Right Side -->
            <div class="d-flex">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end me-2">
                    <!-- Export Undergraduates Data Button -->


                    <!-- Import CSV Form -->
                    <form action="{{ route('alumnis.import') }}" method="POST" enctype="multipart/form-data" class="ms-2">
                        @csrf
                        <input type="file" name="file" accept=".csv" class="form-control form-control-file d-inline-block" style="width: auto;">
                        <button type="submit" class="btn btn-primary ms-2"><i class="fas fa-file-export me-1"></i>Import</button>
                    </form>

                    <!-- Export Alumni Data Button -->
                    <form action="{{ route('alumni.export') }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm">
                            <i class="fas fa-file-export me-1"></i> Export
                        </button>
                    </form>
                </div>

                <!-- Search Input -->
                <input type="text" id="searchInput" class="form-control fs-6" placeholder="Search...">
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Batch no.</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($unders as $under)
                    <tr>
                        <td>{{ $under->id }}</td>
                        <td>{{ $under->name }}</td>
                        <td>{{ $under->batch }}</td>
                        <td>{{ $under->email }}</td>
                        <td>{{ $under->address }}</td>
                        <td>
                            <form action="{{ route('alumnis.destroy', $under->id) }}" method="POST">
                                <a class="btn btn-warning btn-edit" href="{{ route('under.edit', $under->id) }}">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-delete">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <script>
            // JavaScript function to filter undergraduate list
            function filterUndergraduates() {
                // Get input element and filter value
                var input = document.getElementById('searchInput');
                var filter = input.value.toUpperCase();

                // Get table rows
                var rows = document.querySelector('tbody').getElementsByTagName('tr');

                // Loop through all table rows and hide those that don't match the search query
                for (var i = 0; i < rows.length; i++) {
                    var row = rows[i];
                    var columns = row.getElementsByTagName('td');
                    var found = false;
                    // Loop through all columns of the row and check for a match
                    for (var j = 0; j < columns.length; j++) {
                        var column = columns[j];
                        if (column) {
                            var textValue = column.textContent || column.innerText;
                            if (textValue.toUpperCase().indexOf(filter) > -1) {
                                found = true;
                                break;
                            }
                        }
                    }
                    // Show or hide row based on search match
                    if (found) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            }

            // Attach event listener to input field
            document.getElementById('searchInput').addEventListener('input', filterUndergraduates);
        </script>
    </div>
    {{ $unders->links() }}

</x-app-layout>
