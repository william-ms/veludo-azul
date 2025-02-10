<script setup>
import { computed } from 'vue';

const props = defineProps({
    modelValue: {
		type: [String, Number],
		default: '',
	},
    id: {
        type: String,
        default: '',
    },
    label: {
		type: String,
		default: '',
	},
    color: {
        type: String,
        default: 'primary'
    },
    classes: {
        type: Object,
        default: () => ({})
    },
});

const emit = defineEmits(['update:modelValue']);

defineOptions({
  inheritAttrs: false,
});

const inputValue = computed({
	get() {
		return props.modelValue;
	},
	set(value) {
		emit('update:modelValue', value);
	}
});

let colors = {
    primary:    "text-[#5272ff]",
    danger:     "text-red-600",
    warning:    "text-yellow-400",
};

let classes = computed(() => {
    return {
        wrapper:    ["flex items-center gap-1 hover:text-slate-600", props.classes.wrapper].filter(Boolean),
        label:      ["", props.classes.label].filter(Boolean),
        input:      ["rounded border-slate-300 shadow-sm focus:ring-transparent", colors[props.color], props.classes.input].filter(Boolean),
    } 
});

</script>

<template>
    <div :class="classes.wrapper">
        <input type="checkbox" v-model="inputValue" :id="id" :class="classes.input" v-bind="$attrs">
        <label v-if="label" :class="classes.label" :for="id">{{ label }}</label>
    </div>
</template>