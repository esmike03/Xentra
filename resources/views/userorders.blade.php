<!DOCTYPE html>
<html lang="en" x-data="{ showModal: false, selectedProduct: {} }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="{{ asset('IMAGES/logowestpoint.png') }}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>My Orders</title>
</head>

<body>
    <!-- source: https://github.com/mfg888/Responsive-Tailwind-CSS-Grid/blob/main/index.html -->

    <header
        class="fixed border-b-4 border-green-500 top-0 left-0 right-0 mb-2 px-4 shadow bg-white z-50 backdrop-filter backdrop-blur-xl bg-opacity-30">

        <div class="relative mx-auto flex max-w-screen-lg flex-col py-4 sm:flex-row sm:items-center sm:justify-between">
            <a class="flex items-center text-2xl font-black" href="/">
                <img src="{{ asset('IMAGES/wespointv2nb.png') }}" class="w-36 my-0" alt="BISU Logo" />


            </a>
            <!-- Move the input before the nav for peer to work -->
            <input class="peer hidden" type="checkbox" id="navbar-open" />

            <!-- Label for toggle button -->
            <label class="absolute right-4 top-6 cursor-pointer text-black text-2xl sm:hidden" for="navbar-open">
                <span class="sr-only">Toggle Navigation</span>
                <i class="fa-solid fa-bars"></i>
            </label>


            <nav aria-label="Header Navigation" class="peer-checked:block hidden pl-2 py-6 sm:block sm:py-0">
                <ul class="flex flex-col gap-y-4 sm:flex-row sm:gap-x-8 md:items-center">

                    <li>
                        <a href="/">
                            <button class="text-black hover:text-green-400"><i class="fas fa-house"></i>
                                <span>Home</span></button>
                        </a>

                    </li>
                    <li>
                        <a href="/products">
                            <button class="text-black hover:text-green-400"><i class="fas fa-prescription-bottle"></i>
                                <span class="">Products</span></button>
                        </a>

                    </li>
                    <li>
                        <a href="/aboutus">
                            <button class="text-black hover:text-green-400"><i class="fas fa-question-circle"></i>
                                About us</button>
                        </a>
                    </li>
                    <li>
                        <a href="/cart">
                            <button class="text-black hover:text-green-400"><i class="fas fa-cart-shopping"></i>
                                Cart</button>
                        </a>
                    </li>
                    <li>
                        @auth
                            <div x-data="{ open: false }" class="relative flex  my-auto gap-2 items-center">
                                <div
                                    class="relative flex  my-auto gap-2 items-center bg-green-500 p-1 rounded-full hover:scale-105">
                                    <img @click="open = !open" class="h-8 w-8 rounded-full border-white border"
                                        src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://media.istockphoto.com/id/2151669184/vector/vector-flat-illustration-in-grayscale-avatar-user-profile-person-icon-gender-neutral.jpg?s=612x612&w=0&k=20&c=UEa7oHoOL30ynvmJzSCIPrwwopJdfqzBs0q69ezQoM8=' }}"
                                        alt="User avatar">

                                    <!-- User Name (Click to Toggle Logout Button) -->
                                    <span @click="open = !open"
                                        class="text-white font-normal text-sm cursor-pointer hover:text-green-200 pr-2">
                                        {{ Auth::user()->firstname }}
                                    </span>
                                </div>
                                <!-- Profile Image -->


                                <!-- Logout Button (Hidden by Default, Shows When Name is Clicked) -->
                                <div x-show="open" @click.away="open = false"
                                    class="absolute top-full mt-2 bg-white border rounded-lg shadow-lg p-2 w-32">
                                    <a href="" class="text-black hover:text-green-500 w-full text-left px-2 py-1">
                                        <i class="fas fa-layer-group"></i> Orders
                                    </a>
                                    <a href="/users/profile"
                                        class="text-black hover:text-green-500 w-full text-left px-2 py-1">
                                        <i class="fas fa-user"></i> Profile
                                    </a>
                                    <form action="{{ route('userlogout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="text-black hover:text-red-500 w-full text-left px-2 py-1">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}">
                                <button class="text-black hover:text-green-400">
                                    <i class="fas fa-arrow-right-to-bracket"></i> Login
                                </button>
                            </a>
                        @endauth
                    </li>
                </ul>
            </nav>
        </div>

    </header>
    <!-- Filter Form -->

    <section id="Projects" class="mt-28 container mx-auto px-4 sm:px-6 lg:px-8 mb-5" x-data="{ showModal: false, selectedProduct: {} }">
        <div class="max-w-4xl mx-auto mt-10 px-4">
            <h2 class="text-3xl font-semibold text-gray-900 mb-6">My Orders</h2>

            @if ($orders->isEmpty())
                <p class="text-center text-gray-500 text-lg">You have no orders yet.</p>
            @else
                <div class="bg-white shadow-md rounded-xl p-3">
                    <ul class="divide-y ">
                        @foreach ($orders as $order_id => $orderItems)
                            <div class="rounded-lg border-b border-gray-200 p-2 md:p-8">
                                <ul class=" divide-y ">
                                    @foreach ($orderItems as $order)
                                        <li class="flex items-center justify-between py-2 bg-green-500 text-white p-2 rounded-lg mb-2 shadow-lg">
                                            <div class="flex items-center">
                                                <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}" class="w-10 h-10 object-cover rounded-md">
                                                <span class="text-sm ml-4">{{ $order->product->name }}</span>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <span class=" font-medium text-sm">x{{ $order->quantity }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="flex flex-wrap items-center gap-y-4  pb-4 md:pb-5">
                                    <dl class="w-1/2 sm:w-48">
                                        <dt class="text-base font-medium text-gray-500">Date:</dt>
                                        <dd class="mt-1.5 text-base font-semibold text-gray-900">{{ $orderItems[0]->created_at->format('d.m.Y') }}</dd>
                                    </dl>
                                    <dl class="w-1/2 sm:w-1/4 md:flex-1 lg:w-auto">
                                        <dt class="text-base font-medium text-gray-500">Total Items:</dt>
                                        <dd class="mt-1.5 text-base font-semibold text-gray-900">{{ count($orderItems) }}</dd>
                                    </dl>
                                    <dl class="w-1/2 sm:w-1/4 md:flex-1 lg:w-auto">
                                        <dt class="text-base font-medium text-gray-500">Status:</dt>
                                        <dd class="mt-1.5 inline-flex items-center px-2.5 py-0.5 rounded bg-yellow-100 text-yellow-800 text-xs font-medium">
                                            <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"></path>
                                            </svg>
                                            {{ ucfirst($orderItems[0]->status) }}
                                        </dd>
                                    </dl>
                                </div>

                            </div>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>



    </section>


    <script>
        function showProductModal(product) {
            Alpine.store('selectedProduct', product);
            Alpine.store('showModal', true);
        }
    </script>
</body>

</html>
