<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Modify Products</title>
</head>

<body class="font-mono">
    <!-- source: https://github.com/mfg888/Responsive-Tailwind-CSS-Grid/blob/main/index.html -->

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
    <main class="flex-1 ml-0 sm:ml-64 p-4 transition-all" x-data="productEditor()">
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
        <div class="mt-28 mx-4 justify-items-center justify-center">
            <form method="GET" action="/modifyproducts" x-data="{ search: '{{ request('search') }}' }"
                class=" flex flex-wrap gap-4 justify-start" x-init="$watch('search', value => $event.target.form.submit())">

                <!-- Search Bar (Auto-submits when typing) -->
                <input type="text" name="search" x-model="search" placeholder="Search products..."
                    class="border text-sm border-gray-300 rounded-md px-3 py-1 text-gray-700 w-32">

                <!-- Category Filter (Auto-submits on change) -->
                <select name="category" class="border border-gray-300 rounded-md px-3 py-1 text-sm w-32 text-gray-700"
                    x-on:change="$event.target.form.submit()">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ ucfirst($category) }}
                        </option>
                    @endforeach
                </select>

                <!-- Brand Filter (Auto-submits on change) -->
                <select name="brand" class="border border-gray-300 rounded-md px-3 py-1 text-sm text-gray-700"
                    x-on:change="$event.target.form.submit()">
                    <option value="">All Brands</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
                            {{ ucfirst($brand) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
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
        <!-- ✅ Grid Section - Starts Here 👇 -->
        <div class="w-full p-4 text-xs">

            <table class="w-full border-collapse border border-gray-300">
                <thead class="">
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Image</th>
                        <th class="border border-gray-300 px-4 py-2">Category</th>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Brand</th>
                        <th class="border border-gray-300 px-4 py-2">Details</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border border-gray-300">
                            <td class="border border-gray-300 px-4 py-2 ">
                                <img class="h-10 mx-auto"
                                    src="{{ isset($product->image) && !empty($product->image) ? asset('storage/' . $product->image) : asset('IMAGES/logowestpoint.png') }}"
                                    alt="Product Image" />
                            </td>
                            <td class="border border-gray-300 px-4 py-2 ">{{ $product->category }}</td>
                            <td class="border border-gray-300 px-4 py-2 ">{{ $product->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 r">{{ $product->brand }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-justify text-xs">
                                <div x-data="{ expanded: false }">
                                    <p :class="expanded ? '' : 'line-clamp-2'">{{ $product->details }}</p>
                                    <button @click="expanded = !expanded"
                                        class="text-blue-600 text-xs font-medium hover:underline">
                                        <span x-show="!expanded">Read More</span>
                                        <span x-show="expanded">Show Less</span>
                                    </button>
                                </div>
                            </td>

                            <td class="gap-6 px-4 py-2 text-center flex">
                                <div class="my-auto pt-2 flex justify-center content-center items-center">
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            @click.prevent="if(confirm('Are you sure?')) { fetch('{{ route('products.destroy', $product->id) }}', { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } }); }"
                                            class="text-red-500 text-sm rounded-md hover:bg-red-800">
                                            <i class="fa fa-trash text-red-500 p-1"> </i>
                                        </button>
                                    </form>
                                    <a href="#"
                                        @click.prevent="openEditModal({{ $product->id }}, '{{ $product->category }}', '{{ $product->name }}', '{{ $product->brand }}', '{{ $product->details }}')"
                                        class="text-blue-500 text-xs hover:bg-blue-800 font-medium rounded-lg p-1">
                                        <i class="fa fa-pen"></i>
                                    </a>

                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-gray-500 text-lg text-center py-4">No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Edit Product Modal -->
            <div x-show="editModalOpen"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
                    <h2 class="text-lg font-bold mb-4">Edit Product</h2>

                    <form @submit.prevent="updateProduct">
                        <input type="hidden" x-model="editProduct.id">

                        <div class="mb-2">
                            <label class="block text-sm font-semibold">Category</label>
                            <input type="text" x-model="editProduct.category" class="w-full border p-2 rounded">
                        </div>

                        <div class="mb-2">
                            <label class="block text-sm font-semibold">Name</label>
                            <input type="text" x-model="editProduct.name" class="w-full border p-2 rounded">
                        </div>

                        <div class="mb-2">
                            <label class="block text-sm font-semibold">Brand</label>
                            <input type="text" x-model="editProduct.brand" class="w-full border p-2 rounded">
                        </div>

                        <div class="mb-2">
                            <label class="block text-sm font-semibold">Details</label>
                            <textarea x-model="editProduct.details" class="w-full border p-2 rounded"></textarea>
                        </div>

                        <div class="mb-2">
                            <label class="block text-sm font-semibold">Image</label>
                            <input type="file" @change="handleFileUpload" class="w-full border p-2 rounded">
                        </div>

                        <div class="flex justify-end space-x-2 mt-4">
                            <button type="button" @click="editModalOpen = false"
                                class="px-4 py-2 bg-gray-400 text-white rounded-lg">Cancel</button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
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


        function productEditor() {
            return {
                editModalOpen: false,
                editProduct: {
                    id: null,
                    category: '',
                    name: '',
                    brand: '',
                    details: '',
                    image: null,
                },

                openEditModal(id, category, name, brand, details) {
                    this.editProduct.id = id;
                    this.editProduct.category = category;
                    this.editProduct.name = name;
                    this.editProduct.brand = brand;
                    this.editProduct.details = details;
                    this.editModalOpen = true;
                },

                handleFileUpload(event) {
                    this.editProduct.image = event.target.files[0];
                },

                async updateProduct() {
                    let formData = new FormData();
                    formData.append('_method', 'PUT'); // Laravel requires this for PUT requests
                    formData.append('category', this.editProduct.category);
                    formData.append('name', this.editProduct.name);
                    formData.append('brand', this.editProduct.brand);
                    formData.append('details', this.editProduct.details);
                    if (this.editProduct.image) {
                        formData.append('image', this.editProduct.image);
                    }

                    let response = await fetch(`/products/${this.editProduct.id}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    });

                    if (response.ok) {
                        Swal.fire("Success!", "Product updated successfully.", "success").then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error!", "Failed to update product.", "error");
                    }
                }
            };
        }
    </script>
</body>

</html>
