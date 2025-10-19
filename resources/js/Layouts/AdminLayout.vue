<script setup>
import { Head } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';

const props = defineProps({
    title : String,
    header : String
})
</script>

<template>
    <Head :title="title"></Head>
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
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                    </svg>
                    <span class="font-medium">Dashboard</span>
                    <span
                        class="absolute left-0 top-0 h-full w-1 bg-purple-600 scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></span>
                </NavLink>

                <NavLink :href="route('users')" :active="route().current('users')"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="font-medium">Staff</span>
                    <span
                        class="absolute left-0 top-0 h-full w-1 bg-purple-600 scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></span>
                </NavLink>
                <NavLink :href="route('treasury')" :active="route().current('treasury')"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="font-medium">Treasury</span>
                    <span
                        class="absolute left-0 top-0 h-full w-1 bg-purple-600 scale-y-0 group-hover:scale-y-100 transition-transform origin-top"></span>
                </NavLink>
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
                <h1 class="text-xl font-bold text-purple-700">{{ props.header }}</h1>
            </header>
            <slot/>
        </div>
    </div>
</template>

