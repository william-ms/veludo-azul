<script setup>
import { computed, onMounted, onUnmounted, ref, watch } from "vue";

const props = defineProps({
    modelValue: Array, 
    options: Object,
    placeholder: String,
    onChange: Function,
    classes: {
        type: Object,
        default: () => ({}) 
    }
});

const emit = defineEmits(["update:modelValue"]);

const dropdownContainer = ref(null);
const selected = ref(props.modelValue || []);
const isOpen = ref(false);

//:::::::::: EVENT TO HANDLE CLICK OUTSIDE DROPDOWN :::::::::://
const handleClickOutside = (event) => {
    if (dropdownContainer.value && !dropdownContainer.value.contains(event.target)) {
        isOpen.value = false;
    }
};

onMounted(() => {
    document.addEventListener("click", handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener("click", handleClickOutside);
});

//:::::::::: TOGGLE DROPDOWN :::::::::://
const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
};

//:::::::::: TOGGLE OPTION ::::::::::// 
const toggleOption = (option) => {
    if (selected.value.includes(option)) {
        selected.value = selected.value.filter((item) => item !== option);
    } else {
        selected.value.push(option);
    }

    emit("update:modelValue", selected.value);
    props.onChange();

};

//:::::::::: REMOVE OPTION :::::::::://
const removeOption = (option) => {
    selected.value = selected.value.filter((item) => item !== option);

    emit("update:modelValue", selected.value);
    props.onChange();
};

//:::::::::: WACTH MODEL :::::::::://
watch(() => props.modelValue, (newValue) => {
    selected.value = newValue;
});

//:::::::::: COMPUTED CLASSES :::::::::://
let classes = computed(() => {
    return {
        btnDropdown: ["w-full h-full border border-gray-300 p-2 cursor-pointer bg-white", props.classes.btnDropdown || ""],
        dropdown: ["absolute left-0 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto z-50", props.classes.dropdown || ""],
        optionDropdown: ["px-4 py-2 cursor-pointer hover:bg-gray-100 flex items-center justify-between", props.classes.optionDropdown || ""],
        optionSelected: ["bg-blue-500 text-white text-sm rounded px-2 py-1 flex items-center gap-1", props.classes.optionSelected || ""],
        optionSelectedIcon: ["text-blue-500", props.classes.optionSelectedIcon || ""],
        placeholder: ["text-gray-500", props.classes.placeholder || ""]
    } 
});
</script>

<template>
    <div class="relative w-full h-full" ref="dropdownContainer">
        <!-- SELECT -->
        <select v-model="selected" multiple class="hidden">
            <option v-for="(option, index) in options" :key="index" :value="option">
                {{ option }}
            </option>
        </select>

        <!-- BTN DROPDOWN -->
        <div :class=classes.btnDropdown @click="toggleDropdown">
            <!-- SELECTED OPTIONS -->
            <div v-if="selected.length" class="flex flex-wrap text-nowrap gap-1">
                <span v-for="(option, index) in selected" :key="index" :class=classes.optionSelected>
                    {{ option }}

                    <button @click.stop="removeOption(option)">✕</button>
                </span>
            </div>

            <!-- PLACEHOLDER -->
            <span v-else :class=classes.placeholder>{{ props.placeholder }}</span>
        </div>

        <!-- DROPDOWN -->
        <div v-if="isOpen" :class=classes.dropdown>
            <div v-for="(option, index) in options" :key="index" :class=classes.optionDropdown @click="toggleOption(option)">
                <span>{{ option }}</span>
                <span v-if="selected.includes(option)" :class=classes.optionSelectedIcon>✔</span>
            </div>
        </div>
    </div>
</template>