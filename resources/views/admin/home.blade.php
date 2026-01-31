@extends("admin.layouts.master")
@section("dashboard-active","active")
@section("main")

      <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Card 1: Total Sales -->
                    <div class="bg-white p-6 rounded-2xl shadow-xl transition transform hover:scale-[1.01] duration-300 border-t-4 border-purple-600">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-500 uppercase">Total Sales</p>
                            <i class="fas fa-dollar-sign text-2xl text-purple-400"></i>
                        </div>
                        <p class="text-4xl font-extrabold text-gray-900 mt-1">$45,231</p>
                        <p class="text-sm text-green-500 mt-2"><i class="fas fa-arrow-up"></i> 12.5% increase</p>
                    </div>
                    
                    <!-- Card 2: New Orders -->
                    <div class="bg-white p-6 rounded-2xl shadow-xl transition transform hover:scale-[1.01] duration-300 border-t-4 border-indigo-600">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-500 uppercase">New Orders</p>
                            <i class="fas fa-shopping-cart text-2xl text-indigo-400"></i>
                        </div>
                        <p class="text-4xl font-extrabold text-gray-900 mt-1">1,345</p>
                        <p class="text-sm text-red-500 mt-2"><i class="fas fa-arrow-down"></i> 3.1% decrease</p>
                    </div>

                    <!-- Card 3: Active Users -->
                    <div class="bg-white p-6 rounded-2xl shadow-xl transition transform hover:scale-[1.01] duration-300 border-t-4 border-blue-600">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-500 uppercase">Active Users</p>
                            <i class="fas fa-users text-2xl text-blue-400"></i>
                        </div>
                        <p class="text-4xl font-extrabold text-gray-900 mt-1">8,921</p>
                        <p class="text-sm text-green-500 mt-2"><i class="fas fa-arrow-up"></i> 5.8% increase</p>
                    </div>
                    
                    <!-- Card 4: Product Returns -->
                    <div class="bg-white p-6 rounded-2xl shadow-xl transition transform hover:scale-[1.01] duration-300 border-t-4 border-yellow-600">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-500 uppercase">Product Returns</p>
                            <i class="fas fa-undo text-2xl text-yellow-400"></i>
                        </div>
                        <p class="text-4xl font-extrabold text-gray-900 mt-1">214</p>
                        <p class="text-sm text-gray-500 mt-2">No change from last week</p>
                    </div>
                </section>
                
                <!-- Charts and Reports Section -->
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Large Chart Placeholder -->
                    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Revenue Trends (Last 6 Months)</h3>
                        <div class="h-64 flex items-center justify-center bg-gray-50 border border-dashed border-gray-200 rounded-xl text-gray-500">
                            [Chart Placeholder: Line Chart]
                        </div>
                    </div>
                    
                    <!-- Small Chart Placeholder -->
                    <div class="lg:col-span-1 bg-white p-6 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Top Selling Categories</h3>
                        <div class="h-64 flex items-center justify-center bg-gray-50 border border-dashed border-gray-200 rounded-xl text-gray-500">
                            [Chart Placeholder: Donut/Pie Chart]
                        </div>
                    </div>
                </section>
                
                <!-- Recent Orders Table -->
                <section class="bg-white p-6 rounded-2xl shadow-xl">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Orders</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-xl">Order ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-xl">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Row 1 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-600">#ORD1001</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Mark Jenkins</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">$149.99</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Completed
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-11-20</td>
                                </tr>
                                <!-- Row 2 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-600">#ORD1002</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Lisa K.</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">$35.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-11-20</td>
                                </tr>
                                <!-- Row 3 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-600">#ORD1003</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">David Chen</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">$499.00</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Shipped
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2025-11-19</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
                
@endsection

