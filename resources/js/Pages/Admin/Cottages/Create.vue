<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TextArea from '@/Components/TextArea.vue';

const form = useForm({
    name: '',
    description: '',
    price_per_hour: '',
    capacity: '',
    status: 'available',
    image: null, // single image
});

// Handle single image
const handleFile = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.image = file;
    }
};

const submit = () => {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to create this floating cottage?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#4f46e5',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, create it',
    }).then((result) => {
        if (result.isConfirmed) {
            form.post(route('store_cottage'), {
                onSuccess: () => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Floating Cottage Created!',
                        text: 'The floating cottage has been successfully added.',
                        timer: 2000,
                        showConfirmButton: false,
                    }).then(() => {
                        router.visit(route('cottages'));
                    })
                },
                onError: () => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Creation Failed',
                        text: 'Please check the form and try again.',
                    });
                },
            });
        }
    });
};
</script>

<template>
    <AdminLayout :title="'Create Floating Cottage'" :header="'Create Floating Cottage'">
        <div class="flex items-center justify-center min-h-[80vh]">
            <div class="bg-white shadow-xl rounded-2xl p-8 w-3/4 border border-gray-100 relative mt-16">

                <!-- Back Button -->
                <Link :href="route('cottages')"
                    class="absolute left-6 top-6 flex items-center text-gray-600 hover:text-purple-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="font-medium">Back</span>
                </Link>

                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Create Floating Cottage</h2>

                <form @submit.prevent="submit" class="space-y-4">

                    <div>
                        <InputLabel for="name" value="Cottage Name" />
                        <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div>
                        <TextArea v-model="form.description" label="Description"
                            placeholder="Enter details about the floating cottage" id="description"></TextArea>
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>

                    <div>
                        <InputLabel for="price_per_hour" value="Price per Hour" />
                        <TextInput id="price_per_hour" type="number" step="0.01" class="mt-1 block w-full"
                            v-model="form.price_per_hour" required />
                        <InputError class="mt-2" :message="form.errors.price_per_hour" />
                    </div>

                    <div>
                        <InputLabel for="capacity" value="Capacity" />
                        <TextInput id="capacity" type="number" class="mt-1 block w-full" v-model="form.capacity" required />
                        <InputError class="mt-2" :message="form.errors.capacity" />
                    </div>

                    <div>
                        <InputLabel for="image" value="Upload Image" />
                        <input @change="handleFile" accept="image/png, image/jpeg, image/jpg"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                            id="image" type="file">
                        <p class="mt-1 text-sm text-gray-500">Only 1 image allowed (PNG, JPG, JPEG)</p>
                        <InputError class="mt-2" :message="form.errors.image" />
                    </div>

                    <div class="pt-4">
                        <button
                            class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg transition-all duration-200 w-full"
                            :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create Floating Cottage
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
