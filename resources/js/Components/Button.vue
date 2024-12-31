<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

let props = defineProps({
    color: { type: String, default: "primary" },
    btnType: { type: String, default: "button" },
});

let colors = {
    transparent: "text-slate-800 hover:bg-slate-200",
    primary: "text-white bg-[#5272ff] hover:bg-blue-700 focus:bg-blue-700",
    light_primary: "text-[#5272ff] border border-[#5272ff] hover:bg-blue-100 focus:bg-blue-200",
    danger: "text-white bg-red-600 hover:bg-red-700 focus:bg-red-700",
    light_danger: "text-red-600 border border-red-600 hover:bg-red-100 focus:bg-red-200",
    warning: "text-white bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-700",
};

let classes = computed(() => {
    return ["flex items-center gap-x-1 p-1 text-sm font-medium rounded-md focus:outline-none disabled:opacity-50 disabled:pointer-events-none", colors[props.color]];
});
</script>

<template>
    <button v-if="props.btnType == 'button'" type="button" :class="classes">
        <slot />
    </button>

    <button v-else-if="props.btnType == 'submit'" type="submit" :class="classes">
        <slot />
    </button>

    <Link v-else-if="props.btnType == 'link'" :class="classes">
        <slot />
    </Link>
</template>
