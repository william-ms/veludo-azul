<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import WebLayout from "@/Layouts/WebLayout.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import Filter from "@/Components/Filter.vue";
import Alert from "@/Components/Alert.vue";
import Paginator from "@/Components/Paginator.vue";

let showFilter = ref(false);

let props = defineProps({
    Services: Object,
    ServiceStatus: Object,
});

let breadcrumbs = [
    {
        text: "Serviços",
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
        <Head title="Listar serviços" />

        <div id="page-content" class="px-5 lg:px-10 pt-8">
            <div id="page-header" class="p-1">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </div>
            <!-- page-header -->

            <div id="page-body" class="">
                <div class="card bg-white border rounded-lg">
                    <div class="card-header flex justify-between px-6 pt-6 pb-4 border-b">
                        <h1 class="text-2xl font-bold text-slate-800">Serviços</h1>

                        <div>
                            <Button btnType="link" :href="route('service.create')" :class="'px-3 py-2'">
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

                            <Button color="primary" :class="'px-3 py-2'" @click="showFilter = !showFilter">
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
                                    <th class="w-2/6 md:4/6 px-2 py-3 text-start">Nome</th>
                                    <th class="w-2/6 px-2 py-3 text-start hidden md:block">Telefone</th>
                                    <th class="w-1/6 px-2 py-3 text-center">Status</th>
                                    <th class="w-1/6 px-2 py-3 text-center">Ações</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="Service in Services.data" :key="Service.id" class="hover:bg-gray-100">
                                    <!-- Nome do cliente -->
                                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                        {{ Service.client.name }}
                                    </td>

                                    <!-- Telefone do cliente -->
                                    <td class="hidden md:block px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                        {{ Service.client.phone }}
                                    </td>

                                    <td class="px-2 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-800">
                                        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset" :class="ServiceStatus[Service.status]['badge']">{{ ServiceStatus[Service.status]["text"] }}</span>
                                    </td>

                                    <td class="flex justify-center gap-1 px-2 py-4">
                                        <!-- [button] - Editar serviço -->
                                        <Button btnType="link" color="light_primary" :href="route('service.edit', Service.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                <path d="M13.5 6.5l4 4" />
                                            </svg>
                                        </Button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex justify-between">
                            <div></div>

                            <Paginator :links="Services.links" />
                        </div>
                    </div>
                    <!-- card-body -->
                </div>
                <!-- card -->
            </div>
            <!-- page-body -->
        </div>
        <!-- page-content -->

        <Filter :showFilter="showFilter" @hideFilter="showFilter = !showFilter" :inputs="dataFilter" :route="route('service.index')" />
    </WebLayout>
</template>
