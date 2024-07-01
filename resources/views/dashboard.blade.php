<x-app-layout>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
       <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
       <x-slot name="header">
           <h2 class="font-semibold text-lg md:text-xl text-gray-800 leading-tight text-center">
               {{ __('Dashboard') }}
           </h2>
       </x-slot>

       <style>
           .card:hover {
               transform: scale(1.05);
               transition: transform 0.3s ease;
           }
       </style>
   <br><br> <br><br> <br>
   <div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('alumnis.index') }}" class="card-link">
                    <div class="card shadow bg-primary text-center">
                        <div class="card-body">
                            <i class="fas fa-user-graduate fa-3x mb-3"></i>
                            <h5 class="card-title">Alumni</h5>
                            <p class="card-text">{{ $Alumni }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('under.index') }}" class="card-link">
                    <div class="card shadow bg-secondary text-center">
                        <div class="card-body">
                            <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                            <h5 class="card-title">UnderGraduate</h5>
                            <p class="card-text">{{ $Under }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('employ.index') }}" class="card-link">
                    <div class="card shadow bg-danger text-center">
                        <div class="card-body">
                            <i class="fas fa-user-tie fa-3x mb-3"></i>
                            <h5 class="card-title">Employed</h5>
                            <p class="card-text">{{ $Employ }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('unemploy.index') }}" class="card-link">
                    <div class="card shadow bg-success text-center">
                        <div class="card-body">
                            <i class="fas fa-user-times fa-3x mb-3"></i>
                            <h5 class="card-title">Unemployed</h5>
                            <p class="card-text">{{ $Unemploy }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

       <div class="py-12">
           <div class="container">
               <div class="row">
                   {{-- <div class="col-md-6">
                       <!-- Monthly report -->
                       <div class="card shadow">
                           <div class="card-body">
                               <!-- Insert your monthly report content here -->
                               <h5 class="card-title">Monthly Report</h5>
                               <p class="card-text">Insert your report content here.</p>
                           </div>
                       </div>
                   </div> --}}
                   <div class="col-md-8">
                    <!-- Graph -->
                    <div class="card shadow">
                        <div class="card-body">
                            <!-- Insert your graph here using Chart.js -->
                            <h5 class="card-title">Graph</h5>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>

               </div>
           </div>
       </div>

       <!-- Chart.js script -->
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       <canvas id="myChart" width="400" height="200"></canvas>

       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Alumni', 'UnderGraduate', 'Employed', 'UnEmployed'],
                datasets: [{
                    label: 'Data',
                    data: {!! json_encode([$Alumni, $Under, $Employ, $Unemploy]) !!},
                    backgroundColor: [
                    'blue',   // Darker Red
                    'red',   // Darker Blue
                    'gray',   // Darker Yellow
                    'green'    // Darker Teal
                ],
                borderColor: [
                    'gray',     // Red (full opacity)
                    'gray',     // Blue (full opacity)
                    'gray',     // Yellow (full opacity)
                    'gray'      // Teal (full opacity)
                ],

                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


   </x-app-layout>

