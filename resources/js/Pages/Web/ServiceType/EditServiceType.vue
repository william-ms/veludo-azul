<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import BaseBreadcrumbs from "@/Components/BaseBreadcrumbs.vue";
import BaseAlert from "@/Components/BaseAlert.vue";
import InputSimple from "@/Components/Form/InputSimple.vue";

let props = defineProps({
    ServiceType: Object,
});

let breadcrumbs = [
    {
        text: "Tipos de serviços",
        href: route("service.type.index"),
    },
    {
        text: "Editar",
    },
];

const form = useForm({
    service_type_id: props.ServiceType.service_type_id,
    name: props.ServiceType.name,
    value: props.ServiceType.value,
});

function update() {
    form.put(route("service.type.update", props.ServiceType.id), {});
}

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
                            <BaseButton btnType="link" :href="route('service.type.index')" :class="'px-3 py-2'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 6l11 0" />
                                    <path d="M9 12l11 0" />
                                    <path d="M9 18l11 0" />
                                    <path d="M5 6l0 .01" />
                                    <path d="M5 12l0 .01" />
                                    <path d="M5 18l0 .01" />
                                </svg>
                                Listar tipos de serviço
                            </BaseButton>
                        </div>
                    </div>
                    <!-- card-header -->

                    <div class="card-body px-6 py-4">
                        <BaseAlert />

                        <form method="POST" @submit.prevent="update()" id="edit-form">
                            <!-- [input] - NOME -->
                            <InputSimple type="text" v-model="form.name" label="Nome:" id="name" placeholder="Informe o nome do tipo de serviço" subText="ex: Bainha, Apertar cintura, etc." required />

                            <!-- [input] - VALOR -->
                            <InputSimple type="text" v-model="form.value" label="Valor:" id="value" v-mask="['R$ #,##', 'R$ ##,##', 'R$ ###,##']" placeholder="R$ 00,00" required />
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
