<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { computed } from 'vue';
import { onMounted } from 'vue';
import CreateButton from '@/Components/CreateButton.vue';
import DynamicTable from '@/Components/DynamicTable.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    treasurers: Array
});


const columns = ['First Name', 'Last Name', 'Address', 'Email', 'Status', 'Action'];

const rows = computed(() => {
    return props.treasurers.map(data => ({
        id: data.id,
        'First Name': data.first_name,
        'Last Name': data.last_name,
        'Address': data.address,
        'Email': data.email,
        'Status': data.status,
    }));
});



onMounted(() => {
    setTimeout(() => { $('#myTable').DataTable(); }, 0);
});
</script>

<template>
    <AdminLayout :title="'Treasury'" :header="'Treasury List'">
        <div class="mt-4 w-[98%] flex justify-end">
            <CreateButton :name="'Create Treasrer'" :href="route('create_treasury')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </CreateButton>
        </div>

        <div class="bg-white rounded-lg shadow p-6 flex items-center justify-center mt-4 w-[95%] mx-auto">
            <div class="w-full">
                <DynamicTable :columns="columns" :rows="rows" :class="'text-sm'">
                    <template #Action="{ row }">
                        <Link :href="route('edit_user', row.id)"
                            class="bg-purple-500 text-white px-3 py-1 rounded-sm text-sm hover:bg-blue-700">
                                edit
                        </Link>
                    </template>
                </DynamicTable>
            </div>
        </div>
    </AdminLayout>
</template>