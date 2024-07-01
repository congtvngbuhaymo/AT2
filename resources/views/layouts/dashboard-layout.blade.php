<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
    </style>

    <div class="py-12">
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full md:w-1/4 px-4 mb-4">
                    <div class="card shadow bg-primary text-center rounded-lg p-4 hover:card:hover">
                        <div class="card-body">
                            <i class="fas fa-user-graduate fa-3x mb-3"></i>
                            <h5 class="card-title">Alumni</h5>
                            <p class="card-text">{{ $totalAlumni }}</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/4 px-4 mb-4">
                    <div class="card shadow bg-secondary text-center rounded-lg p-4 hover:card:hover">
                        <div class="card-body">
                            <i class="fas fa-user-graduate fa-3x mb-3"></i>
                            <h5 class="card-title">UnderGraduate</h5>
                            <p class="card-text">{{ $totalAlumni }}</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/4 px-4 mb-4">
                    <div class="card shadow bg-danger text-center rounded-lg p-4 hover:card:hover">
                        <div class="card-body">
                            <i class="fas fa-user-tie fa-3x mb-3"></i>
                            <h5 class="card-title">Employed</h5>
                            <p class="card-text">{{ $totalEmploy }}</p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/4 px-4 mb-4">
                    <div class="card shadow bg-success text-center rounded-lg p-4 hover:card:hover">
                        <div class="card-body">
                            <i class="fas fa-user-times fa-3x mb-3"></i>
                            <h5 class="card-title">Unemployed</h5>
                            <p class="card-text">{{ $totalUnemploy }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer fixed-bottom py-3 bg-dark text-white text-center">
        <div class="container mx-auto">
            <span>@ Coder's Tribe . All Rights Reserved 2024 </span>
        </div>
    </footer>
</x-app-layout>
