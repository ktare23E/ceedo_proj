<template>
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col min-h-screen transition-all duration-300">
            <!-- Logo -->
            <div class="p-6 flex items-center gap-2">
                <img src="/imgs/tangubicon.png" class="w-10" alt="">
                <span class="font-bold text-purple-700 text-2xl">AdminPanel</span>
            </div>

            <!-- Navigation -->
            <nav class="mt-6 flex-1">
                <a href="#"
                    class="group flex items-center gap-3 py-3 px-6 text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-all duration-200 relative overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                    <span
                        class="absolute left-0 top-0 h-full w-1 bg-purple-600 scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></span>
                </a>

                <a href="#"
                    class="group flex items-center gap-3 py-3 px-6 text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-all duration-200 relative overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="font-medium">Users</span>
                    <span
                        class="absolute left-0 top-0 h-full w-1 bg-purple-600 scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></span>
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="p-6 border-t">
                <button
                    class="w-full flex items-center justify-center gap-3 py-2.5 bg-red-500 hover:bg-purple-700 text-white font-medium rounded-lg shadow transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.636 5.636a9 9 0 1 0 12.728 0M12 3v9" />
                    </svg>

                    Logout
                </button>
            </div>
        </aside>



        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navbar -->
            <header class="bg-white shadow-md p-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-purple-700">Dashboard</h1>
                <div class="flex items-center gap-4">
                    <input type="text" placeholder="Search..."
                        class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <div
                        class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold">
                        SR
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="p-6 space-y-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                        <p class="text-sm text-gray-500">Total Users</p>
                        <h2 class="text-3xl font-bold text-purple-700 mt-2">1,240</h2>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                        <p class="text-sm text-gray-500">Revenue</p>
                        <h2 class="text-3xl font-bold text-green-600 mt-2">$24,500</h2>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                        <p class="text-sm text-gray-500">New Orders</p>
                        <h2 class="text-3xl font-bold text-blue-600 mt-2">320</h2>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                        <p class="text-sm text-gray-500">Pending Tickets</p>
                        <h2 class="text-3xl font-bold text-red-500 mt-2">12</h2>
                    </div>
                </div>

                <!-- Table -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4 border-b font-bold text-purple-700">User List</div>
                    <table class="w-full text-left">
                        <thead class="bg-purple-50">
                            <tr>
                                <th class="p-4">Name</th>
                                <th class="p-4">Email</th>
                                <th class="p-4">Role</th>
                                <th class="p-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-4">John Doe</td>
                                <td class="p-4">john@example.com</td>
                                <td class="p-4">Admin</td>
                                <td class="p-4 text-green-600 font-bold">Active</td>
                            </tr>
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-4">Jane Smith</td>
                                <td class="p-4">jane@example.com</td>
                                <td class="p-4">Editor</td>
                                <td class="p-4 text-yellow-500 font-bold">Pending</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white p-6 rounded-lg shadow-md grid grid-cols-2 md:grid-cols-4 gap-4">
                    <button class="bg-purple-600 text-white py-3 rounded-lg shadow hover:bg-purple-700">Add
                        User</button>
                    <button class="bg-blue-600 text-white py-3 rounded-lg shadow hover:bg-blue-700">Export Data</button>
                    <button class="bg-green-600 text-white py-3 rounded-lg shadow hover:bg-green-700">Generate
                        Report</button>
                    <button class="bg-red-600 text-white py-3 rounded-lg shadow hover:bg-red-700">Delete
                        Records</button>
                </div>

                <!-- Profile Card -->
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center gap-6">
                    <img src="https://i.pravatar.cc/100" alt="Profile" class="w-20 h-20 rounded-full shadow">
                    <div>
                        <h3 class="text-xl font-bold text-purple-700">Sophia Ray</h3>
                        <p class="text-gray-500">Administrator</p>
                        <button class="mt-2 bg-purple-600 text-white px-4 py-2 rounded-lg shadow hover:bg-purple-700">
                            Edit Profile
                        </button>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="bg-white p-4 mt-10 text-center text-sm text-gray-400 border-t">
                    © 2025 AdminPanel. All rights reserved.
                </footer>
            </main>
        </div>
    </div>
</template>

<script setup>
// (Optional) Add Vue logic here later if needed
</script>

<style scoped>
/* You can add custom styles here if needed */
</style>
