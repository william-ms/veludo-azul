<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import WebLayout from "@/Layouts/WebLayout.vue";
import BaseBreadcrumbs from "@/Components/BaseBreadcrumbs.vue";
import BaseFilter from "@/Components/BaseFilter.vue";
import BaseAlert from "@/Components/BaseAlert.vue";
import BasePaginator from "@/Components/BasePaginator.vue";

let showFilter = ref(false);

defineProps({
    ServiceTypes: Object,
});

let breadcrumbs = [
    {
        text: "Tipos de serviço",
    },
];

let dataFilter = [
    {
        type: "text",
        label: "Nome",
        name: "f_name",
        placeholder: "Informe o nome do tipo de serviço",
    },
];

const formatter = new Intl.NumberFormat("pt-BR", {
  	style: "currency",
  	currency: "BRL",
  	minimumFractionDigits: 2
});


const formDelete = useForm({});

function destroy(service_type_id) {
    formDelete.delete(route("service.type.destroy", service_type_id), {});
}


</script>

<style scoped>
</style>

<template>
    <WebLayout>
        <Head title="Listar tipos de serviço" />

        <div id="page-content" class="px-5 lg:px-10 pt-8">
            <div id="page-header" class="p-1">
                <BaseBreadcrumbs :breadcrumbs="breadcrumbs" />
            </div>
            <!-- page-header -->

            <div id="page-body" class="">
                <div class="card bg-white border rounded-lg">
                    <div class="card-header flex justify-between px-6 pt-6 pb-4 border-b">
                        <h1 class="text-2xl font-bold text-slate-800">Tipo de serviços</h1>

                        <div>
							<!-- [button] - Cadastrar -->
                            <BaseButton btnType="link" :href="route('service.type.create')" :class="'px-3 py-2'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                Cadastrar
                            </BaseButton>
                        </div>
                    </div>
                    <!-- card-header -->

                    <div class="card-body px-6 py-4">
                        <BaseAlert />

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

                            <BaseButton color="primary" :class="'px-3 py-2'" @click="showFilter = !showFilter">
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

                        <table class="my-2 min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="text-xs font-medium text-gray-500 uppercase">
                                    <th class="w-3/6 px-2 py-3 text-start">Nome</th>
                                    <th class="w-4/6 px-2 py-3 text-start">Valor</th>
                                    <th class="w-1/6 px-2 py-3 text-center">Ações</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="ServiceType in ServiceTypes.data" :key="ServiceType.id" class="hover:bg-gray-100">
                                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ ServiceType.name }}</td>
                                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ formatter.format(ServiceType.value / 100)  }}</td>
                                    <td class="flex justify-center gap-1 px-2 py-4">
                                        <!-- [button] - Editar -->
                                        <BaseButton btnType="link" color="light_primary" :href="route('service.type.edit', ServiceType.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                <path d="M13.5 6.5l4 4" />
                                            </svg>
                                        </BaseButton>

                                        <!-- [button] - Deletar -->
                                        <BaseButton color="light_danger" @click="console.log(destroy(ServiceType.id))">
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </BaseButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex justify-between">
                            <div></div>

                            <BasePaginator :links="ServiceTypes.links" />
                        </div>
                    </div>
                    <!-- card-body -->
                </div>
                <!-- card -->
            </div>
            <!-- page-body -->
        </div>
        <!-- page-content -->

        <BaseFilter :showFilter="showFilter" @hideFilter="showFilter = !showFilter" :inputs="dataFilter" :route="route('service.type.index')" />
    </WebLayout>
</template>
