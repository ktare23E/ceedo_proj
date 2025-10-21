<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { computed } from 'vue';
import { onMounted } from 'vue';
import CreateButton from '@/Components/CreateButton.vue';
import DynamicTable from '@/Components/DynamicTable.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    establishments: Array
});


const columns = ['Establishment', 'Description', 'Address', 'Action'];

const rows = computed(() => {
    return props.establishments.map(data => ({
        id: data.id,
        'Establishment': data.name,
        'Description': data.description,
        'Address': data.address,
    }));
});



onMounted(() => {
    setTimeout(() => { $('#myTable').DataTable(); }, 0);
});
</script>

<template>
    <AdminLayout :title="'Establishment'" :header="'Establishment List'">
        <div class="mt-4 w-[98%] flex justify-end">
            <CreateButton :name="'Create Establishment'" :href="route('create_establishment')">
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
                        <div class="space-x-1">
                            <Link :href="route('edit_establishment', row.id)"
                            class="bg-purple-500 text-white px-3 py-1 rounded-sm text-sm hover:bg-blue-700">
                                edit
                            </Link>
                            <Link :href="route('view_establishment', row.id)"
                                class="bg-orange-400 text-white px-3 py-1 rounded-sm text-sm">
                                    view
                            </Link>
                        </div>
                    </template>
                </DynamicTable>
            </div>
        </div>
    </AdminLayout>
</template>