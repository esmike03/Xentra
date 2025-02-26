<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="{{ asset('IMAGES/xentra6.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>Xentra Medica Corp.</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        .fade {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .fade.show {
            opacity: 1;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>


<body>
    <header
        class="fixed border-b-4 border-orange-400 top-0 left-0 right-0 mb-2 px-4 shadow bg-white z-50 backdrop-filter backdrop-blur-xl bg-opacity-30">

        <div class="relative mx-auto flex max-w-screen-lg flex-col py-4 sm:flex-row sm:items-center sm:justify-between">
            <a class="flex items-center text-2xl font-black" href="/">
                <img src="{{ asset('IMAGES/xentra1.png') }}" class="w-36 my-0" alt="Xentra Logo" />


            </a>
            <!-- Move the input before the nav for peer to work -->
            <input class="peer hidden" type="checkbox" id="navbar-open" />

            <!-- Label for toggle button -->
            <label class="absolute right-4 top-6 cursor-pointer text-black text-2xl sm:hidden" for="navbar-open">
                <span class="sr-only">Toggle Navigation</span>
                <i class="fa-solid fa-bars"></i>
            </label>


            <nav aria-label="Header Navigation" class="peer-checked:block hidden pl-2 py-6 sm:block sm:py-0">
                <ul class="flex flex-col gap-y-4 sm:flex-row sm:gap-x-8  md:items-center">

                    <li>
                        <a href="/">
                            <button class="text-black hover:text-orange-400"><i class="fas fa-house"></i>
                                <span class="border-b-2 border-orange-500">Home</span></button>
                        </a>

                    </li>
                    <li>
                        <a href="/products">
                            <button class="text-black hover:text-orange-400"><i class="fas fa-prescription-bottle"></i>
                                <span class="">Products</span></button>
                        </a>

                    </li>
                    <li>
                        <a href="/aboutus">
                            <button class="text-black hover:text-orange-400"><i class="fas fa-question-circle"></i>
                                About us</button>
                        </a>
                    </li>
                    {{-- <li>
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
                            <div x-data="{ open: false }" class="relative flex  my-auto gap-3 items-center">
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
                    </li> --}}
                </ul>
            </nav>
        </div>

    </header>



    <!-- Changed background color to green -->
    <section class="pt-12 bg-center bg-cover" style="background-image: url('{{ asset('IMAGES/xentraherobg.png') }}');">

        <div id="animated-section"
            class="grid max-w-screen-xl sm:h-fit md:h-fit px-4 py-24 mt-12 mx-auto lg:gap-8 xl:gap-0 lg:py-12 lg:grid-cols-12 opacity-0 transition-opacity duration-1000">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-bold tracking-tight leading-none md:text-4xl xl:text-5xl text-black">
                    Distributor of Quality and affordable Medicines
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-700 lg:mb-8 md:text-lg lg:text-xl">
                    With a commitment to excellence, we ensure your shelves are stocked with the best.
                </p>
                <a href="#whyus"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-orange-500 rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Learn more
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="/products"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-orange-500 border border-orange-300 rounded-lg hover:bg-orange-300 focus:ring-4 focus:ring-green-100 ">
                    Products
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img id="animateRight" src="{{ asset('IMAGES/xentrahero.png') }}"
                    class="opacity-0 -translate-x-full transition-all duration-1000 w-full" />
                {{-- <img src="{{ asset('IMAGES/dna.png') }}" class="opacity-40 absolute h-28 mt-2 ml-96" /> --}}
            </div>
            {{-- <img src="{{ asset('IMAGES/dna.png') }}" class="opacity-30 absolute h-24 mt-12" /> --}}

        </div>

    </section>
    <section id="quality"
        class="px-6 sm:px-12  md:px-20 lg:px-28 py-12 sm:py-12 md:py-12 opacity-0 translate-y-20 transition-all duration-1000">
        <div id="quality"
            class=" flex justify-center italic text-3xl font-bold mb-8 text-gray-800 text-center opacity-0 translate-y-20 transition-all duration-1000">
            Xentra Medica Corp.
        </div>
        <div class="relative w-full h-fit sm:h-fit md:h-fit overflow-hidden rounded-lg shadow-lg ">


            <div class="relative w-full h-full overflow-hidden ">
                <div class="flex transition-transform duration-500 ease-in-out w-full h-full" id="slider">
                    @foreach ($adone as $adones)
                        <img src="{{ asset('storage/' . $adones->image) }}"
                            class="w-full h-full object-contain flex-shrink-0">
                    @endforeach
                </div>
            </div>

            <!-- Navigation Buttons -->
            <button id="prev"
                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-1 sm:p-2 rounded-full">❮</button>
            <button id="next"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gray-500 text-white p-1 sm:p-2 rounded-full">❯</button>
        </div>
    </section>





    <section id="whyus"
        class="text-gray-700 body-font mx-auto mt-10 py-10 bg-[url('/public/IMAGES/bg3.png')] bg-center bg-cover">
        <div id="quality"
            class=" flex justify-center italic text-3xl font-bold text-gray-800 text-center opacity-0 translate-y-20 transition-all duration-1000">
            Featured Products
        </div>

        <div class="container px-4 py-12 mx-auto" x-data="{ scrollLeft: 0 }">
            <div class="relative overflow-hidden">
                <!-- Scrollable Wrapper -->
                <div class="flex space-x-4 overflow-x-auto scrollbar-hide scroll-smooth" id="slider">
                    @forelse ($products as $product)
                        <div class="min-w-[200px] p-4">
                            <div onclick="window.location.href='{{ route('products') }}'"
                                class="px-4 py-4 transform transition-all duration-500 hover:scale-110 h-48 bg-white rounded-lg shadow-md">
                                <div class="flex justify-center">
                                    <div class="w-32 h-28 p-2 flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            class="w-full rounded-full">
                                    </div>
                                </div>
                                <h2
                                    class="text-center font-normal text-sm  sm:text-xs md:text-sm text-gray-700 uppercase leading-tight">
                                    {{ $product->name }}</h2>
                                {{-- <h2
                                    class="text-center font-bold text-sm  sm:text-xs md:text-sm text-green-500 uppercase leading-tight">
                                    ₱{{ $product->price }}</h2> --}}
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-lg text-center w-full">No products found.</p>
                    @endforelse
                </div>

                <!-- Navigation Buttons -->
                <button @click="document.getElementById('slider').scrollLeft -= 200"
                    class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-600 text-white p-2 rounded-full">
                    ❮
                </button>
                <button @click="document.getElementById('slider').scrollLeft += 200"
                    class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-600 text-white p-2 rounded-full">
                    ❯
                </button>
            </div>
        </div>
    </section>
    <section>
        <div id="quality"
            class="opacity-0 translate-y-20 transition-all mt-14 duration-1000 mb-4 w-full mx-auto max-w-7xl p-6 bg-white rounded-md">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Left Column (Image) -->
                <div class="overflow-hidden rounded-lg">
                    <img id="slideshow" class="w-full sm:h-96 h-72 fade show" alt="Slideshow Image">
                </div>
                <!-- Right Column (Description) -->
                <div class="flex flex-col justify-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Placeholder</h2>
                    <p class="text-lg text-gray-700 mb-4 text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed
                        cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis
                        ipsum. Praesent mauris.
                    </p>

                </div>
            </div>
        </div>
    </section>



    <footer class="bg-gradient-to-r from-gray-700 via-gray-600 to-gray-500">

        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="" class="flex items-center">
                        <img src="{{ asset('IMAGES/xentra2.png') }}" class="w-44 me-3"
                            alt="Logo" />

                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                        <ul class="text-gray-200 font-medium">
                            <li class="mb-4">
                                <a href="https://flowbite.com/" class="hover:underline">Flowbite</a>
                            </li>
                            <li>
                                <a href="https://tailwindcss.com/" class="hover:underline">Tailwind CSS</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                        <ul class="text-gray-200 font-medium">
                            <li class="mb-4">
                                <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Github</a>
                            </li>
                            <li>
                                <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Discord</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                        <ul class="text-gray-200 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-100 sm:text-center ">© 2025 <a href="https://flowbite.com/"
                        class="hover:underline">Xentra Medica Corp.</a> All Rights Reserved.
                </span>

            </div>
        </div>

    </footer>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const images = [
            'https://c8.alamy.com/comp/AYCGDB/medicines-on-pharmacy-shelves-AYCGDB.jpg',
            'https://eurorack.vn/vnt_upload/service/10_2019/ke_de_duoc_pham_5.jpg',
            'https://images.seattletimes.com/wp-content/uploads/2024/11/11182024_coldmeds111824-tzr_tzr_042810.jpg?d=1200x630'
        ];

        let currentIndex = 0;
        const imgElement = document.getElementById('slideshow');

        function changeImage() {
            imgElement.classList.remove("show"); // Start fade out
            setTimeout(() => {
                currentIndex = (currentIndex + 1) % images.length;
                imgElement.src = images[currentIndex];
                imgElement.classList.add("show"); // Fade in new image
            }, 1000); // Wait for fade out before changing
        }

        // Initialize first image
        imgElement.src = images[currentIndex];

        // Change image every 3 seconds
        setInterval(changeImage, 3000);
    });

    const slider = document.getElementById("slider");
    const prev = document.getElementById("prev");
    const next = document.getElementById("next");

    let index = 0;
    const slides = slider.children.length;

    function updateSlide() {
        slider.style.transform = `translateX(-${index * 100}%)`;
    }

    next.addEventListener("click", () => {
        index = (index + 1) % slides;
        updateSlide();
    });

    prev.addEventListener("click", () => {
        index = (index - 1 + slides) % slides;
        updateSlide();
    });
</script>


</html>
