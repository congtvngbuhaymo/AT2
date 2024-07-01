<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #00428f;
            /* Wheat color gradient */
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            overflow: hidden;
        }


        .container {
            margin-top: 100px;
        }

        .title {
            background: linear-gradient(90deg, rgba(65, 57, 193, 1) 0%, rgba(79, 133, 226, 0.18531162464985995) 0%, rgb(33, 66, 182) 0%, rgba(83, 76, 227, 0.8463760504201681) 30%, rgba(75, 137, 227, 1) 87%, rgba(0, 212, 255, 1) 100%);
        }

        .form-left {
            background-color: whitesmoke;
        }

        .logo-img {
            height: 250px;
            opacity: 0.8;
            width: 80%;
            margin-bottom: 100px;
        }

        .custom-btn {
            background-color: darkblue;

        }
    </style>
</head>

<body>
    <section>
        <div class="container ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="title col-lg-6 d-flex flex-column text-center">
                                <h2 class="my-5 text-center">Alumni Employment Tracker System</h2>
                                <div class="d-flex justify-content-center align-items-center"
                                    style="text-align: center;">
                                    <img src="https://miro.medium.com/v2/resize:fit:1358/1*yw0TnheAGN-LPneDaTlaxw.gif"
                                        alt="logo" class="logo-img">
                                </div>
                            </div>
                            <div class="col-lg-6 form-left">
                                <div class="card-body p-md-5 mx-md-4 ">
                                    <div class="text-center mb-4">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNnYo_hDciK3v7zibLg4GlIz16uBsH1gb4Jg&s"
                                            alt="logo" style="width:30%; height:30%">
                                    </div>

                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <!-- Email Address -->
                                        <div>
                                            <x-input-label for="email" :value="__('Email')" />
                                            <div class="input-group mt-1">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                <x-text-input id="email" class="form-control" type="email"
                                                    name="email" :value="old('email')" required autofocus
                                                    autocomplete="username" />
                                            </div>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <!-- Password -->
                                        <div class="mt-4">
                                            <x-input-label for="password" :value="__('Password')" />
                                            <div class="input-group mt-1">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                <x-text-input id="password" class="form-control" type="password"
                                                    name="password" required autocomplete="current-password" />
                                            </div>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <!-- Remember Me -->
                                        <div class="block mt-4">
                                            <label for="remember_me" class="inline-flex items-center">
                                                <input id="remember_me" type="checkbox"
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                    name="remember">
                                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>

                                        <div class="flex items-center justify-end mt-4 text-center">
                                            <button type="submit" class="ms-3 btn btn-primary">
                                                <i class="fas fa-sign-in-alt"></i> <!-- Login icon -->
                                                {{ __('Log in') }}

                                            </button>

                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
