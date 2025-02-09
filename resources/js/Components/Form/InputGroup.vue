<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: {
        type: String,
        defualt: ''
    },
    subtext: { 
        type: String, 
        default: ''
    },
    classes: {
        type: Object,
        default: () => ({})
    },
});

let classes = computed(() => {
    return {
        wrapper:        ["w-full md:flex items-center", props.classes.wrapper || ""],
        label:          ["w-1/6 required", props.classes.label || ""],
		wrapperSubtext: ["w-full h-full", (props.label) ? 'md:w-5/6' : '' , props.classes.wrapperInput || ""],
        wrapperInputs:  ["flex w-full h-full", props.classes.wrapperInputs || ""],
        subtext:        ["ps-1 text-xs text-slate-500" , props.classes.subtext || ""]
    } 
});

</script>

<template>
    <div :class="classes.wrapper">
        <label v-if="label" :class="classes.label">{{ label }}</label>
        
        <div :class="classes.wrapperSubtext">
            <div :class="classes.wrapperInputs">
                <slot />
            </div>
        	<p v-if="subtext" :class="classes.subtext">{{ subtext }}</p>
        </div>
    </div>
</template>