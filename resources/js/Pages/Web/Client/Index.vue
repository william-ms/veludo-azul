<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import WebLayout from "@/Layouts/WebLayout.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import Filter from "@/Components/Filter.vue";
import Alert from "@/Components/Alert.vue";
import Paginator from "@/Components/Paginator.vue";

let showFilter = ref(false);

let props = defineProps({
    Clients: Object,
});

let breadcrumbs = [
    {
        text: "Clientes",
    },
];

let dataFilter = [
    {
        type: "text",
        label: "Nome",
        name: "f_name",
        placeholder: "Informe o nome do cliente",
    },
    {
        type: "text",
        label: "Telefone",
        name: "f_phone",
        placeholder: "Informe o telefone do cliente",
        mask: "(##) #####-####",
    },
];
</script>

<style scoped>
</style>

<template>
    <WebLayout>
        <Head title="Listar clientes" />

        <div id="page-content" class="px-5 lg:px-10 pt-8">
            <div id="page-header" class="p-1">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </div>
            <!-- page-header -->

            <div id="page-body" class="">
                <div class="card bg-white border rounded-lg">
                    <div class="card-header flex justify-between px-6 pt-6 pb-4 border-b">
                        <h1 class="text-2xl font-bold text-slate-800">Clientes</h1>

                        <div>
                            <Button btnType="link" :href="route('client.create')" v-bind:class="'px-3 py-2'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Cadastrar
                            </Button>
                        </div>
                    </div>
                    <!-- card-header -->

                    <div class="card-body px-6 py-4">
                        <Alert />

                        <div class="flex justify-between">
                            <div>
                                <span>Exibir</span>
                                <select class="mx-1 py-1 pe-8 rounded text-sm">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span>resultados por página</span>
                            </div>

                            <Button color="primary" v-bind:class="'px-3 py-2'" @click="showFilter = !showFilter">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list-search">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 15m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                    <path d="M18.5 18.5l2.5 2.5" />
                                    <path d="M4 6h16" />
                                    <path d="M4 12h4" />
                                    <path d="M4 18h4" />
                                </svg>
                                Filtrar
                            </Button>
                        </div>

                        <table class="my-2 min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="text-xs font-medium text-gray-500 uppercase">
                                    <th class="w-3/6 px-2 py-3 text-start">Nome</th>
                                    <th class="w-4/6 px-2 py-3 text-start">Telefone</th>
                                    <th class="w-1/6 px-2 py-3 text-center">Ações</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="Client in Clients.data" :key="Client.id" class="hover:bg-gray-100">
                                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ Client.name }}</td>
                                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ Client.phone }}</td>
                                    <td class="flex justify-center gap-1 px-2 py-4">
                                        <Button btnType="link" color="light_primary" :href="route('client.show', Client.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                            </svg>
                                        </Button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex justify-between">
                            <div></div>

                            <Paginator :links="Clients.links" />
                        </div>
                    </div>
                    <!-- card-body -->
                </div>
                <!-- card -->
            </div>
            <!-- page-body -->
        </div>
        <!-- page-content -->

        <Filter :showFilter="showFilter" @hideFilter="showFilter = !showFilter" :inputs="dataFilter" :route="route('client.index')" />
    </WebLayout>
</template>
