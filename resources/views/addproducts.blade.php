<!DOCTYPE html>
<html lang="en" x-data="{ openModal: false }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery & Select2 JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <link rel="icon" type="image/png" href="{{ asset('IMAGES/xentra6.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
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
    </style>
</head>


<body class="font-mono">
    <aside
        class="fixed mt-20 left-0 top-0 w-64 h-screen bg-white shadow-lg p-4 transition-transform transform -translate-x-full sm:translate-x-0">
        <div class="flex items-center justify-between mb-6">


        </div>
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="/admin" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                </li>
                {{-- <li>
                    <a href="/admin/orders" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">
                        <i class="fas fa-shopping-cart mr-2"></i>Orders
                    </a>
                </li>
                <li>
                    <a href="/admin/users" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">
                        <i class="fas fa-user mr-2"></i>Users
                    </a>
                </li> --}}
                <li>
                    <a href="/admin/messages" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">
                        <i class="fas fa-envelope mr-2"></i>Messages
                    </a>
                </li>
                <li>
                    <a href="/manage/content" class="block py-2 px-4 rounded hover:bg-green-100 text-gray-700">
                        <i class="fas fa-newspaper mr-2"></i>Manage Content
                    </a>
                </li>
                <li>
                    <button id="settingsToggle"
                        class="w-full text-left block py-2 px-4 rounded hover:bg-green-100 text-gray-700 flex justify-between items-center">
                        <span><i class="fas fa-cogs mr-2"></i>Settings</span>
                        <i class="fas fa-chevron-down transition-transform duration-300"></i>
                    </button>
                    <ul id="settingsSublist" class="ml-6 mt-1 hidden space-y-2">
                        <li><a href="/addproducts" class="block py-2 px-4 rounded hover:bg-green-200 text-gray-700">Add
                                Products</a></li>
                        <li><a href="/modifyproducts"
                                class="block py-2 px-4 rounded hover:bg-green-200 text-gray-700">Modify
                                Products</a></li>
                        <li><a href="/moresettings"
                                class="block py-2 px-4 rounded hover:bg-green-200 text-gray-700">More Settings</a></li>
                        <li><a href="/admin/changepassword"
                                class="block py-2 px-4 rounded hover:bg-green-200 text-gray-700">Change Password</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="logout-btn" class="block py-2 px-4 rounded hover:bg-red-100 text-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </li>
                <form id="logout-form" action="/auth/admin-logout" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>

        </nav>
    </aside>
    <main class="flex-1 ml-0 sm:ml-64 p-4 transition-all">
        <header
            class="fixed border-b-4 border-orange-500 top-0 left-0 right-0 mb-2 px-4 shadow bg-white z-50 backdrop-filter backdrop-blur-xl bg-opacity-30">

            <div
                class="relative mx-auto flex max-w-screen-lg flex-col py-4 sm:flex-row sm:items-center sm:justify-between">
                <a class="flex items-center text-2xl font-black" href="/admin">
                    <img src="{{ asset('IMAGES/xentra1.png') }}" class="w-36 my-0" alt="BISU Logo" />


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

        <section class="mt-32">
            <div class="bg-white border border-4 rounded-lg shadow relative m-10">

                <div class="flex items-start justify-between p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold">
                        Add product
                    </h3>
                    @if (session('error'))
                        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div>
                        <!-- Button to open modal -->
                        <a href="{{ asset('file/products.xlsx') }}" download
                            class="text-orange-600 text-sm hover:underline">
                            <i class="fa fa-download"></i> Excel Format
                        </a>

                        <button @click="openModal = true"
                            class="text-white bg-orange-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200
                                   font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Batch Upload Products
                        </button>

                        <!-- Modal -->
                        <div x-show="openModal"
                            class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                <!-- Modal Header -->
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">Batch Upload Products</h2>

                                <!-- File Upload Form -->
                                <form action="{{ route('products.import') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" required class="border p-2 w-full rounded-md"
                                        accept=".xls, .xlsx">

                                    <!-- Modal Buttons -->
                                    <div class="flex justify-end mt-4 space-x-2">
                                        <button @click="openModal = false" type="button"
                                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">
                                            Cancel
                                        </button>
                                        <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-md">
                                            Upload
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>


                </div>

                <div class="p-6 space-y-6">

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


                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-6 gap-6">
                            <!-- First Row (3 columns) -->
                            <div class="col-span-6 sm:col-span-2">
                                <label for="name" class="text-sm font-medium text-gray-900 block mb-2">Product
                                    Name</label>
                                <input type="text" name="name" id="name"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                    placeholder="Product" required>
                            </div>

                            <div class="col-span-2 sm:col-span-2 ">
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label for="category" class="text-sm font-medium text-gray-900 block mb-2">
                                            Category
                                            <a class="text-xs text-blue-500 underline" href="/moresettings">add
                                                category</a>
                                        </label>

                                        <select name="category" id="category"
                                            class="select2-dropdown shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600  w-36 p-2.5"
                                            required>
                                            <option value="" disabled selected>Select a Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_name }}">
                                                    {{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">
                                            Brand
                                            <a class="text-xs text-blue-500 underline" href="/moresettings">add
                                                brand</a>
                                        </label>

                                        <select name="brand" id="brand"
                                            class="select2-dropdown1 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-36 p-2.5"
                                            required>
                                            <option value="" disabled selected>Select a Brand</option>
                                            @foreach ($brand as $brands)
                                                <option value="{{ $brands->brand_name }}">{{ $brands->brand_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <label for="category" class="text-sm font-medium text-gray-900 block mb-2">
                                    Unit
                                    <a class="text-xs text-blue-500 underline" href="/moresettings">add unit</a>
                                </label>
                                <!--Comment for now-->
                                <select name="unit" id="unit"
                                    class="select2-dropdown2 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-36 p-2.5"
                                    required>
                                    <option value="" disabled selected>Select a Unit</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->unit_type }}">{{ $unit->unit_type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Second Row -->
                            {{-- <div class="col-span-6 sm:col-span-2">
                                <label for="price"
                                    class="text-sm font-medium text-gray-900 block mb-2">Price</label>
                                <input type="number" name="price" id="price"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                    placeholder="Price" min="1" required>
                            </div> --}}
                            {{-- <div class="col-span-6 sm:col-span-2">
                                <label for="stocks"
                                    class="text-sm font-medium text-gray-900 block mb-2">Stocks</label>
                                <input type="number" name="stocks" id="stocks"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                    placeholder="Stocks" value="1" min="1" required>
                            </div> --}}
                            <div class="col-span-6 sm:col-span-2">
                                <label for="image" class="text-sm font-medium text-gray-900 block mb-2">Image <span
                                        class="text-red-500">*jpg/png</span></label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                            </div>

                            <!-- Third Row (Full Width) -->
                            <div class="col-span-6">
                                <label for="details" class="text-sm font-medium text-gray-900 block mb-2">Product
                                    Details</label>
                                <textarea name="details" id="details" rows="6"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-4"
                                    placeholder="Details"></textarea>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 rounded-b w-full flex justify-end">
                            <button
                                class="text-white bg-orange-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                type="submit">
                                Add Product
                            </button>
                        </div>
                    </form>
                </div>



            </div>
        </section>


        <!-- Changed background color to green -->
    </main>
    <script>
        $(document).ready(function() {
            $('.select2-dropdown').select2({
                placeholder: "Select a Category",
                allowClear: true
            });
        });

        $(document).ready(function() {
            $('.select2-dropdown1').select2({
                placeholder: "Select a brand",
                allowClear: true
            });
        });

        $(document).ready(function() {
            $('.select2-dropdown2').select2({
                placeholder: "Select Unit Type",
                allowClear: true
            });
        });

        document.getElementById('logout-btn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default action

            Swal.fire({
                title: "Are you sure?",
                text: "You will be logged out.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, Logout!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit(); // Submit the logout form
                }
            });
        });

        // Sidebar Toggle for Mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('aside').classList.toggle('-translate-x-full');
        });

        document.getElementById('mobileMenuToggle')?.addEventListener('click', function() {
            document.querySelector('aside').classList.toggle('-translate-x-full');
        });
        document.getElementById('settingsToggle').addEventListener('click', function() {
            let sublist = document.getElementById('settingsSublist');
            let icon = this.querySelector('i:last-child');

            sublist.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    </script>
</body>


</html>
