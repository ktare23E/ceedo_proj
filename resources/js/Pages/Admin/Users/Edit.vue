<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { computed } from 'vue';

const props = defineProps({
    user : Object
})

const form = useForm({
    id : props.user.id,
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    address: props.user.address,
    email: props.user.email,
    status : props.user.status,
    user_type : 'Staff'
});


const status = ['Active','Inactive'];

// Dropdown options
const options = computed(() => {
    return status.map(data => ({
        value: data,
        label: data
    }))
})


const submit = () => {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to update this staff's information?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update',
    }).then((result) => {
        if (result.isConfirmed) {
            form.post(route('update_staff'), { // ✅ use PUT for updating
                onSuccess: () => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Staff Updated!',
                        text: 'The staff information has been successfully updated.',
                        timer: 2000,
                        showConfirmButton: false,
                    }).then(() => {
                        router.visit(route('users'));
                    });
                },
                onError: () => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Update Failed',
                        text: 'Please check the form and try again.',
                    });
                },
                onFinish: () => form.reset(), // ✅ no password fields to reset
            });
        }
    });
};

</script>

<template>
    <AdminLayout :title="'Edit User'" :header="'Edit User'">
        <div class="flex items-center justify-center min-h-[80vh]">
            <div class="bg-white shadow-xl rounded-2xl p-8 w-3/4 border border-gray-100 relative">

                <!-- Back Button -->
                <Link :href="route('users')"
                    class="absolute left-6 top-6 flex items-center text-gray-600 hover:text-purple-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="font-medium">Back</span>
                </Link>

                <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Edit User</h2>

                <form @submit.prevent="submit" class="space-y-4">
                    <!-- First Name -->
                    <div>
                        <InputLabel for="first_name" value="First Name" />
                        <TextInput id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name"
                            required autofocus autocomplete="given-name" />
                        <InputError class="mt-2" :message="form.errors.first_name" />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <InputLabel for="last_name" value="Last Name" />
                        <TextInput id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name"
                            required autocomplete="family-name" />
                        <InputError class="mt-2" :message="form.errors.last_name" />
                    </div>

                    <div>
                        <InputLabel for="last_name" value="Address" />
                        <TextInput id="address" type="text" class="mt-1 block w-full" v-model="form.address"
                            required autocomplete="family-name" />
                        <InputError class="mt-2" :message="form.errors.address" />
                    </div>

                    <!-- Email -->
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="flex-1 mt-2">
                        <SelectInput
                            v-model="form.status"
                            :options="options"
                            label="Status"
                            placeholder="Select a status"
                            valueKey="value"
                            labelKey="label"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.status" />
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-between pt-4">
                        <button
                            class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg transition-all duration-200 w-full"
                            :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
