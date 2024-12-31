<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    breadcrumbs: Array,
});
</script>

<template>
    <div id="breadcrumbs">
        <ul class="flex text-sm">
            <li>
                <div class="flex items-center">
                    <Link :href="route('home')" class="text-slate-800">Início</Link>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mx-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </li>

            <li v-for="breadcrumb in breadcrumbs" :key="breadcrumb.text">
                <div v-if="breadcrumb.href" class="flex items-center">
                    <Link :href="breadcrumb.href" class="text-slate-800">{{ breadcrumb.text }}</Link>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3 mx-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </div>

                <p v-else class="text-slate-500">{{ breadcrumb.text }}</p>
            </li>
        </ul>
    </div>
</template>