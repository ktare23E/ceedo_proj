<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import TextArea from '@/Components/TextArea.vue';

const props = defineProps({
    establishment : Object
})

const form = useForm({
    establishment_id : props.establishment.id,
    stall_number: '',
    price: '',
    status: 'free',
    size: '',
    description : '',
    images: [],
});

const handleFiles = (e) => {
    const files = Array.from(e.target.files);

    if (files.length > 5) {
        Swal.fire({
            icon: 'error',
            title: 'Limit Exceeded',
            text: 'You can only upload up to 5 images.',
        });
        e.target.value = ''; // reset file input
        return;
    }
    form.images = files;
}

const submit = () => {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to create this stall?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, create it',
    }).then((result) => {
        if (result.isConfirmed) {
            form.post(route('store_stall'), {
                onSuccess: () => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Stall Created!',
                        text: 'The stall has been successfully created.',
                        timer: 2000,
                        showConfirmButton: false,
                    }).then(() => {
                        router.visit(route('view_establishment',props.establishment.id));
                    })
                },
                onError: () => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Creation failed',
                        text: 'Please check the form and try again.',
                    })
                },
            })
        }
    })
}
</script>

<template>
    <AdminLayout :title="'Create Stall'" :header="'Create Stall'">
        <div class="flex items-center justify-center min-h-[80vh]">
            <div class="bg-white shadow-xl rounded-2xl p-8 w-3/4 border border-gray-100 relative mt-14">

                <!-- Back Button -->
                <Link :href="route('view_establishment',props.establishment.id)"
                    class="absolute left-6 top-6 flex items-center text-gray-600 hover:text-purple-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="font-medium">Back</span>
                </Link>

                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Create Stall for {{ props.establishment.name }}</h2>

                <form @submit.prevent="submit" class="space-y-4">
                    <!-- First Name -->
                    <div>
                        <InputLabel for="requirement_name" value="Stall Number" />
                        <TextInput id="stall_number" type="text" class="mt-1 block w-full" v-model="form.stall_number"
                            required autofocus autocomplete="given-name" />
                        <InputError class="mt-2" :message="form.errors.stall_number" />
                    </div>

                    <div class="col-span-2">
                        <TextArea v-model="form.description" label="Description" placeholder="Type something"
                            id="description">
                            </TextArea>
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>

                    <div>
                        <InputLabel for="requirement_name" value="Price" />
                        <TextInput id="price" type="number" class="mt-1 block w-full" v-model="form.price"
                            required autofocus autocomplete="given-name" />
                        <InputError class="mt-2" :message="form.errors.price" />
                    </div>

                    <div>
                        <InputLabel for="requirement_name" value="Size" />
                        <TextInput id="size" type="text" class="mt-1 block w-full" v-model="form.size"
                            required autofocus autocomplete="given-name" />
                        <InputError class="mt-2" :message="form.errors.size" />
                    </div>

                    <div class="mt-2 col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input">Upload establishments images(up to 5 images only)</label>
                        <input @change="handleFiles" multiple accept="image/png, image/jpeg, image/jpg"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="file_input" type="file">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help"> PNG, JPG And
                            JPEG</p>
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-between pt-4">
                        <button
                            class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg transition-all duration-200 w-full"
                            :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Create Stall
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
