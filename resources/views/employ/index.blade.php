<x-app-layout>
    <x-slot name="header">
        <h1 class="font-bold text-xl text-gray-800 leading-[3rem] text-center">
            {{ __('Employed List') }}
        </h1>
    </x-slot>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 20px;
        }

        /* .btn-add {
            float: right;
            margin-bottom: 20px;
        } */

        .table th {
            background-color: #002147;
            color: white;
        }

        /* .action-btns {
            display: flex;
            justify-content: space-between;
        }

        .btn-edit,
        .btn-delete {
            margin-right: 5px;
        } */

        tr:nth-child(even) {
            background-color: #27b8b8;
        }
        #searchInput {
        width: 70%;
        margin-bottom: 10px;
    }
    #export{
    margin-left: 800px;
    }
    </style>
<br>
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-4">
        <form action="">


        </form>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <form action="{{ route('employs.export') }}" method="GET">
                <button type="submit" class="btn btn-secondary"> <i class="fas fa-file-export me-1"></i>Export</button>
            </form>

        <input type="text" id="searchInput" class="form-control mb-2 fs-6" placeholder="Search...">
    </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Batch no.</th>
                <th>Employed</th>
                <th>Position</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employs as $employ)
                <tr>
                    <td>{{ $employ->id }}</td>
                    <td>{{ $employ->name }}</td>
                    <td>{{ $employ->batch }}</td>
                    <td>{{ $employ->employed }}</td>
                    <td>{{ $employ->position }}</td>
                    <td>{{ $employ->department }}</td>
                    <td>
                        <form action="{{ route('alumnis.destroy', $employ->id) }}" method="POST">
                            <a class="btn btn-warning btn-edit" href="{{ route('employ.edit', $employ->id) }}">
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
        // JavaScript function to filter alumni list
        function filterAlumni() {
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
        document.getElementById('searchInput').addEventListener('input', filterAlumni);
    </script>



</div>
        {{ $employs->links() }}
    </div>

</x-app-layout>

