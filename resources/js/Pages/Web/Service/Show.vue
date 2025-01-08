<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import Alert from "@/Components/Alert.vue";

let breadcrumbs = [
    {
        text: "Serviços",
        href: route("service.index"),
    },
    {
        text: "Ver serviço",
    },
];

let props = defineProps({
    Service: Object,
    ServiceStatus: Object,
});

let badgeColor = {
    pendente: "bg-yellow-50 text-yellow-800 ring-yellow-600/20",
    atrasado: "bg-red-50 text-red-700 ring-red-600/10",
    pronto: "bg-green-50 text-green-700 ring-green-600/20",
    entregue: "bg-blue-50 text-blue-700 ring-blue-700/10",
    cancelado: "bg-gray-50 text-gray-600 ring-gray-500/10",
};
</script>

<template>
    <WebLayout>
        <Head title="Serviço" />

        <div id="page-content" class="px-5 lg:px-10 pt-8">
            <div id="page-header" class="p-1">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </div>
            <!-- page-header -->

            <div id="page-body" class="">
                <div class="card bg-white border rounded-lg">
                    <div class="card-header flex justify-between px-6 pt-6 pb-4 border-b">
                        <h1 class="text-2xl font-bold text-slate-800">
                            Serviço #{{ Service.service }} <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset" :class="badgeColor[ServiceStatus[Service.status]]">{{ ServiceStatus[Service.status] }}</span>
                        </h1>

                        <div>
                            <Button btnType="link" :href="route('client.index')" :class="'px-3 py-2'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 6l11 0" />
                                    <path d="M9 12l11 0" />
                                    <path d="M9 18l11 0" />
                                    <path d="M5 6l0 .01" />
                                    <path d="M5 12l0 .01" />
                                    <path d="M5 18l0 .01" />
                                </svg>
                                Voltar
                            </Button>
                        </div>
                    </div>
                    <!-- card-header -->

                    <div class="card-body px-6 py-4">
                        <Alert />

                        <div>
                            <h2 class="text-lg font-bold">Informações do cliente</h2>

                            <div class="md:flex items-center py-3 border-b border-slate-300">
                                <p class="w-1/6 font-bold">Nome :</p>
                                <p class="w-5/6">{{ Service.client.name }}</p>
                            </div>

                            <div class="md:flex items-center py-3 border-b border-slate-300">
                                <p class="w-1/6 font-bold">Telefone :</p>
                                <p class="w-5/6">{{ Service.client.phone }}</p>
                            </div>
                        </div>

                        <div>
                            <h2>Informações do serviço</h2>
                        </div>
                    </div>
                    <!-- card-body -->

                    <div class="card-footer px-6 pt-4 pb-6 border-t"></div>
                </div>
                <!-- card -->
            </div>
            <!-- page-body -->
        </div>

        <!-- page-content -->
    </WebLayout>
</template>
