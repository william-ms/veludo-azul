<script setup>
import { useForm } from "@inertiajs/vue3";
import BaseModal from "@/Components/BaseModal.vue";

let props = defineProps({
    showFilter: { type: Boolean, default: false },
    inputs: { type: Array },
    route: { type: String, default: route(route().current()) },
});

const form = useForm({});

props.inputs.forEach((input) => {
    form[input.name] = null;
});

function filter() {
    form.get(props.route);
}

function clearFilter() {
    form.get(props.route);
}
</script>

<template>
    <BaseModal :show="showFilter">
        <div class="modal-header flex justify-end px-6 pt-6 pb-4 border-b">
            <BaseButton color="danger" :class="'px-2 py-2'" @click="$emit('hideFilter')">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                </svg>
            </BaseButton>
        </div>
        <!-- modal-header -->

        <div class="modal-body px-6 py-4">
            <form method="GET" @submit.prevent="filter()" id="filter-form">
                <div v-for="input in inputs" :key="input">
                    <div v-if="input.type == 'text'" class="mb-4">
                        <label class="block pb-1" :for="input.name">{{ input.label }}</label>
                        <input v-model="form[input.name]" type="text" class="block w-full rounded-md border-slate-300" :id="input.name" :name="input.name" :placeholder="input.placeholder" />
                    </div>
                </div>
            </form>
        </div>
        <!-- modal-body -->

        <div class="modal-footer flex justify-end gap-2 px-6 pt-4 pb-6 border-t">
            <BaseButton color="warning" :class="'px-3 py-2'" @click="clearFilter()" :disabled="form.processing">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                </svg>
                Limpar filtro
            </BaseButton>

            <BaseButton color="primary" btnType="submit" :class="'px-3 py-2'" form="filter-form" :disabled="form.processing">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list-search">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M15 15m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                    <path d="M18.5 18.5l2.5 2.5" />
                    <path d="M4 6h16" />
                    <path d="M4 12h4" />
                    <path d="M4 18h4" />
                </svg>
                Filtrar
            </BaseButton>
        </div>
        <!-- modal-footer -->
    </BaseModal>
</template>
