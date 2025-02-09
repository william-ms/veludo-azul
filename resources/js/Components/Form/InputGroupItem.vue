<script setup>
import { computed } from 'vue';

const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: ''
    },
    customClass: {
        type: String,
        default: ''
    },
    position: {
        type: String,
        default: 'middle',
        validator: value => ['start', 'middle', 'end'].includes(value)
    }
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

const positionClasses = {
    start:  "rounded-s-md",
    middle: "",
    end:    "rounded-e-md",
}

let classes = computed(() => {
    return ['h-full border-slate-300 placeholder-slate-300', positionClasses[props.position], props.customClass].filter(Boolean)
});
</script>

<template>
    <input v-model="inputValue" :class="classes" v-bind="$attrs" />
</template>