<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="{{ asset('IMAGES/logowestpoint.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>Westpoint pharma inc.</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>


<body class="bg-[url('https://pagedone.io/asset/uploads/1691055810.png')] bg-center bg-cover h-screen ">
    <header
        class="fixed border-b-4 border-green-500 top-0 left-0 right-0 mb-2 px-4 shadow bg-white z-50 backdrop-filter backdrop-blur-xl bg-opacity-30">

        <div class="relative mx-auto flex max-w-screen-lg flex-col py-4 sm:flex-row sm:items-center sm:justify-between">
            <a class="flex items-center text-2xl font-black" href="/">
                <img src="{{ asset('IMAGES/wespointv2nb.png') }}" class="w-36 my-0" alt="BISU Logo" />


            </a>
            <input class="peer hidden" type="checkbox" id="navbar-open" />
            <label class="absolute right-0 mt-1 cursor-pointer text-white text-xl sm:hidden" for="navbar-open">
                <span class="sr-only">Toggle Navigation</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="0.88em" height="1em"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 448 512">
                    <path fill="currentColor"
                        d="M0 96c0-17.7 14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zm448 160c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32h384c17.7 0 32-14.3 32 32z" />
                </svg>
            </label>

        </div>

    </header>

    <section class="mt-36">
        <div class="flex flex-col items-center mt-14 px-6 mx-auto md:h-screen lg:py-0">
            <div class="w-full rounded-lg md:mt-0 sm:max-w-md xl:p-0 bg-white shadow-lg">
                <h2 class="text-2xl font-bold  mb-4 pl-6 pt-6">REGISTER</h2>
                @if ($errors->any())
                    <div class="bg-red-100 mx-6 text-xs border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Whoops!</strong> Something went wrong.
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="" action="{{ route('register.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-3 p-6 pt-2 pb-2">
                        <div>
                            <label for="firstname" class="block text-sm font-medium text-gray-700">Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="w-full border rounded-lg p-2"
                                required>
                        </div>
                        <div>
                            <label for="lastname" class="block text-sm font-medium text-gray-700">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="w-full border rounded-lg p-2"
                                required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="w-full border rounded-lg p-2"
                                required>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone" pattern="\d{11}" maxlength="11"
                                class="w-full border rounded-lg p-2" required
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11)"
                                placeholder="09XXXXXXXXX">

                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="w-full border rounded-lg p-2"
                                required>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                                Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full border rounded-lg p-2" required>
                        </div>

                    </div>
                    <div class="mx-6 mt-2">
                        <button type="submit"
                            class="w-full  bg-green-500 text-white py-2 rounded-lg hover:bg-green-700">Register</button>

                    </div>

                </form>
                <p class="text-sm text-center mt-4 mb-6">Already have an account? <a href="{{ route('login') }}"
                        class="text-green-600 hover:underline">Login</a></p>
            </div>
        </div>
    </section>




</body>

</html>
