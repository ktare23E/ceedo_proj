<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';

const mobileOpen = ref(false)
</script>

<template>
    <div class="font-sans bg-gray-50 text-gray-800">
        <!-- Navigation -->
        <nav class="bg-white/90 backdrop-blur-sm fixed w-full z-50 border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between items-center h-20">
                    <!-- Logo -->
                    <a href="#" class="font-display text-2xl font-bold text-indigo-700">CEEDO</a>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex space-x-8 items-center">
                        <a href="#"
                            class="text-sm font-medium text-gray-700 hover:text-indigo-700 transition-colors">Home</a>
                        <a href="#"
                            class="text-sm font-medium text-gray-700 hover:text-indigo-700 transition-colors">Venues</a>
                        <a href="#"
                            class="text-sm font-medium text-gray-700 hover:text-indigo-700 transition-colors">Pricing</a>
                        <a href="#"
                            class="text-sm font-medium text-gray-700 hover:text-indigo-700 transition-colors">About</a>

                        <!-- Divider -->
                        <div class="h-5 w-px bg-gray-300"></div>

                        <!-- Register / Login Buttons -->
                        <Link :href="route('login')"
                            class="text-sm font-medium text-gray-700 hover:text-indigo-700 transition-colors">Login</Link>
                        <a href="#"
                            class="px-4 py-2 bg-indigo-700 text-white rounded-full text-sm font-medium hover:bg-indigo-800 transition-colors">
                            Register
                        </a>

                        <!-- Highlight Button -->
                        <a href="#"
                            class="px-4 py-2 bg-amber-500 text-white rounded-full text-sm font-medium hover:bg-amber-600 transition-colors">
                            List Your Space
                        </a>
                    </div>

                    <!-- Mobile Menu Toggle -->
                    <button @click="mobileOpen = !mobileOpen"
                        class="md:hidden p-2 text-gray-700 hover:text-indigo-700 transition-colors">
                        <svg v-if="!mobileOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 
                        0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 
                        0 0 1 .5-.5h10a.5.5 
                        0 0 1 0 1H3a.5.5 
                        0 0 1-.5-.5zm0-4a.5.5 
                        0 0 1 .5-.5h10a.5.5 
                        0 0 1 0 1H3a.5.5 
                        0 0 1-.5-.5z" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 
                        .708 0L8 7.293l2.646-2.647a.5.5 
                        0 0 1 .708.708L8.707 8l2.647 
                        2.646a.5.5 0 0 1-.708.708L8 
                        8.707l-2.646 2.647a.5.5 
                        0 0 1-.708-.708L7.293 
                        8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <transition name="fade">
                <div v-if="mobileOpen"
                    class="md:hidden absolute top-20 left-0 w-full bg-white border-t border-gray-200 shadow-md">
                    <div class="flex flex-col items-center space-y-4 py-6 text-gray-800">
                        <a href="#" class="hover:text-indigo-700 transition-colors">Home</a>
                        <a href="#" class="hover:text-indigo-700 transition-colors">Venues</a>
                        <a href="#" class="hover:text-indigo-700 transition-colors">Pricing</a>
                        <a href="#" class="hover:text-indigo-700 transition-colors">About</a>

                        <!-- Login / Register -->
                        <a href="#" class="hover:text-indigo-700 transition-colors">Login</a>
                        <a href="#"
                            class="px-4 py-2 bg-indigo-700 text-white rounded-full text-sm font-medium hover:bg-indigo-800 transition-colors">
                            Register
                        </a>

                        <!-- Highlight Button -->
                        <a href="#"
                            class="px-4 py-2 bg-amber-500 text-white rounded-full text-sm font-medium hover:bg-amber-600 transition-colors">
                            List Your Space
                        </a>
                    </div>
                </div>
            </transition>
        </nav>


        <!-- Hero Section -->
        <section class="hero-bg min-h-screen pt-20 flex items-center">
            <div class="max-w-7xl mx-auto px-6 py-12 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Hero Text -->
                    <div
                        class="space-y-8 text-center lg:text-left bg-white/80 p-8 rounded-xl backdrop-blur-sm shadow-lg">
                        <div class="space-y-6">
                            <h1
                                class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-indigo-800 leading-tight">
                                <span class="block">Find Your Ideal</span>
                                <span class="block text-amber-600">Business Space</span>
                            </h1>
                            <p class="text-lg text-gray-700 max-w-lg mx-auto lg:mx-0">
                                Whether you're launching a startup or expanding your business, BizSpace helps you find
                                the perfect spot — fast, flexible, and hassle-free.
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="#"
                                class="px-8 py-3 bg-indigo-700 text-white font-medium rounded-full hover:bg-indigo-800 transition-colors shadow-md">
                                Explore Venues
                            </a>
                            <a href="#"
                                class="px-8 py-3 border border-gray-800 text-gray-800 font-medium rounded-full hover:bg-white transition-colors">
                                Learn More
                            </a>
                        </div>
                    </div>

                    <!-- Featured Venue -->
                    <div class="relative animate-float">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-xl border border-gray-100">
                            <img src="/imgs/mal2.jpg" alt="Featured Venue" class="w-full h-80 object-cover" />
                            <div class="p-6">
                                <h3 class="font-display text-xl text-indigo-800">Downtown Office Hub</h3>
                                <p class="text-gray-600 mt-1">Perfect for startups & freelancers</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="font-medium text-amber-600 text-lg">₱5,000/day</span>
                                    <button
                                        class="px-4 py-2 bg-indigo-700 text-white rounded-full text-sm font-medium hover:bg-indigo-800 transition-colors">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div
                            class="absolute -bottom-4 -right-4 bg-amber-600 text-white px-4 py-2 rounded-full text-sm font-medium shadow">
                            Featured Space
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits Section -->
        <div class="bg-white py-20">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="font-display text-3xl text-center text-indigo-800 mb-12 font-semibold">
                    Why Choose BizSpace
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Flexibility -->
                    <div class="bg-gray-50 p-8 rounded-xl shadow-md text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#4338CA"
                                viewBox="0 0 16 16">
                                <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zM7 4h2v4H7V4zm0 6h2v2H7v-2z" />
                            </svg>
                        </div>
                        <h3 class="font-display text-xl text-indigo-800 mb-2">Flexible Booking</h3>
                        <p class="text-gray-600">Rent spaces daily, weekly, or monthly — tailored to your business
                            timeline.</p>
                    </div>

                    <!-- Affordable Rates -->
                    <div class="bg-gray-50 p-8 rounded-xl shadow-md text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#4338CA"
                                viewBox="0 0 16 16">
                                <path d="M8 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1zM4 8h8v1H4V8z" />
                            </svg>
                        </div>
                        <h3 class="font-display text-xl text-indigo-800 mb-2">Affordable Rates</h3>
                        <p class="text-gray-600">Transparent pricing with no hidden fees — ideal for startups and SMEs.
                        </p>
                    </div>

                    <!-- Visibility -->
                    <div class="bg-gray-50 p-8 rounded-xl shadow-md text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#4338CA"
                                viewBox="0 0 16 16">
                                <path d="M8 3a5 5 0 0 1 5 5c0 3-5 8-5 8S3 11 3 8a5 5 0 0 1 5-5z" />
                            </svg>
                        </div>
                        <h3 class="font-display text-xl text-indigo-800 mb-2">Boost Your Visibility</h3>
                        <p class="text-gray-600">List your property and attract verified renters looking for the ideal
                            spot.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.hero-bg {
    background-image:
        linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.3)),
        url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1600&q=80');
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-10px);
    }
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
