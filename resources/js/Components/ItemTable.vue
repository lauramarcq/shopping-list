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
                    v-for="listItem in list.items"
                    :key="listItem.id"
                    :class="{
                        'bg-green-100 border-b border-green-200 hover:bg-green-200 min-w-10 text-green-800':
                            boughtItems.includes(listItem.id),
                        'bg-gray-100 border-b border-gray-200 hover:bg-gray-200 min-w-10':
                            !boughtItems.includes(listItem.id),
                    }"
                >
                    <td class="p-4">
                        {{ listItem.name }}
                    </td>

                    <td class="p-4">£ {{ listItem.price }}</td>

                    <td class="p-4 flex space-x-2 justify-center">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                            @click="toggleBought(listItem.id)"
                        >
                            {{
                                boughtItems.includes(listItem.id)
                                    ? "Undo"
                                    : "Mark as bought"
                            }}
                        </button>
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
let boughtItems = ref([]);

const deleteItem = (itemId) => {
    const listId = props.list.id;
    router.delete(`/lists/${listId}/${itemId}/delete`, {
        onBefore: () => {
            //with more time, this would be a modal
            confirm("Are you sure you want to delete this item?");
        },
        onSuccess: () => {
            toggleAlert.value = true;
        },
    });
};

const toggleBought = (itemId) => {
    const listId = props.list.id;
    router.patch(`/lists/${listId}/${itemId}/toggle`);
    if (props.list.items.find((item) => item.id === itemId)) {
        if (boughtItems.value.includes(itemId)) {
            boughtItems.value = boughtItems.value.filter((id) => id !== itemId);
        } else {
            boughtItems.value.push(itemId);
        }
    }
};
</script>
