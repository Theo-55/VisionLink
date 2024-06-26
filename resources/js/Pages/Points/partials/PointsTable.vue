<script setup>
import { ref, reactive } from "vue";

import { Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

// const searchActive = ref(false);
// const tableData = ref(props.approvedSoftware);
const tableColumns = ["Name", "X", "Y"];

const props = defineProps({
    points: {
        type: Object,
        required: false,
    },
});

const showPoint = (id) => {
    window.location.href = `/points/show/${id}`;
};
</script>
<template>
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
            <div class="py-1 inline-block min-w-full sm:px-4 lg:px-7">
                <div class="overflow-hidden rounded-lg">
                    <table class="w-full">
                        <thead class="bg-gray-200 border-b">
                            <tr>
                                <th
                                    scope="col"
                                    class="text-med font-large text-gray-900 px-6 py-4 text-center"
                                    v-for="column in tableColumns"
                                    :key="column"
                                >
                                    {{ column }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-center border-2">
                            <tr
                                class="bg-white border-b transition duration-300 ease-in-out cursor-points hover:bg-gray-300"
                                v-for="point in points"
                                :key="point"
                                @click="showPoint(point.id)"
                            >
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                >
                                    {{ point.name }}
                                </td>
                                <td>
                                    {{ point.x_val }}
                                </td>
                                <td>{{ point.y_val }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
