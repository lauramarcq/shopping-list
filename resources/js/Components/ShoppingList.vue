<script>
import { computed } from "vue";

export default {
    props: {
        name: {
            type: String,
            required: true,
        },
        createdAt: {
            type: String,
            required: true,
        },
    },
    setup(props, { emit }) {
        const formatDate = computed(() => {
            return props.createdAt
                ? new Date(props.createdAt).toLocaleString()
                : "no date available";
        });

        const editList = (event) => {
            emit("editList", event);
        };

        return {
            formatDate,
            editList,
        };
    },
};
</script>

<template>
    <ul role="list" class="divide-y divide-gray-100">
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <div class="min-w-0 flex-auto">
                    <p class="text-sm font-semibold leading-6 text-gray-900">
                        {{ name }}
                    </p>
                    <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                        {{ formatDate }}
                    </p>
                </div>
            </div>
            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                <div class="mt-1 leading-5 flex flex-row gap-4">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                        @click.prevent="editList($event)"
                    >
                        Edit
                    </button>
                </div>
            </div>
        </li>
    </ul>
</template>

<style></style>
