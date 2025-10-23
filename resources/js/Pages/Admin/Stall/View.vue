<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { ref } from 'vue'

const props = defineProps({
    stall: Object,
    images: Array,
    activeVendor: Object, // Current vendor rented (if any)
    rentHistory: Array    // Past rent records
})

// Inertia form for re-upload
const form = useForm({
    file: null,
})

// Modal / menu state
const carousel = ref(null)
const previewImage = ref(null)
const showReuploadModal = ref(false)
const selectedImage = ref(null)
const showMenu = ref(null)

// Carousel scrolling
const scrollCarousel = (direction) => {
    const el = carousel.value
    if (!el) return
    const scrollAmount = 420
    if (direction === 'left') el.scrollBy({ left: -scrollAmount, behavior: 'smooth' })
    else el.scrollBy({ left: scrollAmount, behavior: 'smooth' })
}

const openPreview = (img) => {
    previewImage.value = img
}

const closePreview = () => {
    previewImage.value = null
}

const toggleMenu = (index) => {
    showMenu.value = showMenu.value === index ? null : index
}

const openReuploadModal = (img) => {
    selectedImage.value = img
    showReuploadModal.value = true
    showMenu.value = null
    form.reset()
}

const closeReuploadModal = () => {
    showReuploadModal.value = false
    selectedImage.value = null
    form.reset()
}

// Submit new image
const submitReupload = () => {
    if (!form.file || !selectedImage.value) return

    // adjust route name if your route is different
    form.post(route('stalls.image.update', selectedImage.value.id), {
        forceFormData: true,
        onSuccess: () => {
            closeReuploadModal()
        },
        onError: () => {
            // keep modal open so user can see validation errors returned from the server
        }
    })
}

const handleFileChange = (e) => {
    form.file = e.target.files[0] ?? null
}

const goBack = () => {
    router.visit(route('view_establishment', props.stall.establishment_id))
}
</script>

