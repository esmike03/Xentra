<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Login</title>
    <link rel="icon" type="image/png" href="{{ asset('IMAGES/xentra6.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="font-mono">

    <header
        class="fixed border-b-4 border-orange-500 top-0 left-0 right-0 mb-2 px-4 shadow bg-white z-50 backdrop-filter backdrop-blur-xl bg-opacity-30">
        <div class="relative mx-auto flex max-w-screen-lg flex-col py-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex">
                <button id="mobileMenuToggle" class="sm:hidden text-gray-600 text-xl">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="flex items-center text-2xl font-black" href="/admin">
                    <img src="{{ asset('IMAGES/xentra1.png') }}" class="w-36 my-0" alt="Logo" />
                </a>
            </div>


        </div>
    </header>

    <section class="mt-12">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-white rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Login - Admin
                    </h1>
                    @if (session('message'))
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Whoops!</strong> Something went wrong.
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="space-y-4 md:space-y-6" action="/admin/auth" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="username" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">


                            </div>
                            {{-- <a href="#" class="text-sm font-medium text-primary-600 hover:underline">Forgot password?</a> --}}
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-orange-600 hover:bg-orange-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Sign in
                        </button>
                        {{-- <p class="text-sm font-light text-gray-500">
                                Don’t have an account yet? <a href="#" class="font-medium text-primary-600 hover:underline">Sign up</a>
                            </p> --}}
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
