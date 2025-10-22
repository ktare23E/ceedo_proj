<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

const props = defineProps({
    establishment: Object,
    images: Array,
    stalls: Array
})

const goBack = () => {
    router.visit(route('establishments'))
}
</script>

<template>
    <AdminLayout :title="`${props.establishment.name} Details`" :header="`${props.establishment.name} Details`">
        <div class="max-w-7xl mx-auto p-6 space-y-10">

            <!-- BACK BUTTON -->
            <div class="flex items-center mb-4">
                <button @click="goBack"
                    class="flex items-center gap-2 text-gray-700 hover:text-indigo-600 transition font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back
                </button>
            </div>

            <!-- IMAGE CAROUSEL -->
            <div class="relative w-full overflow-x-auto flex gap-4 snap-x snap-mandatory scrollbar-hide">
                <div v-for="(img, index) in props.images" :key="index" class="snap-center shrink-0">
                    <img :src="`/storage/${img.file_path}`" alt="Establishment Image"
                        class="w-[400px] h-[250px] object-cover rounded-2xl shadow-md border border-gray-200" />
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
                    <Link :href="route('create_stall', props.establishment.id)"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
                    + Create Stall
                    </Link>
                </div>

                <!-- NO STALLS -->
                <div v-if="props.stalls.length === 0"
                    class="text-center py-10 text-gray-500 italic border rounded-lg bg-gray-50">
                    No stalls yet.
                </div>

                <!-- STALL CARDS -->
                <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <div v-for="stall in props.stalls" :key="stall.id"
                        class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition p-5 flex flex-col">
                        <!-- Stall Image -->
                        <div class="h-36 bg-gray-100 rounded-lg mb-4 overflow-hidden flex items-center justify-center">
                            <img v-if="stall.first_image" :src="`/storage/${stall.first_image.file_path}`"
                                alt="Stall Image" class="w-full h-full object-cover" />
                            <span v-else class="text-gray-400 text-sm">No Image</span>
                        </div>

                        <!-- Stall Info -->
                        <div class="flex-1 space-y-2 text-sm">
                            <div>
                                <span class="block text-gray-400 text-xs uppercase tracking-wider">Stall Number</span>
                                <span class="font-semibold text-gray-800">{{ stall.stall_number }}</span>
                            </div>

                            <div>
                                <span class="block text-gray-400 text-xs uppercase tracking-wider">Price (per
                                    day)</span>
                                <span class="font-semibold text-green-600">₱{{ parseFloat(stall.price).toFixed(2)
                                    }}</span>
                            </div>

                            <div>
                                <span class="block text-gray-400 text-xs uppercase tracking-wider">Status</span>
                                <span class="px-2 py-1 rounded-full text-white text-xs font-medium"
                                    :class="stall.status === 'free' ? 'bg-green-500' : 'bg-red-500'">
                                    {{ stall.status }}
                                </span>
                            </div>

                            <div>
                                <span class="block text-gray-400 text-xs uppercase tracking-wider">Size</span>
                                <span class="font-medium text-gray-700">{{ stall.size }}</span>
                            </div>

                            <div>
                                <span class="block text-gray-400 text-xs uppercase tracking-wider">Description</span>
                                <p class="text-gray-600 text-xs line-clamp-3">
                                    {{ stall.description || 'No description provided.' }}
                                </p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2 mt-4">
                            <button
                                class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-lg text-sm font-medium transition">
                                View
                            </button>
                            <Link :href="route('edit_stall', stall.id)"
                                class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-lg text-sm font-medium text-center transition">
                            Edit
                            </Link>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AdminLayout>
</template>

<style>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}

.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
