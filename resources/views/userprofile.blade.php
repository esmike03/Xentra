<!DOCTYPE html>
<html lang="en" x-data="{ showModal: false, selectedProduct: {} }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="{{ asset('IMAGES/logowestpoint.png') }}">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>Profile</title>
    <style>

    </style>
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

                                    <img @click="open = !open" class="h-8 w-8 rounded-full border-white border-1"
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
    <section class="bg-white mt-24 py-8 antialiased  md:py-8">
        <div class="mx-auto max-w-screen-lg px-4 2xl:px-0">

            <h2 class="mb-4 text-xl font-semibold text-gray-900  sm:text-2xl md:mb-6">Profile
            </h2>
            <div
                class="grid grid-cols-2 gap-6 border-b border-t border-gray-200 py-4  md:py-8 lg:grid-cols-4 xl:gap-16">
                <div>

                    <a href="/my-orders">
                        <svg class="mb-2 h-8 w-8 text-gray-400 dark:text-gray-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                        </svg>
                        <h3 class="mb-2 text-gray-500 dark:text-gray-400">Orders</h3>
                        <span class="flex items-center text-2xl font-bold text-gray-900 ">{{ $ordersCount }}
                            {{-- <span
                            class="ms-2 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                            <svg class="-ms-1 me-1 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4"></path>
                            </svg>
                            10.3%
                        </span> --}}
                        </span>
                    </a>


                </div>



            </div>
            <div class="py-4 md:py-8">
                <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
                    <div class="space-y-4">
                        <div class="flex space-x-4">
                            <div x-data="{ showModal: false }">
                                <div class="flex items-center space-x-4">
                                    <img class="h-16 w-16 rounded-lg"
                                        src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://media.istockphoto.com/id/2151669184/vector/vector-flat-illustration-in-grayscale-avatar-user-profile-person-icon-gender-neutral.jpg?s=612x612&w=0&k=20&c=UEa7oHoOL30ynvmJzSCIPrwwopJdfqzBs0q69ezQoM8=' }}"
                                        alt="User avatar">



                                    <button @click="showModal = true"
                                        class="px-2 py-1 text-xs text-white bg-blue-500 rounded-md absolute mt-14"><i
                                            class="fa fa-pen"></i></button>
                                </div>

                                <!-- Modal -->
                                <div x-show="showModal"
                                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                        <h2 class="text-lg font-semibold mb-4">Edit Profile Picture</h2>

                                        <input type="file" id="profilePictureInput" accept="image/*"
                                            class="w-full p-2 border rounded-lg mb-2">

                                        <div class="flex justify-end space-x-2">
                                            <button @click="showModal = false"
                                                class="px-4 py-2 bg-gray-300 rounded-lg">Cancel</button>
                                            <button onclick="updateProfilePicture()"
                                                class="px-4 py-2 bg-blue-600 text-white rounded-lg">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>

                                <h2
                                    class="flex items-center text-xl font-bold leading-none text-gray-900  sm:text-2xl">
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h2>
                            </div>
                        </div>
                        <dl class="">
                            <dt class="font-semibold text-gray-900 ">Email Address</dt>
                            <dd class="text-gray-500 ">{{ Auth::user()->email }}</dd>
                        </dl>
                        <div x-data="{
                            showModal: false,
                            address: {
                                street: '{{ Auth::user()->address->street ?? '' }}',
                                house_number: '{{ Auth::user()->address->house_number ?? '' }}',
                                barangay: '{{ Auth::user()->address->barangay ?? '' }}',
                                city: '{{ Auth::user()->address->city ?? '' }}',
                                province: '{{ Auth::user()->address->province ?? '' }}',
                                postal_code: '{{ Auth::user()->address->postal_code ?? '' }}',
                                country: '{{ Auth::user()->address->country ?? '' }}'
                            },
                            newAddress: {}
                        }">
                            <dl>
                                <dt class="font-semibold text-gray-900 flex items-center">
                                    Home Address
                                    <span @click="showModal = true" class="text-xs text-blue-500 ml-2 cursor-pointer">
                                        <i class="fa fa-pen"></i> Edit
                                    </span>
                                </dt>
                                <dd class="text-gray-500"
                                    x-text="`${address.street || ''}, ${address.house_number || ''}, ${address.barangay || ''}, ${address.city || ''}, ${address.province || ''}, ${address.postal_code || ''}, ${address.country || ''}` || 'Not Set'">
                                </dd>
                            </dl>

                            <!-- Modal -->
                            <div x-show="showModal" x-cloak
                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                <div class="bg-white p-6 rounded-lg shadow-lg w-96 mt-24">
                                    <h2 class="text-lg font-semibold mb-4">Edit Home Address</h2>

                                    <input type="text" x-model="newAddress.street" placeholder="Street"
                                        class="w-full p-2 border rounded-lg mb-2">
                                    <input type="text" x-model="newAddress.house_number"
                                        placeholder="House Number" class="w-full p-2 border rounded-lg mb-2">
                                    <input type="text" x-model="newAddress.barangay" placeholder="Barangay"
                                        class="w-full p-2 border rounded-lg mb-2">
                                    <input type="text" x-model="newAddress.city" placeholder="City"
                                        class="w-full p-2 border rounded-lg mb-2">
                                    <input type="text" x-model="newAddress.province" placeholder="Province"
                                        class="w-full p-2 border rounded-lg mb-2">
                                    <input type="text" x-model="newAddress.postal_code" placeholder="Postal Code"
                                        class="w-full p-2 border rounded-lg mb-2">
                                    <input type="text" x-model="newAddress.country" placeholder="Country"
                                        class="w-full p-2 border rounded-lg mb-2">

                                    <div class="flex justify-end space-x-2">
                                        <button @click="showModal = false"
                                            class="px-4 py-2 bg-gray-300 rounded-lg">Cancel</button>
                                        <button @click="updateAddress()"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="space-y-4">
                        <div x-data="{ showModal: false, phone: '{{ Auth::user()->phone ?? '' }}', newPhone: '' }">
                            <dl>
                                <dt class="font-semibold text-gray-900 flex items-center">
                                    Phone Number
                                    <span @click="showModal = true" class="text-xs text-blue-500 ml-2 cursor-pointer">
                                        <i class="fa fa-pen"></i> Edit
                                    </span>
                                </dt>
                                <dd class="text-gray-500" x-text="phone || 'Not Set'"></dd>
                            </dl>

                            <!-- Modal -->
                            <div x-show="showModal" x-cloak
                                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                    <h2 class="text-lg font-semibold mb-4">Edit Phone Number</h2>

                                    <input type="text" x-model="newPhone" placeholder="Enter phone number"
                                        class="w-full p-2 border rounded-lg mb-4" maxlength="11"
                                        @input="newPhone = newPhone.replace(/\D/g, '').slice(0, 11)" required>



                                    <div class="flex justify-end space-x-2">
                                        <button @click="showModal = false"
                                            class="px-4 py-2 bg-gray-300 rounded-lg">Cancel</button>
                                        <button @click="updatePhone()"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>

            </div>

        </div>

    </section>



    <script>
        function updateProfilePicture() {
            let formData = new FormData();
            let fileInput = document.getElementById("profilePictureInput");

            if (fileInput.files.length === 0) {
                Swal.fire({
                    title: "Error!",
                    text: "Please select an image file.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
                return;
            }

            formData.append("profile_picture", fileInput.files[0]);

            $.ajax({
                url: "{{ route('update.profile.picture') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log("Response received:", response); // Debugging

                    if (response.success) {
                        // document.getElementById("profilePicture").src = response
                        // .profile_picture; // ✅ Update Image

                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "OK",

                        }).then(() => {
                            showModal = false;
                            window.location.reload(); // ✅ Reloads the page
                        });

                        document.querySelector("[x-data]").__x.$data.showModal = false;
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: response.message || "Failed to update profile picture.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                    Swal.fire({
                        title: "Error!",
                        text: "Something went wrong!",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });
        }



        function updateAddress() {
            let addressData = {
                street: document.querySelector("[x-model='newAddress.street']").value,
                house_number: document.querySelector("[x-model='newAddress.house_number']").value,
                barangay: document.querySelector("[x-model='newAddress.barangay']").value,
                city: document.querySelector("[x-model='newAddress.city']").value,
                province: document.querySelector("[x-model='newAddress.province']").value,
                postal_code: document.querySelector("[x-model='newAddress.postal_code']").value,
                country: document.querySelector("[x-model='newAddress.country']").value
            };

            $.ajax({
                url: "{{ route('update.address') }}", // Laravel route
                type: "POST",
                data: addressData,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}" // CSRF token for security
                },
                success: function(data) { // ❌ Removed 'success1' → ✅ Changed to 'success'
                    if (data.success) { // ✅ Check correct response key
                        // Update the Alpine.js store or x-data
                        let alpineData = document.querySelector("[x-data]")?.__x?.$data;
                        if (alpineData) {
                            alpineData.address = data.address; // Update UI
                            alpineData.showModal = false; // Close modal
                        }

                        // ✅ Show success SweetAlert
                        Swal.fire({
                            title: "Success!",
                            text: "Home address updated successfully.",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            showModal = false;
                            window.location.reload(); // ✅ Reloads the page
                        });
                    } else {
                        // ❌ Show error SweetAlert
                        Swal.fire({
                            title: "Error!",
                            text: "Failed to update home address.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error updating address:", xhr.responseText);

                    // ❌ Show error SweetAlert (detailed)
                    Swal.fire({
                        title: "Error!",
                        text: xhr.responseJSON?.message || "Something went wrong!",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });
        }




        function updatePhone() {
            let newPhone = $("[x-model='newPhone']").val(); // Get phone number

            $.ajax({
                url: "{{ route('update.phone') }}",
                type: "POST",
                data: {
                    phone: newPhone,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        let alpineComponent = document.querySelector("[x-data]");
                        if (alpineComponent && alpineComponent.__x) {
                            alpineComponent.__x.$data.phone = response.phone; // Update phone number
                            alpineComponent.__x.$data.showModal = false; // Close modal
                        }

                        // Ensure modal is fully closed
                        setTimeout(() => {
                            document.querySelector("[x-show='showModal']").style.display = "none";
                        }, 100);

                        // Show success alert
                        Swal.fire({
                            title: "Success!",
                            text: "Your phone number has been updated.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        }).then(() => {
                            showModal = false;
                            window.location.reload(); // ✅ Reloads the page
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: response.message || "Something went wrong.",
                            icon: "error",
                            confirmButtonColor: "#d33",
                            confirmButtonText: "OK"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to update phone number. Please try again.",
                        icon: "error",
                        confirmButtonColor: "#d33",
                        confirmButtonText: "OK"
                    });
                }
            });
        }
    </script>

</body>

</html>
