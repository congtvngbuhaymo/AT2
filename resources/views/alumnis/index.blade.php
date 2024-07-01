<x-app-layout>
    <x-slot name="header">
        <h1 class="font-bold text-xl text-gray-800 leading-[3rem] text-center">
            {{ __('Alumni List') }}
        </h1>
    </x-slot>

    <div class="container mt-4">
        <!-- Include CSS links -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

        <style>
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
            .btn:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
            }
            .email
            {
                margin-left:-290px;
            }
</style>


        <div class="d-flex justify-content-between mb-4">
            <!-- Add New Button on the Left Side -->
            <form action="{{ route('alumnis.create') }}" style="display: inline-block;">
                <button type="submit" class="btn btn-success btn-sm">
                    <i class="fas fa-user-plus"></i> Add New
                </button>
            </form>
            <div class="email">
                <button type="button" class="btn btn-primary btn-sm ml-2" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size: 15px;">
                    <i class="far fa-paper-plane"></i> Send Email
                </button>
            </div>


            <!-- Export, Import, and Search Input on the Right Side -->
            <div class="d-flex">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end me-2">
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
            <!-- MMMMMMMmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm -->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <strong><h1 class="modal-title fs-5" id="exampleModalLabel" style="position: relative;left:9rem;">Send Email Survey</h1></strong>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('sendmail.send') }}">
                    {{ csrf_field() }}

                    <div class="form-group" style="padding: 10px; background: whitesmoke; border-radius: 10px; border: 1 px solid whitesmoke; color: #464343;">
                        <input type="checkbox" class="checkbox" id="sendToAll" name="sendToAll" onchange="updateEmailFieldFromSelect()"> <i>Send to All</i>
                    </div>

                    <div class="form-group">
                        <label>Search and Select Recipient:</label>
                        <input id="emailSend" class="form-control" oninput="updateEmailFieldFromSearch()" list="emailList" placeholder="Type to search...">
                        <datalist id="emailList">
                            @foreach($alumnis as $data)
                                <option value="{{ $data->email }}">{{ $data->name }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="form-group">
                        <label>Select Batch Number:</label>
                        <select id="batchSelect" class="form-control" name="batch" onchange="updateEmailFieldFromBatch()">
                            <option value="">Select batch no.</option>
                            @foreach($alumnis->unique('batch') as $data)
                                <option value="{{ $data->batch }}">{{ $data->batch }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" id="emailField" name="emails" value="">

                    <div class="form-group">
                        <label>Body:</label>
                        <textarea name="body" class="form-control @error('body') is-invalid @enderror" required rows="8">We would like to extend an invitation for you to take part in our Alumni Employment Survey. Your input is highly valued and will greatly contribute to our efforts!</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Close
                          </button>
                          <button type="submit" name="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Send Email
                          </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="position: relative;left:7rem;">Send Email</h1>
            </div>
            <div class="modal-body">
                <form action="{{ url('alumni/import') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                    <div class="form-group">
                        <label>Excel:</label>
                        <input type="file" name="import_file" class="form-control" />

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 <!-- MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM -->
        </div>


        <table id="data-table" class="table table-bordered">
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
                @foreach ($alumnis as $alumni)
                    <tr>
                        <td>{{ $alumni->id }}</td>
                        <td>{{ $alumni->name }}</td>
                        <td>{{ $alumni->batch }}</td>
                        <td>{{ $alumni->email }}</td>
                        <td>{{ $alumni->address }}</td>
                        <td>
                            <form action="{{ route('alumnis.destroy', $alumni->id) }}" method="POST">
                                <a class="btn btn-warning btn-edit" href="{{ route('alumnis.edit', $alumni->id) }}">
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

        <!-- Include JavaScript files -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

        <script>
            // Wait for the DOM to fully load before executing the script
            document.addEventListener('DOMContentLoaded', function() {
                // Function to filter table rows based on user input
                function filterTableRows() {
                    var filter = document.getElementById('searchInput').value.trim().toUpperCase(); // Get and normalize search query
                    var rows = document.querySelectorAll('table tbody tr'); // Select all rows in the table body

                    rows.forEach(function(row) {
                        var found = false;
                        row.querySelectorAll('td').forEach(function(column) {
                            var textValue = column.textContent || column.innerText; // Get text content of the column
                            if (textValue.toUpperCase().indexOf(filter) > -1) { // Check if search query is found in column content
                                found = true;
                            }
                        });

                        // Show or hide row based on search result
                        if (found) {
                            row.style.display = ""; // Show row
                        } else {
                            row.style.display = "none"; // Hide row
                        }
                    });
                }

                // Attach event listener to input field for filtering
                document.getElementById('searchInput').addEventListener('input', filterTableRows);
            });

            function updateEmailFieldFromSelect() {
        const sendToAllCheckbox = document.getElementById('sendToAll');
        const emailInput = document.getElementById('emailSend');
        const emailField = document.getElementById('emailField');

        if (sendToAllCheckbox.checked) {
            emailField.value = ''; // Clear email field if Send to All is checked
            emailInput.value = ''; // Clear search input if Send to All is checked
            document.getElementById('batchSelect').disabled = true; // Disable batch select if Send to All is checked
        } else {
            emailField.value = emailInput.value;
            document.getElementById('batchSelect').disabled = false; // Enable batch select if Send to All is unchecked
        }
    }

    function updateEmailFieldFromSearch() {
        const sendToAllCheckbox = document.getElementById('sendToAll');
        const emailInput = document.getElementById('emailSend');
        const emailField = document.getElementById('emailField');

        if (!sendToAllCheckbox.checked) {
            emailField.value = emailInput.value;
        }
    }

    function updateEmailFieldFromBatch() {
        const batchSelect = document.getElementById('batchSelect');
        const emailField = document.getElementById('emailField');
        const selectedBatch = batchSelect.value;

        if (selectedBatch) {
            emailField.value = ''; // Clear email field if a batch is selected
            document.getElementById('sendToAll').disabled = true; // Disable Send to All if batch is selected
        } else {
            document.getElementById('sendToAll').disabled = false; // Enable Send to All if no batch is selected
        }
    }

        </script>


      <div class="d-flex justify-content-center mt-4 mr-4">
            {{ $alumnis->links() }}
     </div>


    </div>
</x-app-layout>
