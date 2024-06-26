<script setup>
import { ref, reactive, onMounted } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Notification from "@/Components/Notification.vue";
import { router } from "@inertiajs/vue3";

const notification = ref(null);

const formData = reactive({
    name: "",
    x_val: "",
    y_val: "",
});

const submitForm = async () => {
    try {
        await axios.post(`/points/save`, formData);
        notification.value.displayNotification(
            "Submission Successful!",
            "success"
        );
        setTimeout(() => {
            router.visit("/points/index");
        }, 1500);
    } catch (error) {
        notification.value.displayNotification("Submission Failed", "error");
        setTimeout(() => {
            router.visit("/points/index");
        }, 1500);
    }
};
</script>

<template>
    <div class="block justify-center items-center mt-20">
        <h1 class="font-bold font-gothic text-2xl flex mb-3 p-3 justify-center">
            Create a Point
        </h1>
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
                        v-model="formData.name"
                        class="form-control rounded-md h-9 w-2/4 mx-6"
                        required
                    />
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
                        v-model="formData.x_val"
                        class="form-control rounded-md h-9 w-2/4 mx-6"
                        required
                    />
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
                        v-model="formData.y_val"
                        class="form-control rounded-md h-9 w-2/4 mx-6"
                        required
                    />
                </div>
                <div class="flex justify-end">
                    <button
                        type="button"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md"
                        @click="submitForm"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
