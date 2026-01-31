 
 <script src="https://cdn.tailwindcss.com"></script>
 <div class="w-full max-w-lg mx-auto p-4">

        <!-- Enhanced Registration Card -->
        <div class="bg-white p-8 md:p-10 rounded-2xl shadow-2xl border border-purple-50">
            <div class="text-center mb-8">
                <i class="fas fa-user-plus text-4xl text-purple-600 mb-2"></i>
                <h2 class="text-3xl font-extrabold text-gray-900">Create Your Account</h2>
                <p class="text-gray-500 mt-1">Join the community and start shopping</p>
            </div>

            <!-- Form -->
            <form action="{{ route("register.store") }}" method="POST" class="space-y-6" id="registerForm">
            @csrf
                <!-- Name Fields (Responsive Grid) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <div class="relative">
                            <input type="text" id="first_name" name="firstname" required placeholder="enter first name"
                                autocomplete="given-name"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-300 focus:ring-purple-600 focus:border-purple-600 transition duration-150 border-2">
                            <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <div class="relative">
                            <input type="text" id="last_name" name="lastname" required placeholder="enter last name"
                                autocomplete="family-name"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-300 focus:ring-purple-600 focus:border-purple-600 transition duration-150 border-2">
                            <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" required placeholder="you@example.com"
                            autocomplete="email"
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-300 focus:ring-purple-600 focus:border-purple-600 transition duration-150 border-2">
                        <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Password Fields (Side-by-Side) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required 
                                placeholder="Min 8 characters"
                                class="password-field w-full pl-10 pr-10 py-2.5 rounded-xl border-gray-300 focus:ring-purple-600 focus:border-purple-600 transition duration-150 border-2">
                            <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button type="button" class="toggle-password absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-purple-600 focus:outline-none" data-target="password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" required 
                                placeholder="Repeat password"
                                class="password-field w-full pl-10 pr-10 py-2.5 rounded-xl border-gray-300 focus:ring-purple-600 focus:border-purple-600 transition duration-150 border-2">
                            <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button type="button" class="toggle-password absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-purple-600 focus:outline-none" data-target="password_confirmation">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

               


                <!-- Register Button (Enhanced) -->
                <button type="submit"
                        class="w-full flex justify-center items-center bg-purple-600 text-white py-3 rounded-xl font-semibold text-lg
                               hover:bg-purple-700 transition duration-300 ease-in-out shadow-md shadow-purple-200 focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-50">
                    <i class="fas fa-id-card-alt mr-2"></i>
                    Register
                </button>
                
                <!-- Login Link -->
                <div class="text-center pt-2">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <!-- Replace with your actual route -->
                        <a href="{{ route('login') }}" class="text-purple-600 font-bold hover:underline ml-1">
                            Login
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