<template>
    <AdminLayout :title="`${props.stall.stall_number} Details`" :header="`${props.stall.stall_number} Details`">
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
            <div class="relative w-full">
                <!-- Left Arrow -->
                <button @click="scrollCarousel('left')"
                    class="absolute left-2 top-1/2 -translate-y-1/2 z-20 bg-white/80 hover:bg-white text-gray-700 rounded-full p-2 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <div ref="carousel" class="w-full overflow-hidden flex gap-4 scroll-smooth">
                    <div v-for="(img, index) in props.images" :key="img.id || index"
                        class="relative min-w-[400px] h-[250px] shrink-0 group">
                        <img :src="`/storage/${img.file_path}`" alt="Stall Image"
                            class="w-full h-full object-cover rounded-2xl shadow-md border border-gray-200 cursor-pointer"
                            @click="openPreview(img)" />

                        <!-- 3-dot menu -->
                        <div class="absolute top-3 right-3">
                            <button @click.stop="toggleMenu(index)"
                                class="bg-black/50 text-white rounded-full p-1 hover:bg-black/70 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <circle cx="5" cy="12" r="2" />
                                    <circle cx="12" cy="12" r="2" />
                                    <circle cx="19" cy="12" r="2" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div v-if="showMenu === index"
                                class="absolute right-0 mt-2 bg-white border border-gray-200 shadow-lg rounded-lg w-36 z-10">
                                <button @click="openReuploadModal(img)"
                                    class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 text-gray-700">
                                    Edit Image
                                </button>
                                <!-- you can add Delete or Download here -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Arrow -->
                <button @click="scrollCarousel('right')"
                    class="absolute right-2 top-1/2 -translate-y-1/2 z-20 bg-white/80 hover:bg-white text-gray-700 rounded-full p-2 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- IMAGE PREVIEW MODAL -->
            <div v-if="previewImage" @click="closePreview"
                class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 cursor-pointer">
                <img :src="`/storage/${previewImage.file_path}`" alt="Preview"
                    class="max-w-4xl max-h-[90vh] rounded-xl shadow-2xl object-contain" />
            </div>

            <!-- REUPLOAD MODAL -->
            <div v-if="showReuploadModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50"
                @click="closeReuploadModal">
                <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative" @click.stop>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Re-upload Image</h3>

                    <div class="border-dashed border-2 border-gray-300 rounded-lg p-4 text-center mb-4">
                        <p class="text-gray-500 text-sm mb-2">Current Image:</p>

                        <div v-if="selectedImage && selectedImage.file_path" class="mb-3">
                            <img :src="`/storage/${selectedImage.file_path}`" alt="Current"
                                class="w-full h-48 object-cover rounded-lg" />
                        </div>

                        <div v-else class="mb-3 text-gray-400">
                            <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center">
                                No image available
                            </div>
                        </div>

                        <input type="file" @change="handleFileChange" class="block w-full text-sm text-gray-600" />
                        <p v-if="form.errors?.file" class="text-red-500 text-xs mt-2">{{ form.errors.file }}</p>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button @click="closeReuploadModal"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm font-medium transition">
                            Cancel
                        </button>
                        <button @click="submitReupload"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition"
                            :disabled="!form.file || form.processing">
                            {{ form.processing ? 'Uploading...' : 'Upload' }}
                        </button>
                    </div>
                </div>
            </div>


            <!-- STALL INFORMATION -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 space-y-3">
                <h2 class="text-2xl font-semibold text-gray-800 mb-3">Stall Information</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="block text-gray-400 text-xs uppercase tracking-wider">Stall Number</span>
                        <span class="font-semibold text-gray-800">{{ props.stall.stall_number }}</span>
                    </div>

                    <div>
                        <span class="block text-gray-400 text-xs uppercase tracking-wider">Price (per day)</span>
                        <span class="font-semibold text-green-600">₱{{ parseFloat(props.stall.price).toFixed(2)
                            }}</span>
                    </div>

                    <div>
                        <span class="block text-gray-400 text-xs uppercase tracking-wider">Size</span>
                        <span class="font-medium text-gray-700">{{ props.stall.size }}</span>
                    </div>

                    <div>
                        <span class="block text-gray-400 text-xs uppercase tracking-wider">Status</span>
                        <span class="px-2 py-1 rounded-full text-white text-xs font-medium capitalize"
                            :class="props.stall.status === 'free' ? 'bg-green-500' : 'bg-red-500'">
                            {{ props.stall.status }}
                        </span>
                    </div>
                </div>

                <div class="mt-4">
                    <span class="block text-gray-400 text-xs uppercase tracking-wider mb-1">Description</span>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ props.stall.description || 'No description provided.' }}
                    </p>
                </div>
            </div>

            <!-- ACTIVE VENDOR -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Current Vendor</h3>

                <div v-if="props.activeVendor"
                    class="border border-gray-200 rounded-lg p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="font-medium text-gray-800">{{ props.activeVendor.vendor_name }}</p>
                        <p class="text-gray-500 text-sm">{{ props.activeVendor.email }}</p>
                        <p class="text-gray-500 text-sm mt-1">Started on:
                            <span class="font-medium text-gray-700">
                                {{ new Date(props.activeVendor.start_date).toLocaleDateString() }}
                            </span>
                        </p>
                    </div>
                    <span class="mt-3 sm:mt-0 px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                        Active
                    </span>
                </div>

                <div v-else class="text-gray-500 italic text-center py-6 bg-gray-50 rounded-lg">
                    No active vendor currently renting this stall.
                </div>
            </div>

            <!-- RENTAL HISTORY -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Rental History</h3>

                <div v-if="props.rentHistory && props.rentHistory.length > 0" class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border border-gray-100 rounded-lg overflow-hidden">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Vendor Name</th>
                                <th class="px-4 py-3">Start Date</th>
                                <th class="px-4 py-3">End Date</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(rent, index) in props.rentHistory" :key="index"
                                class="border-t hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-medium text-gray-800">{{ rent.vendor_name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ new Date(rent.start_date).toLocaleDateString() }}
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ new Date(rent.end_date).toLocaleDateString() }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium"
                                        :class="rent.status === 'completed' ? 'bg-gray-200 text-gray-700' : 'bg-green-100 text-green-700'">
                                        {{ rent.status }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-else class="text-gray-500 italic text-center py-6 bg-gray-50 rounded-lg">
                    No rental history available for this stall.
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
