<script setup>
import { ref, reactive, onMounted } from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Select from "@/Components/Select.vue";
import Notification from "@/Components/Notification.vue";

const notification = ref(null);

const props = defineProps({
    types: {
        type: Object,
        required: true,
    },
});

const frequencyOptions = [
    { value: "one-time", label: "One Time" },
    { value: "yearly", label: "Yearly" },
    { value: "monthly", label: "Monthly" },
];

const typesArray = props.types.map((type) => {
    return { value: type.name, label: type.name };
});

const formData = reactive({
    name: "",
    company: "",
    price: "",
    type: "",
    description: "",
    frequency: "",
});

const submitForm = async () => {
    try {
        await axios.post(`/software/request/submit`, formData);
        notification.value.displayNotification(
            "Submission Successful!",
            "success"
        );
        setTimeout(() => {
            router.visit("/software/index");
        }, 3500);
    } catch (error) {
        notification.value.displayNotification("Submission Failed", "error");
        setTimeout(() => {
            router.visit("/software/index");
        }, 3500);
    }
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="block justify-center items-center">
            <h1
                class="font-bold font-gothic text-2xl flex mb-3 p-3 justify-center"
            >
                Software Request
            </h1>
            <notification ref="notification" />
            <div class="flex justify-center">
                <form class="bg-white p-8 shadow-md rounded-md w-2/4">
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
                            >Company</InputLabel
                        >
                        <TextInput
                            type="text"
                            id="device-name"
                            v-model="formData.company"
                            class="form-control rounded-md h-9 w-2/4 mx-6"
                            required
                        />
                    </div>
                    <div class="flex mb-4">
                        <InputLabel
                            class="whitespace-nowrap font-semibold w-1/6"
                            for="name"
                            >Type</InputLabel
                        >
                        <Select
                            :options="typesArray"
                            v-model="formData.type"
                            class="form-control rounded-md h-9 w-2/4"
                            required
                        />
                    </div>
                    <div class="flex mb-4">
                        <InputLabel
                            class="whitespace-nowrap font-semibold w-1/6"
                            for="name"
                            >Description</InputLabel
                        >
                        <TextInput
                            type="text"
                            id="device-name"
                            v-model="formData.description"
                            class="form-control rounded-md h-20 w-3/4 mx-6"
                            required
                        />
                    </div>
                    <div class="flex mb-4">
                        <InputLabel
                            class="whitespace-nowrap font-semibold w-1/6"
                            for="name"
                            >Price</InputLabel
                        >
                        <TextInput
                            type="number"
                            id="softwarePrice"
                            v-model="formData.price"
                            class="form-control rounded-md h-9 w-2/4 mx-6"
                            required
                        />
                    </div>
                    <div class="flex mb-4">
                        <InputLabel
                            class="whitespace-nowrap font-semibold w-1/6"
                            for="name"
                            >Frequency</InputLabel
                        >
                        <Select
                            :options="frequencyOptions"
                            v-model="formData.frequency"
                            class="form-control rounded-md h-10 w-2/4 mx-1"
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
    </AuthenticatedLayout>
</template>
