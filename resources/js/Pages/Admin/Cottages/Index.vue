<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { computed, onMounted } from 'vue';
import CreateButton from '@/Components/CreateButton.vue';
import DynamicTable from '@/Components/DynamicTable.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    cottages: Array
});

const columns = ['Name', 'Description', 'Price Per Hour', 'Capacity', 'Status', 'Action'];

// ✅ Format helper functions
const formatPrice = (value) => {
    if (value === null || value === undefined || value === '') return '₱ 0.00';
    return '₱ ' + Number(value).toLocaleString('en-PH', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
};

const capitalizeFirst = (text) => {
    if (!text) return '';
    return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
};

// ✅ Computed table rows
const rows = computed(() => {
    return props.cottages.map(data => ({
        id: data.id,
        'Name': data.name,
        'Description': data.description,
        'Price Per Hour': formatPrice(data.price_per_hour),
        'Capacity': data.capacity,
        'Status': capitalizeFirst(data.status),
    }));
});

onMounted(() => {
    setTimeout(() => { $('#myTable').DataTable(); }, 0);
});
</script>

<template>
    <AdminLayout :title="'Floating Cottages'" :header="'Floating Cottages'">
        <div class="mt-4 w-[98%] flex justify-end">
            <CreateButton :name="'Create Floating Cottage'" :href="route('create_cottages')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </CreateButton>
        </div>

        <div class="bg-white rounded-lg shadow p-6 flex items-center justify-center mt-4 w-[95%] mx-auto">
            <div class="w-full">
                <DynamicTable :columns="columns" :rows="rows" class="text-sm">
                    <template #Action="{ row }">
                        <div class="space-x-1">
                            <Link :href="route('edit_cottage', row.id)"
                                class="bg-purple-500 text-white px-3 py-1 rounded-sm text-sm hover:bg-blue-700">
                                edit
                            </Link>
                            <!-- <Link :href="route('floating_cottages.show', row.id)"
                                class="bg-orange-400 text-white px-3 py-1 rounded-sm text-sm">
                                View
                            </Link> -->
                        </div>
                    </template>
                </DynamicTable>
            </div>
        </div>
    </AdminLayout>
</template>
