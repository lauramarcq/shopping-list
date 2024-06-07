<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ItemTable from "@/Components/ItemTable.vue";
import CreateItem from "@/Components/CreateItem.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    list: {
        required: true,
    },
});

const showDialog = ref(false);
</script>
<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit your shopping list
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex flex-row">
                            <h2
                                class="font-semibold text-xl text-gray-800 leading-tight self-center justify-self-start basis-1/4"
                            >
                                {{ list[0].name }}
                            </h2>
                            <div class="basis-3/4 flex flex-row justify-end">
                                <button
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full inline-block m-4"
                                    @click="showDialog = true"
                                >
                                    Add an Item
                                </button>
                                <Link
                                    href="/dashboard"
                                    class="hover:bg-gray-700 hover:text-white font-bold py-2 px-4 rounded-full inline-block m-4"
                                    >Back to all lists
                                </Link>
                            </div>
                        </div>
                        <ItemTable :list="list" />
                    </div>
                </div>
            </div>
        </div>
        <CreateItem
            v-model="showDialog"
            :modelValue="showDialog"
            :listId="list[0].id"
        />
    </AuthenticatedLayout>
</template>
