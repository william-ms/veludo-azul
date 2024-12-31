<script setup>
import { Link } from "@inertiajs/vue3";

let props = defineProps({
    links: Object,
});
</script>

<template>
    <ul class="flex">
        <li v-for="(link, index) in links" :key="index">
            <Link v-if="link.url != null" :href="link.url ?? ''" class="border px-3 py-2" :class="{ 'bg-[#5272ff] text-white': link.active, 'rounded-tl-lg rounded-bl-lg': index === 0, 'rounded-tr-lg rounded-br-lg': index === links.length - 1 }">
                <span v-html="link.label"></span>
            </Link>
        </li>
    </ul>
</template>
