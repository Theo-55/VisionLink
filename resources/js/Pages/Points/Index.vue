<script setup>
import { onMounted } from "vue";
import { Link } from "@inertiajs/vue3";
import PointsTable from "./partials/PointsTable.vue";

const props = defineProps({
    points: {
        required: true,
    },
});
</script>
<template>
    <div class="flex justify-center">
        <div class="grid grid-cols-3 mx-auto w-11/12 mt-10">
            <h1
                class="col-start-2 col-span-1 text-center font-semibold text-3xl text-gray-800 leading-tight"
            >
                Points
            </h1>
            <div class="flex justify-start">
                <Link
                    class="h-full pt-2 pb-1 text-white bg-orange-500 hover:bg-orange-600 px-4 rounded"
                    href="/points/create"
                    >+</Link
                >
            </div>
        </div>
    </div>
    <div class="relative w-3/4 mx-auto mt-20">
        <PointsTable :points="points"></PointsTable>
    </div>
</template>
