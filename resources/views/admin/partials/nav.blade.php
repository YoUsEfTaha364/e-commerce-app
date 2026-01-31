    <nav class="flex-grow p-4 space-y-2">
                    <a href="{{ route("admin.dashboard") }}" class="sidebar-link @yield("dashboard-active") flex items-center p-3 rounded-r-lg transition duration-150">
                        <i class="fas fa-tachometer-alt mr-3 w-5"></i>
                        Dashboard
                    </a>
                    <a href="{{ route("admin.products.index") }}" class="sidebar-link @yield("products-active") flex items-center p-3 rounded-r-lg hover:bg-gray-700 transition duration-150">
                        <i class="fas fa-boxes mr-3 w-5"></i>
                        Products
                    </a>
                    <a href="{{ route("admin.orders.index") }}" class="sidebar-link @yield("orders-active") flex items-center p-3 rounded-r-lg hover:bg-gray-700 transition duration-150">
                        <i class="fas fa-shipping-fast mr-3 w-5"></i>
                        Orders
                    </a>
                    <a href="{{ route("admin.customers.index") }}" class="sidebar-link @yield("customers-active") flex items-center p-3 rounded-r-lg hover:bg-gray-700 transition duration-150">
                        <i class="fas fa-users mr-3 w-5"></i>
                        Customers
                    </a>
                    <a href="{{ route("admin.admins.index") }}" class="sidebar-link @yield("admin-active") flex items-center p-3 rounded-r-lg hover:bg-gray-700 transition duration-150">
                        <i class="fas fa-chart-line mr-3 w-5"></i>
                        Admins
                    </a>
                    <a href="{{ route("admin.roles.index") }}" class="sidebar-link @yield("roles-active") flex items-center p-3 rounded-r-lg hover:bg-gray-700 transition duration-150">
                        <i class="fas fa-chart-line mr-3 w-5"></i>
                        Roles
                    </a>
                    <a href="#" class="sidebar-link flex items-center p-3 rounded-r-lg hover:bg-gray-700 transition duration-150">
                        <i class="fas fa-cogs mr-3 w-5"></i>
                        Settings
                    </a>
                </nav>