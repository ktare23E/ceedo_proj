<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
    establishment: Object,
    images: Array
})

const goBack = () => {
    router.visit(route('establishments'));
}
</script>

<template>
    <AdminLayout :title="`View ${props.establishment.name}`" :header="`View ${props.establishment.name}`">
        <div class="max-w-7xl mx-auto p-6 space-y-10">

            <!-- BACK BUTTON -->
            <div class="flex items-center mb-4">
                <button
                    @click="goBack"
                    class="flex items-center gap-2 text-gray-700 hover:text-indigo-600 transition font-medium"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </button>
            </div>

            <!-- IMAGE CAROUSEL -->
            <div class="relative w-full overflow-x-auto flex gap-4 snap-x snap-mandatory scrollbar-hide">
                <div v-for="(img, index) in props.images" :key="index" class="snap-center shrink-0">
                    <img
                        :src="`/storage/${img.file_path}`"
                        alt="Establishment Image"
                        class="w-[400px] h-[250px] object-cover rounded-2xl shadow-md border border-gray-200"
                    />
                </div>
            </div>

            <!-- ESTABLISHMENT INFO -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-2xl font-semibold text-gray-800 mb-3">{{ props.establishment.name }}</h2>
                <p class="text-gray-600 mb-2">{{ props.establishment.description }}</p>
                <p class="text-gray-500">
                    <span class="font-medium text-gray-700">Address:</span> {{ props.establishment.address }}
                </p>
                <div class="flex items-center justify-between mt-5">
                    <p class="text-sm text-gray-400">
                        Created: {{ new Date(props.establishment.created_at).toLocaleDateString() }}
                    </p>
                </div>
            </div>

            <!-- STALL SECTION -->
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Stalls</h3>
                    <Link
                        href="#"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-200"
                    >
                        + Create Stall
                    </Link>
                </div>

                <!-- Example stall cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <!-- Example stall card -->
                    <div
                        v-for="i in 6"
                        :key="i"
                        class="bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition p-4"
                    >
                        <div class="h-32 bg-gray-100 rounded-lg mb-3 flex items-center justify-center">
                            <span class="text-gray-400 text-sm">Stall Image</span>
                        </div>
                        <h4 class="text-gray-800 font-semibold">Stall #{{ i }}</h4>
                        <p class="text-gray-500 text-sm mb-3">₱{{ (i * 200).toFixed(2) }}/day</p>
                        <button class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-lg text-sm font-medium transition">
                            View Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style>
/* Hide scrollbar for the image carousel */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
