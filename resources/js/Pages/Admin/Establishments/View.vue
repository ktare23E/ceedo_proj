<script setup>
import { Head, Link, router, useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { ref } from 'vue'

const props = defineProps({
    establishment: Object,
    images: Array,
    stalls: Array
})

// Inertia form (you were missing this)
const form = useForm({
    file: null,
})

// Modal state
const previewImage = ref(null)
const showReuploadModal = ref(false)
const selectedImage = ref(null)
const showMenu = ref(null)

// Carousel scrolling
const carousel = ref(null)

const scrollCarousel = (direction) => {
    const el = carousel.value
    if (!el) return
    const scrollAmount = 420 // width of each image + gap
    if (direction === 'left') el.scrollBy({ left: -scrollAmount, behavior: 'smooth' })
    else el.scrollBy({ left: scrollAmount, behavior: 'smooth' })
}

// Handlers
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
    // ensure you pass the full image object here
    selectedImage.value = img
    showReuploadModal.value = true
    showMenu.value = null
    // reset previous file selection
    form.reset()
}

const closeReuploadModal = () => {
    showReuploadModal.value = false
    selectedImage.value = null
    form.reset()
}

// Submit new image
const submitReupload = () => {
    // guard: ensure a file selected and selectedImage exists
    if (!form.file || !selectedImage.value) return

    form.post(route('establishments.image.update', selectedImage.value.id), {
        forceFormData: true,
        onSuccess: () => {
            closeReuploadModal()
        },
        onError: () => {
            // keep modal open so user can see validation errors returned from the server
        }
    })
}

// File input handler
const handleFileChange = (e) => {
    form.file = e.target.files[0] ?? null
}

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
            <div class="relative w-full">
                <!-- Left Arrow -->
                <button @click="scrollCarousel('left')"
                    class="absolute left-2 top-1/2 -translate-y-1/2 z-20 bg-white/80 hover:bg-white text-gray-700 rounded-full p-2 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Carousel Images -->
                <div ref="carousel" class="w-full overflow-hidden flex gap-4 scroll-smooth">
                    <div v-for="(img, index) in props.images" :key="index"
                        class="relative min-w-[400px] h-[250px] shrink-0 group">
                        <img :src="`/storage/${img.file_path}`" alt="Establishment Image"
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
                                class="absolute right-0 mt-2 bg-white border border-gray-200 shadow-lg rounded-lg w-32 z-10">
                                <button @click="openReuploadModal(img)"
                                    class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 text-gray-700">
                                    Edit Image
                                </button>
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
            <div v-if="showReuploadModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50">
                <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative" @click.stop>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Re-upload Image</h3>

                    <div class="border-dashed border-2 border-gray-300 rounded-lg p-4 text-center mb-4">
                        <p class="text-gray-500 text-sm mb-2">Current Image:</p>

                        <!-- guard image access: only show when selectedImage exists -->
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


            <!-- ESTABLISHMENT INFO -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <h2 class="text-2xl font-semibold text-gray-800 mb-3">{{ props.establishment.name }}</h2>
                <p class="text-gray-600 mb-2">{{ props.establishment.description }}</p>
                <p class="text-gray-500">
                    <span class="font-medium text-gray-700">Address:</span> {{ props.establishment.address }}
                </p>
                
                <p class="text-gray-500">
                    <span class="font-medium text-gray-700">Total Number of Stalls:</span> {{ props.stalls.length }}
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
                                <span class="px-2 py-1 rounded-full text-white text-xs font-medium capitalize"
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
                        <div class="flex items-center gap-3 mt-5">
                            <!-- View Button -->
                            <Link :href="route('view_stall', stall.id)"
                                class="flex items-center justify-center flex-1 gap-2 bg-yellow-500 hover:bg-yellow-600 text-white py-2.5 rounded-lg font-semibold text-sm shadow-sm hover:shadow transition duration-200">
                            <i class="fas fa-eye"></i>
                            <span>View</span>
                            </Link>

                            <!-- Edit Button -->
                            <Link :href="route('edit_stall', stall.id)"
                                class="flex items-center justify-center flex-1 gap-2 bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-lg font-semibold text-sm shadow-sm hover:shadow transition duration-200">
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
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
