<script setup lang="js">
// import PrimaryButton from '../Components/PrimaryButton.vue';
import { Link } from "@inertiajs/vue3";


const goToTable = () => {
    window.location.href('/table');
}
</script>
<template>
    <div class="max-w-md mr-auto ml-auto mt-20">
        <div class="flex-col items-center bg-gray-100 shadow-lg rounded-lg">
            <div
                class="bg-cover bg-center h-56 p-4"
                :style="`background-image: url('${publicPath}');`"
            ></div>
            <div class="p-4 text-center">
                <p
                    class="uppercase tracking-wide text-sm font-bold text-gray-700"
                >
                    Thatcher Deyoe's Tech Assessment
                </p>
            </div>
            <div
                class="px-2 pt-3 pb-4 border-t border-gray-300 bg-gray-100 justify-center"
            >
                <div
                    class="h-full w-full text-center text-xs text-gray-600 mr-auto ml-auto"
                >
                    <Link
                        class="mx-auto w-1/4 text-white bg-orange-500 hover:bg-orange-600 px-6 py-2 rounded"
                        href="/points/index"
                    >
                        Lets Go!
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
