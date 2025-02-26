<!DOCTYPE html>
<html lang="en" x-data="{ openModal: false }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="{{ asset('IMAGES/xentra6.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Westpoint pharma inc.</title>
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
                                class="block py-2 px-4 rounded hover:bg-green-200 text-gray-700">Change Password</a>
                        </li>
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

        <section class="mt-32 grid grid-cols-2">
            <div class="bg-white border border-4 rounded-lg shadow relative m-10">
                <div class="flex items-start justify-between p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold">
                        Add Category
                    </h3>
                </div>
                @if (session('error'))
                    <div class="p-4 m-1 text-sm text-red-700 bg-red-100 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="p-4 m-1 text-sm text-green-700 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="p-6 space-y-6 ">
                    <form action="{{ route('category.store') }}" method="POST" class="grid grid-cols-2 gap-4">
                        @csrf
                        <div class=" ">
                            <label for="category_name" class="block text-sm font-medium text-gray-700">Category
                                Name</label>
                            <input type="text" id="category_name" name="category_name" required
                                class=" p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="w-full h-full justify-center items-center object-center flex mt-2.5">
                            <button type="submit"
                                class="px-4 py-2 w-full bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Add Category
                            </button>
                        </div>

                    </form>
                </div>
                <div class="px-6 py-2">
                    <h3 class="text-lg font-semibold">Category List</h3>
                    <table class="w-full text-xs border-collapse border border-gray-300 mt-2">
                        <thead>
                            <tr class="bg-gray-100">

                                <th class="border border-gray-300 px-4 py-2">Category Name</th>
                                <th class="border border-gray-300 px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs">
                            @foreach ($category as $key => $categorys)
                                <tr>

                                    <td class="border border-gray-300 px-4 py-2">{{ $categorys->category_name }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <form action="{{ route('category.destroy', $categorys->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="mt-4 text-xs">
                        {{ $category->links() }} <!-- Pagination links -->
                    </div>
                </div>
            </div>


            <div class="bg-white border border-4 rounded-lg shadow relative m-10">
                <div class="flex items-start justify-between p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold">
                        Add Brands
                    </h3>
                </div>
                @if (session('error'))
                    <div class="p-4 m-1 text-sm text-red-700 bg-red-100 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="p-4 m-1 text-sm text-green-700 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="p-6 space-y-6 ">
                    <form action="{{ route('brand.store') }}" method="POST" class="grid grid-cols-2 gap-4">
                        @csrf
                        <div class=" ">
                            <label for="brand_name" class="block text-sm font-medium text-gray-700">Brand Name</label>
                            <input type="text" id="brand_name" name="brand_name" required
                                class=" p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="w-full h-full justify-center items-center object-center flex mt-2.5">
                            <button type="submit"
                                class="px-4 py-2 w-full bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Add Brand
                            </button>
                        </div>

                    </form>
                </div>
                <div class="px-6 py-2">
                    <h3 class="text-lg font-semibold">Brand List</h3>
                    <table class="w-full text-xs border-collapse border border-gray-300 mt-2">
                        <thead>
                            <tr class="bg-gray-100">

                                <th class="border border-gray-300 px-4 py-2">Brand Name</th>
                                <th class="border border-gray-300 px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs">
                            @foreach ($brands as $key => $brand)
                                <tr>

                                    <td class="border border-gray-300 px-4 py-2">{{ $brand->brand_name }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <form action="{{ route('brand.destroy', $brand->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this brand?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="mt-4 text-xs">
                        {{ $brands->links() }} <!-- Pagination links -->
                    </div>
                </div>
            </div>

            <div class="bg-white border border-4 rounded-lg shadow relative m-10">
                <div class="flex items-start justify-between p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold">
                        Add Unit of Measurement
                    </h3>
                </div>
                @if (session('error'))
                    <div class="p-4 m-1 text-sm text-red-700 bg-red-100 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="p-4 m-1 text-sm text-green-700 bg-green-100 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="p-6 space-y-6 ">
                    <form action="{{ route('unit.store') }}" method="POST" class="grid grid-cols-2 gap-4">
                        @csrf
                        <div class=" ">
                            <label for="unit_type" class="block text-sm font-medium text-gray-700">Unit Type</label>
                            <input type="text" id="unit_type" name="unit_type" required
                                class=" p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="w-full h-full justify-center items-center object-center flex mt-2.5">
                            <button type="submit"
                                class="px-4 py-2 w-full bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Add Unit
                            </button>
                        </div>

                    </form>
                </div>
                <div class="px-6 py-2">
                    <h3 class="text-lg font-semibold">Unit List</h3>
                    <table class="w-full text-xs border-collapse border border-gray-300 mt-2">
                        <thead>
                            <tr class="bg-gray-100">

                                <th class="border border-gray-300 px-4 py-2">Unit Name</th>
                                <th class="border border-gray-300 px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs">
                            @foreach ($units as $key => $unit)
                                <tr>

                                    <td class="border border-gray-300 px-4 py-2">{{ $unit->unit_type }}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center">
                                        <form action="{{ route('unit.destroy', $unit->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this unit?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="mt-4 text-xs">
                        {{ $units->links() }} <!-- Pagination links -->
                    </div>
                </div>
            </div>


        </section>

        <!-- Changed background color to green -->
    </main>
    <script>
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
