
<script src="https://cdn.tailwindcss.com"></script>
 <div class="w-full max-w-sm mx-auto p-4">


        <div class="bg-white p-8 md:p-10 rounded-2xl shadow-2xl border border-purple-50">
            <div class="text-center mb-8">
                <i class="fas fa-lock text-4xl text-purple-600 mb-2"></i>
                <h2 class="text-3xl font-extrabold text-gray-900">Sign In</h2>
                <p class="text-gray-500 mt-1">Access your MLC account</p>
            </div>

            <!-- Form -->
            <form action="#" method="POST" class="space-y-6" id="loginForm">
           @csrf
                <!-- Email Field with Icon -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" required autocomplete="email"
                            placeholder="you@example.com"
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-300 focus:ring-purple-600 focus:border-purple-600 transition duration-150 border-2">
                        
                    </div>
                </div>

                <!-- Password Field with Visibility Toggle -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full pl-10 pr-10 py-2.5 rounded-xl border-gray-300 focus:ring-purple-600 focus:border-purple-600 transition duration-150 border-2">
                       
                        <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-purple-600 focus:outline-none">
                            
                        </button>
                    </div>
                </div>
                
                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between pt-1">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900 select-none">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <!-- Replace with your actual route -->
                        <a href="{{ route('password.request') }}" class="font-medium text-purple-600 hover:text-purple-500 hover:underline">
                            Forgot your password?
                        </a>
                    </div>
                </div>


                <!-- Login Button (Enhanced) -->
                <button type="submit"
                        class="w-full flex justify-center items-center bg-purple-600 text-white py-3 rounded-xl font-semibold text-lg
                               hover:bg-purple-700 transition duration-300 ease-in-out shadow-md shadow-purple-200 focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-50">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Login
                </button>
                
                <!-- Alternative Login/Register Link -->
                <div class="text-center pt-2">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <!-- Replace with your actual route -->
                        <a href="{{ route('register') }}" class="text-purple-600 font-bold hover:underline ml-1">
                            Register Here
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
