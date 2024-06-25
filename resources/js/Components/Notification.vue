<template>
    <transition name="fade">
        <div
            v-if="show"
            :class="[
                'fixed top-8 right-8 flex items-center justify-center px-4 py-2 border rounded shadow-lg z-50 transition-opacity',
                notificationTypeClasses,
            ]"
        >
            <span class="text-lg font-bold">{{ message }}</span>
        </div>
    </transition>
</template>

<script setup>
import { ref, computed } from "vue";

const show = ref(false);
const message = ref("");
const notificationType = ref("success"); // 'success' or 'error'

const notificationTypeClasses = computed(() => {
    return {
        "bg-green-500 text-white border-green-700":
            notificationType.value === "success",
        "bg-red-500 text-white border-red-700":
            notificationType.value === "error",
    };
});

function displayNotification(msg, type = "success") {
    message.value = msg;
    notificationType.value = type;
    show.value = true;
    setTimeout(() => {
        show.value = false;
    }, 3000); // Hide after 3 seconds
}

defineExpose({
    displayNotification,
});
</script>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
