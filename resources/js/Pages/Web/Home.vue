<script setup>
import { Head } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";

let props = defineProps({
    Services: Array,
});

console.log(props.Services);
</script>

<template>
    <WebLayout>
        <Head title="Home" />

        <div id="page-content">
            <div id="page-header"></div>

            <div id="page-body" class="p-2">
                <!-- <ul>
                    <li v-for="User in Users" :key="User.id">
                        {{ User.name }}
                    </li>
                </ul> -->

                <div class="flex justify-between">
                    <div id="search"></div>

                    <div class="flex gap-1">
                        <Button btnType="link" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </Button>

                        <Button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </Button>
                    </div>
                </div>

                <div>
                    <!-- SERVIÇOS DO DIA -->
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="Service in Services" :key="Service.id">
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </WebLayout>
</template>
