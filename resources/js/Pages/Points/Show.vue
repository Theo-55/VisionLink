<script setup>
import { ref, reactive, computed, watch } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Notification from "@/Components/Notification.vue";
import { router, Link } from "@inertiajs/vue3";
import { useVuelidate } from "@vuelidate/core";
import { required, numeric, minValue } from "@vuelidate/validators";

const notification = ref(null);

const props = defineProps({
    currentPoint: {
        required: true,
    },
    otherPoints: {
        required: true,
    },
});

const localCurrentPoint = ref({ ...props.currentPoint });

const rules = {
    name: { required },
    x_val: { required, numeric, minValue: minValue(0) },
    y_val: { required, numeric, minValue: minValue(0) },
};

const v$ = useVuelidate(rules, localCurrentPoint);

const closestAndFarthestPoints = computed(() => {
    let points = props.otherPoints.filter(
        (point) => point.id !== localCurrentPoint.value.id
    );
    let distances = points.map((point) => {
        let dx = point.x_val - localCurrentPoint.value.x_val;
        let dy = point.y_val - localCurrentPoint.value.y_val;
        return {
            id: point.id,
            distance: Math.sqrt(dx * dx + dy * dy),
        };
    });
    distances.sort((a, b) => a.distance - b.distance);
    let closestPoint = distances[0];
    let farthestPoint = distances[distances.length - 1];
    closestPoint = points.find((point) => point.id === closestPoint.id);
    farthestPoint = points.find((point) => point.id === farthestPoint.id);
    return { closestPoint, farthestPoint };
});

const deletePoint = async (id) => {
    try {
        await axios.delete(`/points/delete/${id}`);
        notification.value.displayNotification("Delete Successful!", "success");
        setTimeout(() => {
            router.visit("/points/index");
        }, 1500);
    } catch (error) {
        notification.value.displayNotification("Deletion Failed", "error");
        setTimeout(() => {
            router.visit("/points/index");
        }, 1500);
    }
};

const submitEdit = async () => {
    console.log(localCurrentPoint);
    try {
        await axios.put(`/points/update`, {
            id: localCurrentPoint.value.id,
            name: localCurrentPoint.value.name,
            x_val: localCurrentPoint.value.x_val,
            y_val: localCurrentPoint.value.y_val,
        });
        notification.value.displayNotification("Update Successful!", "success");
        setTimeout(() => {
            router.visit("/points/index");
        }, 1500);
    } catch (error) {
        notification.value.displayNotification("Update Failed", "error");
        setTimeout(() => {
            router.visit("/points/index");
        }, 1500);
    }
};

const resetForm = () => {
    localCurrentPoint.value = { ...props.currentPoint };
};

let formChanged = ref(false);

watch(
    localCurrentPoint,
    (newVal, oldVal) => {
        formChanged.value =
            JSON.stringify(newVal) !== JSON.stringify(props.currentPoint);
    },
    { deep: true }
);
</script>

<template>
    <div class="block justify-center items-center mt-20">
        <div class="flex justify-center">
            <h1
                class="font-bold font-gothic text-2xl flex mb-3 p-3 justify-center"
            >
                Edit a Point
            </h1>
            <Link
                href="/points/index"
                class="h-1/3 mt-2 ml-4 pt-1 pb-1 text-white bg-orange-500 hover:bg-orange-600 px-4 rounded"
                >Go Back</Link
            >
        </div>

        <notification ref="notification" />
        <div class="flex justify-center">
            <form class="bg-gray-100 p-8 shadow-md rounded-md w-2/4">
                <div class="flex mb-6">
                    <InputLabel
                        class="whitespace-nowrap font-semibold w-1/6"
                        for="name"
                        >Name</InputLabel
                    >
                    <TextInput
                        type="text"
                        id="device-name"
                        v-model="localCurrentPoint.name"
                        class="form-control rounded-md h-9 w-2/4 mx-6"
                        required
                    />
                    <div v-if="v$.name.$error">Please enter a Valid Name</div>
                </div>
                <div class="flex mb-4">
                    <InputLabel
                        class="whitespace-nowrap font-semibold w-1/6"
                        for="name"
                        >X value</InputLabel
                    >
                    <TextInput
                        type="number"
                        id="device-name"
                        v-model="localCurrentPoint.x_val"
                        class="form-control rounded-md h-9 w-2/4 mx-6"
                        required
                    />
                    <div v-if="v$.x_val.$error">
                        Please enter a valid number greater than 0 for x_val.
                    </div>
                </div>
                <div class="flex mb-4">
                    <InputLabel
                        class="whitespace-nowrap font-semibold w-1/6"
                        for="name"
                        >Y value</InputLabel
                    >
                    <TextInput
                        type="number"
                        id="device-name"
                        v-model="localCurrentPoint.y_val"
                        class="form-control rounded-md h-9 w-2/4 mx-6"
                        required
                    />
                    <div v-if="v$.y_val.$error">
                        Please enter a valid number greater than 0 for y_val.
                    </div>
                </div>
                <div class="flex justify-center mt-6">
                    <div class="bg-gray-100 p-8 shadow-md rounded-md w-2/4">
                        <h2 class="font-bold text-xl mb-3">
                            Closest and Farthest Points
                        </h2>
                        <div v-if="closestAndFarthestPoints.closestPoint">
                            <h3 class="font-semibold">Closest Point:</h3>
                            <p>
                                Name:
                                {{ closestAndFarthestPoints.closestPoint.name }}
                            </p>
                            <p>
                                X Value:
                                {{
                                    closestAndFarthestPoints.closestPoint.x_val
                                }}
                            </p>
                            <p>
                                Y Value:
                                {{
                                    closestAndFarthestPoints.closestPoint.y_val
                                }}
                            </p>
                        </div>
                        <div
                            v-if="closestAndFarthestPoints.farthestPoint"
                            class="mt-4"
                        >
                            <h3 class="font-semibold">Farthest Point:</h3>
                            <p>
                                Name:
                                {{
                                    closestAndFarthestPoints.farthestPoint.name
                                }}
                            </p>
                            <p>
                                X Value:
                                {{
                                    closestAndFarthestPoints.farthestPoint.x_val
                                }}
                            </p>
                            <p>
                                Y Value:
                                {{
                                    closestAndFarthestPoints.farthestPoint.y_val
                                }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button
                        type="button"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md mr-4"
                        :class="{
                            'bg-orange-500 hover:bg-orange-600': formChanged,
                            'bg-gray-500 cursor-not-allowed': !formChanged,
                        }"
                        @click="resetForm"
                    >
                        Reset
                    </button>
                    <button
                        type="button"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md mr-4"
                        @click="deletePoint(localCurrentPoint.id)"
                    >
                        Delete
                    </button>
                    <button
                        type="button"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md"
                        :class="{
                            'bg-orange-500 hover:bg-orange-600': formChanged,
                            'bg-gray-500 cursor-not-allowed': !formChanged,
                        }"
                        @click="submitEdit(localCurrentPoint.id)"
                        :disabled="!formChanged"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
