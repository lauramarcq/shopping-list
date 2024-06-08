<template>
    <div>
        <SuccessAlert
            v-if="toggleAlert"
            @update:showSuccess="toggleAlert = false"
        />
        <table class="table-fixed" style="width: 100%">
            <thead>
                <tr
                    class="bg-gray-100 border-b border-gray-200 hover:bg-gray-200 min-w-10"
                >
                    <th class="p-4 text-left">Name</th>
                    <th class="p-4 text-left">Price</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="listItem in list[0].items"
                    :key="listItem.id"
                    class="bg-gray-100 border-b border-gray-200 hover:bg-gray-200 min-w-10"
                >
                    <td class="p-4">
                        {{ listItem.name }}
                    </td>

                    <td class="p-4">£ {{ listItem.price }}</td>

                    <td class="p-4 flex space-x-2 justify-center">
                        <!-- <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                    >
                        Mark as bought
                    </button> -->
                        <button
                            class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                            id="delete-button"
                            @click="deleteItem(listItem.id)"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import SuccessAlert from "@/Components/SuccessAlert.vue";

const props = defineProps({
    list: {
        required: true,
    },
});

let toggleAlert = ref(false);

const deleteItem = (itemId) => {
    const listId = props.list[0].id;
    router.delete(`/lists/${listId}/${itemId}/delete`, {
        onBefore: () => {
            confirm("Are you sure you want to delete this item?");
        },
        onSuccess: () => {
            toggleAlert.value = true;
        },
    });
};
</script>
