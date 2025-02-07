<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import BaseBreadcrumbs from "@/Components/BaseBreadcrumbs.vue";
import BaseAlert from "@/Components/BaseAlert.vue";

let breadcrumbs = [
    {
        text: "Tipos de serviços",
        href: route("service.type.index"),
    },
    {
        text: "Editar",
    },
];

let props = defineProps({
    ServiceType: Object,
});

const form = useForm({
    service_type_id: props.ServiceType.service_type_id,
    name: props.ServiceType.name,
    value: props.ServiceType.value,
});

function update() {
    form.put(route("service.type.update", props.ServiceType.id), {});
}

const goBack = () => {
    return window.history.back();
};
</script>

<template>
    <WebLayout>
        <Head title="Editar tipo de serviço" />

        <div id="page-content" class="px-5 lg:px-10 pt-8">
            <div id="page-header" class="p-1">
                <BaseBreadcrumbs :breadcrumbs="breadcrumbs" />
            </div>
            <!-- page-header -->

            <div id="page-body" class="">
                <div class="card bg-white border rounded-lg">
                    <div class="card-header flex justify-between px-6 pt-6 pb-4 border-b">
                        <h1 class="text-2xl font-bold text-slate-800">{{ ServiceType.name }}</h1>

                        <div>
                            <BaseButton @click="goBack()" :class="'px-3 py-2'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                                </svg>
                                Voltar
                            </BaseButton>
                        </div>
                    </div>
                    <!-- card-header -->

                    <div class="card-body px-6 py-4">
                        <BaseAlert />

                        <form method="POST" @submit.prevent="update()" id="edit-form">
                            <!-- [input] - NOME -->
                            <div class="flex items-center my-6">
                                <label class="w-1/6 required">Nome</label>
                                <div class="w-full md:w-5/6">
                                    <input type="text" v-model="form.name" class="block w-full md:w-full rounded-md border-slate-300 placeholder-slate-300" id="name" placeholder="Informe o nome do cliente" required />
                                    <p class="ps-1 text-xs text-slate-500">ex: Bainha, Apertar cintura, etc.</p>
                                </div>
                            </div>

                            <!-- [input] - VALOR -->
                            <div class="md:flex items-center my-6">
                                <label class="w-1/6 required" for="value">Valor</label>
                                <input type="text" v-model="form.value" v-mask="['R$ #,##', 'R$ ##,##', 'R$ ###,##']" class="block w-full md:w-5/6 rounded-md border-slate-300 placeholder-slate-300" id="value" placeholder="R$ 00,00" required />
                            </div>
                        </form>
                    </div>
                    <!-- card-body -->

                    <div class="card-footer px-6 pt-4 pb-6 border-t">
                        <BaseButton color="primary" btnType="submit" :class="'px-3 py-2'" form="edit-form" :disabled="form.processing">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 12l5 5l10 -10" />
                                <path d="M2 12l5 5m5 -5l5 -5" />
                            </svg>
                            Enviar
                        </BaseButton>
                        <p class="pt-1 text-xs"><span class="required"></span><i>Campos obrigatórios</i></p>
                    </div>
                </div>
                <!-- card -->
            </div>
            <!-- page-body -->
        </div>

        <!-- page-content -->
    </WebLayout>
</template>
