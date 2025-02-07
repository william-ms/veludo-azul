<script setup>
import { Head, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import WebLayout from "@/Layouts/WebLayout.vue";

let date = ref(new Date().toLocaleString("en-US", { timeZone: "America/New_York" }));

defineProps({
    Services: Object,
    ServiceStatus: Object,
});

watch(date, (value) => {
    router.get(
        route("home"),
        {
            date: value,
        },
        {
            preserveState: true,
        }
    );
});

const changeDay = () => {};
</script>

<template>
    <WebLayout>
        <Head title="Listar clientes" />

        <div id="page-content" class="px-5 lg:px-10 pt-8">
            <div id="page-header" class="p-1"></div>
            <!-- page-header -->

            <div id="page-body" class="">
                <div class="card bg-white border rounded-lg">
                    <div class="card-header flex justify-end px-6 pt-6 pb-4 border-b gap-1">
                        <!-- [button] - Calendário -->
                        <BaseButton :class="'px-3 py-2'" @click="$refs.myDateInput.showPicker()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h16" />
                                <path d="M7 14h.013" />
                                <path d="M10.01 14h.005" />
                                <path d="M13.01 14h.005" />
                                <path d="M16.015 14h.005" />
                                <path d="M13.015 17h.005" />
                                <path d="M7.01 17h.005" />
                                <path d="M10.01 17h.005" />
                            </svg>
                            <p class="hidden md:block">Alterar dia</p>
                        </BaseButton>
                        <input v-model="date" type="date" ref="myDateInput" @change="changeDay()" class="w-0 h-0 p-0 border-0" />

                        <!-- [button] - Cadastrar -->
                        <BaseButton btnType="link" :href="route('service.create')" :class="'px-3 py-2'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            <p class="hidden md:block">Novo serviço</p>
                        </BaseButton>
                    </div>
                    <!-- card-header -->

                    <div class="card-body px-6 py-4">
                        <div class="text-center">
                            <h2 class="text-xl font-bold">{{ new Date(date).toLocaleString("pt-BR", { timeZone: "UTC", day: "numeric", month: "numeric" }) }}</h2>
                            <h3 class="text-xl font-bold">{{ new Date(date).toLocaleString("pt-BR", { timeZone: "UTC", weekday: "long" }) }}</h3>
                        </div>

                        <table class="mt-6 min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="text-xs font-medium text-gray-500 uppercase">
                                    <th class="w-4/6 px-2 py-3 text-start">Nome</th>
                                    <th class="w-1/6 px-2 py-3 text-center">Status</th>
                                    <th class="w-1/6 px-2 py-3 text-center">Ações</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr v-for="Service in Services" :key="Service.id" class="hover:bg-gray-100">
                                    <!-- Nome do cliente -->
                                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                        {{ Service.client.name }}
                                    </td>

                                    <!-- Status do serviço -->
                                    <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-800 text-center">
                                        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset" :class="ServiceStatus[Service.status]['badge']">{{ ServiceStatus[Service.status]["text"] }}</span>
                                    </td>

                                    <!-- Ações -->
                                    <td class="flex justify-center gap-1 px-2 py-4">
                                        <!-- [button] - Editar serviço -->
                                        <BaseButton btnType="link" color="light_primary" :href="route('service.edit', Service.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                                <path d="M13.5 6.5l4 4" />
                                            </svg>
                                        </BaseButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- card-body -->
                </div>
                <!-- card -->
            </div>
            <!-- page-body -->
        </div>
        <!-- page-content -->
    </WebLayout>
</template>
