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
    <title>Cart</title>
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
                            <button class="relative text-black hover:text-green-400">
                                <i class="fas fa-cart-shopping"></i> Cart
                                @if ($cartCount > 0)
                                    <span
                                        class="absolute -top-1 -right-2 min-w-4 h-4 bg-red-500 text-xs text-white rounded-full flex items-center justify-center px-1">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </button>
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
                                    <a href="/my-orders" class="text-black hover:text-green-500 w-full text-left px-2 py-1">
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

    <section id="Projects" class=" container mx-auto px-4 sm:px-6 lg:px-8 mt-6 mb-5" x-data="{ showModal: false, selectedProduct: {} }">


        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0 mt-28">
            <h2 class="text-xl font-semibold text-gray-900  sm:text-2xl"><i class="fa fa-shopping-cart"></i> Cart</h2>

            <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6">
                        @forelse ($cartItems as $item)
                            <div class="rounded-lg border border-gray-200 bg-white p-1 shadow-sm md:p-6">
                                <div
                                    class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0 ">
                                    <a href="#" class="shrink-0 md:order-1">
                                        <img class="h-12 w-12 object-cover ml-10"
                                            src="{{ asset('storage/' . $item->product->image) }}" alt="Product Image" />
                                    </a>

                                    <label for="counter-input" class="sr-only">Choose quantity:</label>
                                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                                        <div class="flex items-center" x-data="{ quantity: {{ $item->quantity }} }">
                                            <!-- Decrease Button -->
                                            <button type="button"
                                                @click="updateQuantity({{ $item->id }}, quantity - 1)"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                                                <svg class="h-2.5 w-2.5 text-gray-900" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>

                                            <!-- Quantity Input -->
                                            <input type="text" x-model="quantity"
                                                class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0"
                                                readonly />

                                            <!-- Increase Button -->
                                            <button type="button"
                                                @click="updateQuantity({{ $item->id }}, quantity + 1)"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100">
                                                <svg class="h-2.5 w-2.5 text-gray-900" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                </svg>
                                            </button>
                                        </div>

                                    </div>

                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <a href="#" class="text-base font-medium text-gray-900 hover:underline">
                                            {{ $item->product->name }}
                                        </a>

                                        <div class="flex items-center gap-4">
                                            <form @submit.prevent="removeItem({{ $item->id }})">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center text-sm font-medium text-red-600 hover:underline">
                                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18 17.94 6M18 18 6.06 6" />
                                                    </svg>
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center mt-10 text-gray-400">Your cart is emtpy.</p>
                        @endforelse



                    </div>
                    <div class="hidden xl:mt-8 xl:block">

                        <div class="mt-6 grid grid-cols-3 gap-4 sm:mt-8">

                        </div>
                    </div>
                </div>
                <!--Aside-->
                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                        <p class="text-xl font-semibold text-gray-900">Order</p>



                        <a href="#" @click.prevent="submitOrder()"
                            class="flex w-full items-center justify-center rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-primary-300">
                            Submit
                        </a>

                    </div>
                </div>

            </div>
        </div>

    </section>


    <script>
        function submitOrder() {
            fetch("/check-address", {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.hasAddress) {
                        // ❌ No address, show alert and redirect to profile
                        Swal.fire({
                            title: "Address Required",
                            text: "Please set your address before submitting your order.",
                            icon: "warning",
                            confirmButtonText: "Go to Profile"
                        }).then(() => {
                            window.location.href = "{{ route('users.profile') }}"; // Redirect to profile
                        });
                    } else {
                        // ✅ Address exists, proceed with order submission
                        fetch("{{ route('cart.submit') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({})
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: "Order Placed!",
                                        text: "Your order has been placed successfully.",
                                        icon: "success",
                                        confirmButtonColor: "#4CAF50",
                                        confirmButtonText: "OK"
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: "Error!",
                                        text: data.message,
                                        icon: "error",
                                        confirmButtonColor: "#d33"
                                    });
                                }
                            })
                            .catch(error => {
                                console.error("Error:", error);
                                Swal.fire({
                                    title: "Oops!",
                                    text: "Something went wrong. Please try again later.",
                                    icon: "error",
                                    confirmButtonColor: "#d33"
                                });
                            });
                    }
                })
                .catch(error => {
                    console.error("Error checking address:", error);
                    Swal.fire({
                        title: "Error!",
                        text: "Unable to check your address. Please try again.",
                        icon: "error",
                        confirmButtonColor: "#d33"
                    });
                });
        }




        function removeItem(cartId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to recover this item!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, remove it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('cart.remove') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                cart_id: cartId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "The item has been removed from your cart.",
                                    icon: "success",
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload(); // Refresh the page
                                });
                            } else {
                                Swal.fire("Error", "Failed to remove item.", "error");
                            }
                        })
                        .catch(error => console.error("Error:", error));
                }
            });
        }

        function updateQuantity(cartId, newQuantity) {
            if (newQuantity < 1) return; // Prevents negative or zero quantities

            fetch("{{ route('cart.update') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        cart_id: cartId,
                        quantity: newQuantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Reload the page to reflect updates
                    } else {
                        alert("Failed to update quantity.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function showProductModal(product) {
            Alpine.store('selectedProduct', product);
            Alpine.store('showModal', true);
        }
    </script>
</body>

</html>
