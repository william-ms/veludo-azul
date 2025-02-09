<script setup>
import { computed } from 'vue';

const props = defineProps({
    label: {
		type: String,
		default: '',
	},
    id: {
        type: String,
        default: '',
    },
    subText: {
		type: String,
		default: '',
	},
    modelValue: {
		type: [String, Number],
		default: '',
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

let classes = computed(() => {
    return {
        wrapper:        ["md:flex items-center my-6", props.classes.wrapper || ""].filter(Boolean),
        label:          ["w-1/6 required", props.classes.label || ""].filter(Boolean),
		wrapperInput:   ["w-full", (props.label) ? 'md:w-5/6' : '', props.classes.wrapperInput || ""].filter(Boolean),
        input:          ["block w-full rounded-md border-slate-300 placeholder-slate-300", props.classes.input || ""].filter(Boolean),
        subText:        ["ps-1 text-xs text-slate-500" , props.classes.subText || ""].filter(Boolean)
    } 
});

</script>

<template>
    <div :class="classes.wrapper">
        <label v-if="label" :class="classes.label" :for="id">{{ label }}</label>
        
        <div :class="classes.wrapperInput">
          	<input v-model="inputValue" :id="id" :class="classes.input" v-bind="$attrs" />
        	<p v-if="subText" :class="classes.subText">{{ subText }}</p>
        </div>
    </div>
</template>