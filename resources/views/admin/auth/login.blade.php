    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <div class="w-full max-w-sm mx-auto p-4">

        <!-- Admin Login Card -->
        <div class="bg-white p-8 md:p-10 rounded-2xl shadow-2xl border border-gray-100">
            <div class="text-center mb-8">
                <!-- Branding/Icon -->
                <div class="flex justify-center items-center mb-4">
                    <span class="text-4xl font-black text-purple-600">MLC</span>
                    <i class="fas fa-lock ml-2 text-2xl text-gray-500"></i>
                </div>
                
                <h2 class="text-3xl font-extrabold text-gray-900">Admin Panel Login</h2>
                <p class="text-gray-500 mt-1">Access the system dashboard</p>
            </div>

            <!-- Form -->
            <form action="#" method="POST" class="space-y-6">
             @csrf
                <!-- Email Field with Icon -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" required autocomplete="email"
                            placeholder="admin@mlc.com"
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-300 focus:ring-purple-600 focus:border-purple-600 transition duration-150 border-2">
                        <i class="fas fa-user-shield absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Password Field with Visibility Toggle -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            placeholder="Enter password"
                            class="w-full pl-10 pr-10 py-2.5 rounded-xl border-gray-300 focus:ring-purple-600 focus:border-purple-600 transition duration-150 border-2">
                        <i class="fas fa-key absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-purple-600 focus:outline-none">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Forgot Password Link -->
                <div class="text-right text-sm">
                    <a href="#" class="font-medium text-purple-600 hover:text-purple-500 hover:underline">
                        Forgot Password?
                    </a>
                </div>


                <!-- Login Button (Purple Accent) -->
                <button type="submit"
                        class="w-full flex justify-center items-center bg-purple-600 text-white py-3 rounded-xl font-semibold text-lg
                               hover:bg-purple-700 transition duration-300 ease-in-out shadow-lg shadow-purple-300 focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-50">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Secure Log In
                </button>
                
            </form>
        </div>
    </div>