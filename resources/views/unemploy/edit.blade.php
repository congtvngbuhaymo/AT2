<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight text-center">
                    {{ __('Edit Undergraduate') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card shadow-lg p-6 lg:p-8">
                                <form method="POST" action="{{ route('unemploy.update', $unemploy->id) }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="name" class="form-label text-sm fw-medium text-gray-900 dark:text-white">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $unemploy->name) }}" class="form-control form-control-lg rounded-lg px-3 py-2" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="batch" class="form-label text-sm fw-medium text-gray-900 dark:text-white">Batch no.</label>
                                        <input type="number" name="batch" id="batch" value="{{ old('batch', $unemploy->batch) }}" class="form-control form-control-lg rounded-lg px-3 py-2" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label text-sm fw-medium text-gray-900 dark:text-white">Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email', $unemploy->email) }}" class="form-control form-control-lg rounded-lg px-3 py-2" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label text-sm fw-medium text-gray-900 dark:text-white">Address</label>
                                        <input type="text" name="address" id="address" value="{{ old('address', $unemploy->address) }}" class="form-control form-control-lg rounded-lg px-3 py-2" required>
                                    </div>

                                    <div class="mb-3 d-flex justify-content-end">
                                        <a href="{{ route('unemploy.index') }}" class="btn btn-secondary btn-lg rounded-lg px-4 py-2 me-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary btn-lg rounded-lg px-4 py-2">Save</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>

    <!-- Bootstrap JS (optional) for Bootstrap components that require JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
