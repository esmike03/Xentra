<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About us</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="{{ asset('IMAGES/xentra6.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

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
        class="fixed border-b-4 border-orange-500 top-0 left-0 right-0 mb-2 px-4 shadow bg-white z-50 backdrop-filter backdrop-blur-xl bg-opacity-30">

        <div class="relative mx-auto flex max-w-screen-lg flex-col py-4 sm:flex-row sm:items-center sm:justify-between">
            <a class="flex items-center text-2xl font-black" href="/">
                <img src="{{ asset('IMAGES/xentra1.png') }}" class="w-36 my-0" alt="Logo" />


            </a>
            <!-- Move the input before the nav for peer to work -->
            <input class="peer hidden" type="checkbox" id="navbar-open" />

            <!-- Label for toggle button -->
            <label class="absolute right-4 top-6 cursor-pointer text-black text-2xl sm:hidden" for="navbar-open">
                <span class="sr-only">Toggle Navigation</span>
                <i class="fa-solid fa-bars"></i>
            </label>
            <nav aria-label="Header Navigation" class="peer-checked:block hidden pl-2 py-6 sm:block sm:py-0">
                <ul class="flex flex-col gap-y-4 sm:flex-row sm:gap-x-8">

                    <li>
                        <a href="/">
                            <button class="text-black hover:text-orange-400"><i class="fas fa-house"></i>
                                <span class="">Home</span></button>
                        </a>

                    </li>
                    <li>
                        <a href="/products">
                            <button class="text-black hover:text-orange-400"><i class="fas fa-prescription-bottle"></i>
                                Products</button>
                        </a>

                    </li>
                    <li>
                        <a href="/aboutus">
                            <button class="text-black  hover:text-orange-400">
                                <i class="fas fa-question-circle"></i> <span class="border-b-2 border-orange-500">About
                                    us</span>
                            </button>
                        </a>

                    </li>
                    <li @click="messageOpen = true">
                        <a href="#contact">
                            <button class="text-black hover:text-orange-400"><i class="fa-solid fa-envelope"></i>
                                Contact us</button>
                        </a>

                    </li>
                </ul>
            </nav>
        </div>

    </header>
    <!-- about us -->
    <section class="bg-[url('/public/IMAGES/bg2.png')] bg-center bg-cover" id="aboutus">
        <div class="container mt-14 mx-auto py-16 px-6  sm:px-6 lg:px-8 ">
            <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-8">
                <div class="max-w-lg">
                    <h2 class="text-3xl font-bold text-orange-500 mb-8 italic  px-2">
                        About us</h2>
                    <p class="mt-2 text-gray-600 text-lg text-justify italic">
                        Xentra Medica Cebu Corp. is a pharmaceutical distribution company dedicated to providing
                        high-quality healthcare products and services to the healthcare industry in Cebu and beyond.
                        With a commitment to excellence, innovation, and customer satisfaction, we have emerged as a
                        trusted partner for healthcare providers and professionals.
                    </p>
                </div>
                <div class="mt-4 md:mt-16">
                    <img src="{{ asset('images/WESTPOINT.jpg') }}" alt="About Us Image"
                        class="w-full h-full object-cover rounded-lg">
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 italic">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">

                <!-- Mission Column -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold text-orange-500 mb-4  px-1">
                        Mission</h3>
                    <p class="text-gray-600 text-justify">To enhance the health and well-being of communities by
                        ensuring the timely and reliable distribution of pharmaceutical products and medical supplies
                        while upholding the highest ethical and quality standards.</p>
                </div>

                <!-- Vision Column -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold text-orange-500 mb-4  px-1">
                        Products and Services</h3>
                    <p class="text-gray-600 text-justify">Pharmaceutical Distribution: We offer a wide range of
                        pharmaceutical products, including branded and generic medications, vaccines, and medical
                        supplies.</p>
                </div>

                <!-- Core Values Column -->


            </div>
            <div class="bg-white mt-6 p-6 rounded-lg shadow-lg ">
                <h3 class="text-2xl font-semibold text-orange-500 mb-4  px-1">
                    Core Values</h3>
                {{-- <p class="text-gray-600 text-justify mb-2">In everything we do, we are grounded by the following rules: --}}
                </p>
                <p class="text-gray-800 text-justify mb-2"><span class="font-bold">Excellence</span> - We strive for
                    excellence in all aspects of our operations, from product selection to customer service.</p>
                <p class="text-gray-800 text-justify mb-2"><span class="font-bold">Integrity</span> - We
                    conduct our business with the utmost integrity, ensuring transparency and ethical practices.</p>
                <p class="text-gray-800 text-justify mb-2"><span class="font-bold">Customer-centric</span> - Our
                    customers are at the heart of everything we do, and we continuously seek ways to meet their needs.
                </p>
                <p class="text-gray-800 text-justify mb-2"><span class="font-bold">Innovation</span> - We embrace
                    innovation to adapt to the evolving healthcare landscape and improve patient outcomes.</p>
                <p class="text-gray-800 text-justify mb-2"><span class="font-bold">Teamwork</span> - Collaboration and
                    teamwork are integral to our success, both internally and with our partners.</p>
                {{-- <p class="text-gray-800 text-justify mb-2"><span class="font-bold">Perseverance</span> - being
                    hardworking and finishing taks despite barriers and obstacles encountered.</p> --}}
            </div>
        </div>
    </section>
    <section>
        {{-- <div class="w-full max-w-5xl mx-auto p-6" x-data="{ scrollAmount: 300 }">
            <h2 class="text-3xl font-bold text-center mb-6">Meet Our Team</h2>
            <div class="relative">
                <!-- Scroll Buttons -->
                <button @click="$refs.team.scrollBy({ left: -scrollAmount, behavior: 'smooth' })" class="absolute left-0 top-1/2 -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full shadow-lg">◀</button>
                <button @click="$refs.team.scrollBy({ left: scrollAmount, behavior: 'smooth' })" class="absolute right-0 top-1/2 -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full shadow-lg">▶</button>

                <!-- Scrollable Team Section -->
                <div class="flex space-x-4 overflow-x-auto scroll-smooth no-scrollbar" x-ref="team">
                    <template x-for="i in 5" :key="i">
                        <div class="flex-shrink-0 w-64 bg-white p-4 rounded-lg shadow-lg text-center">
                            <img :src="'https://via.placeholder.com/150?text=Person+' + i" alt="Team Member" class="w-32 h-32 mx-auto rounded-full mb-4">
                            <h3 class="text-xl font-semibold">Member <span x-text="i"></span></h3>
                            <p class="text-gray-500">Position</p>
                        </div>
                    </template>
                </div>
            </div>
        </div> --}}

        <div class="w-full mx-auto p-6" x-data="{ members: {{ $members->toJson() }}, scrollAmount: 300 }">

            <h2 class="text-3xl font-bold text-center mb-6 italic">Xentra Medica Team</h2>
            <div class="relative">
                <!-- Scroll Buttons -->
                <button @click="$refs.team.scrollBy({ left: -scrollAmount, behavior: 'smooth' })"
                    class="absolute left-0 top-1/2 -translate-y-1/2 text-gray-800 p-2 rounded-full shadow-lg">
                    <i class="fa fa-circle-left"></i>
                </button>
                <button @click="$refs.team.scrollBy({ left: scrollAmount, behavior: 'smooth' })"
                    class="absolute right-0 top-1/2 -translate-y-1/2 text-gray-800 p-2 rounded-full shadow-lg">
                    <i class="fa fa-circle-right"></i>
                </button>

                <!-- Scrollable Team Section -->
                <div class="flex space-x-4 overflow-x-auto scroll-smooth no-scrollbar" x-ref="team">
                    <template x-for="member in members" :key="member.id">
                        <div class="flex-shrink-0 w-64 p-4 rounded-lg text-center">
                            <img :src="member.image ? '/storage/' + member.image : 'https://via.placeholder.com/150'"
                                alt="Team Member" class="w-32 h-32 mx-auto rounded-full mb-4">
                            <h3 class="text-xl font-semibold" x-text="member.name"></h3>
                            <p class="text-gray-500" x-text="member.position"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </section>

    <section id="quality" class="px-6 sm:px-12  md:px-20 lg:px-28 py-12 sm:py-12 md:py-12 ">
        <div id="quality" class=" flex justify-center italic text-3xl font-bold mb-8 text-gray-800 text-center ">
            Gallery
        </div>
        <div class="relative w-full h-fit sm:h-fit md:h-fit overflow-hidden rounded-lg shadow-lg ">


            <div class="relative w-full h-full overflow-hidden ">
                <div class="flex transition-transform duration-500 ease-in-out w-full h-full" id="slider">
                    @foreach ($adtwo as $adtwos)
                        <img src="{{ asset('storage/' . $adtwos->image) }}"
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

    <!-- contact us form -->
    <section id="contact" class="py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 grid-cols-1">
                <div class="lg:mb-0 mb-10">
                    <div class="group w-full h-full">
                        <div class="relative h-full">
                            <img src="https://pagedone.io/asset/uploads/1696488602.png"
                                alt="ContactUs tailwind section"
                                class="w-full h-full lg:rounded-l-2xl rounded-2xl bg-blend-multiply bg-indigo-700 object-cover" />
                            <h1 class="font-manrope text-white text-4xl font-bold leading-10 absolute top-11 left-11">
                                Contact us</h1>
                            <div class="absolute bottom-0 w-full lg:p-11 p-5">
                                <div class="bg-white rounded-lg p-6 block">
                                    <a href="javascript:;" class="flex items-center mb-6">
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M22.3092 18.3098C22.0157 18.198 21.8689 18.1421 21.7145 18.1287C21.56 18.1154 21.4058 18.1453 21.0975 18.205L17.8126 18.8416C17.4392 18.9139 17.2525 18.9501 17.0616 18.9206C16.8707 18.891 16.7141 18.8058 16.4008 18.6353C13.8644 17.2551 12.1853 15.6617 11.1192 13.3695C10.9964 13.1055 10.935 12.9735 10.9133 12.8017C10.8917 12.6298 10.9218 12.4684 10.982 12.1456L11.6196 8.72559C11.6759 8.42342 11.7041 8.27233 11.6908 8.12115C11.6775 7.96998 11.6234 7.82612 11.5153 7.5384L10.6314 5.18758C10.37 4.49217 10.2392 4.14447 9.95437 3.94723C9.6695 3.75 9.29804 3.75 8.5551 3.75H5.85778C4.58478 3.75 3.58264 4.8018 3.77336 6.06012C4.24735 9.20085 5.64674 14.8966 9.73544 18.9853C14.0295 23.2794 20.2151 25.1426 23.6187 25.884C24.9335 26.1696 26.0993 25.1448 26.0993 23.7985V21.2824C26.0993 20.5428 26.0993 20.173 25.9034 19.8888C25.7076 19.6046 25.362 19.4729 24.6708 19.2096L22.3092 18.3098Z"
                                                stroke="#4F46E5" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <h5 class="text-black text-base font-normal leading-6 ml-5">
                                            (053) 561 2938</h5>
                                    </a>
                                    <a href="javascript:;" class="flex items-center mb-6">
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.81501 8.75L10.1985 13.6191C12.8358 15.2015 14.1544 15.9927 15.6032 15.9582C17.0519 15.9237 18.3315 15.0707 20.8905 13.3647L27.185 8.75M12.5 25H17.5C22.214 25 24.5711 25 26.0355 23.5355C27.5 22.0711 27.5 19.714 27.5 15C27.5 10.286 27.5 7.92893 26.0355 6.46447C24.5711 5 22.214 5 17.5 5H12.5C7.78595 5 5.42893 5 3.96447 6.46447C2.5 7.92893 2.5 10.286 2.5 15C2.5 19.714 2.5 22.0711 3.96447 23.5355C5.42893 25 7.78595 25 12.5 25Z"
                                                stroke="#4F46E5" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                        <h5 class="text-black text-base font-normal leading-6 ml-5">
                                            wpi.official2017@yahoo.com</h5>
                                    </a>
                                    <a href="javascript:;" class="flex items-center">
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M25 12.9169C25 17.716 21.1939 21.5832 18.2779 24.9828C16.8385 26.6609 16.1188 27.5 15 27.5C13.8812 27.5 13.1615 26.6609 11.7221 24.9828C8.80612 21.5832 5 17.716 5 12.9169C5 10.1542 6.05357 7.5046 7.92893 5.55105C9.8043 3.59749 12.3478 2.5 15 2.5C17.6522 2.5 20.1957 3.59749 22.0711 5.55105C23.9464 7.5046 25 10.1542 25 12.9169Z"
                                                stroke="#4F46E5" stroke-width="2" />
                                            <path
                                                d="M17.5 11.6148C17.5 13.0531 16.3807 14.219 15 14.219C13.6193 14.219 12.5 13.0531 12.5 11.6148C12.5 10.1765 13.6193 9.01058 15 9.01058C16.3807 9.01058 17.5 10.1765 17.5 11.6148Z"
                                                stroke="#4F46E5" stroke-width="2" />
                                        </svg>
                                        <h5 class="text-black text-base font-normal leading-6 ml-5">
                                            204 sss village, Ormoc City, Philippines</h5>
                                    </a>
                                    <a href="javascript:;" class="flex items-center mt-5">
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="15" cy="15" r="13" stroke="#4F46E5"
                                                stroke-width="2" />
                                            <line x1="15" y1="15" x2="15" y2="5"
                                                stroke="#4F46E5" stroke-width="2" />
                                            <line x1="15" y1="15" x2="22" y2="15"
                                                stroke="#4F46E5" stroke-width="2" />
                                        </svg>

                                        <h5 class="text-black text-base font-normal leading-6 ml-5">
                                            Monday - Saturday : 8am - 5pm</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-5 lg:p-11 lg:rounded-r-2xl rounded-2xl">
                    <h2 class="text-orange-600 font-manrope text-4xl font-semibold leading-10 mb-11">Send Us A Message
                    </h2>
                    <form id="messageForm">
                        <input type="text" name="name" id="name"
                            class="input-field w-full h-12 text-gray-600 placeholder-gray-400  shadow-sm bg-transparent text-lg font-normal leading-7 rounded-full border border-gray-200 focus:outline-none pl-4 mb-10"
                            placeholder="Name">
                        <input type="text" name="email" id="email"
                            class="input-field w-full h-12 text-gray-600 placeholder-gray-400 shadow-sm bg-transparent text-lg font-normal leading-7 rounded-full border border-gray-200 focus:outline-none pl-4 mb-10"
                            placeholder="Email">
                        <input type="text" name="phone" id="phone"
                            class="input-field w-full h-12 text-gray-600 placeholder-gray-400 shadow-sm bg-transparent text-lg font-normal leading-7 rounded-full border border-gray-200 focus:outline-none pl-4 mb-10"
                            placeholder="Phone">

                        <textarea type="text" name="message" id="message"
                            class="input-field w-full h-28 text-gray-600 placeholder-gray-400 bg-transparent text-lg shadow-sm font-normal leading-7 rounded-lg border border-gray-200 focus:outline-none pl-4 mb-10"
                            placeholder="Message"> </textarea>
                        <button
                            class="w-full h-12 text-white text-base font-semibold leading-6 rounded-full transition-all duration-700 hover:bg-orange-800 bg-orange-600 shadow-sm">Send</button>
                    </form>

                </div>
            </div>
    </section>

    <footer class="bg-gradient-to-r from-gray-700 via-gray-600 to-gray-500">

        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="" class="flex items-center">
                        <img src="{{ asset('IMAGES/xentra2.png') }}" class="w-44 me-3"
                            alt="FlowBite Logo" />

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
                        class="hover:underline">Xentro Medica Corp.</a> All Rights Reserved.
                </span>

            </div>
        </div>

    </footer>

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

        document.getElementById('messageForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let formData = new FormData(this);

            fetch("{{ route('send.message') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Message Sent!',
                        text: data.success,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });

                    // Clear form fields after submission
                    document.getElementById('messageForm').reset();
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Something went wrong. Please try again.',
                        confirmButtonColor: '#d33'
                    });
                });
        });
    </script>
</body>

</html>
