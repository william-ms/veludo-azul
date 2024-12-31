<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import Alert from "@/Components/Alert.vue";

let props = defineProps({
    Client: Object,
});

let breadcrumbs = [
    {
        text: "Clientes",
        href: route("client.index"),
    },
    {
        text: props.Client.name,
    },
];

const form = useForm({
    name: props.Client.name,
    phone: props.Client.phone,
});

function edit() {
    form.put(route("client.update", props.Client.id));
}
</script>

<style scoped>
</style>

<template>
    <WebLayout>
        <Head :title="Client.name" />

        <div id="page-content" class="px-5 lg:px-10 pt-8">
            <div id="page-header" class="p-1">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </div>
            <!-- page-header -->

            <div id="page-body" class="">
                <div class="card bg-white border rounded-lg">
                    <div class="card-header flex justify-between px-6 pt-6 pb-4 border-b">
                        <h1 class="text-2xl font-bold text-slate-800">{{ Client.name }}</h1>

                        <div>
                            <Button btnType="link" :href="route('client.index')" v-bind:class="'px-3 py-2'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 6l11 0" />
                                    <path d="M9 12l11 0" />
                                    <path d="M9 18l11 0" />
                                    <path d="M5 6l0 .01" />
                                    <path d="M5 12l0 .01" />
                                    <path d="M5 18l0 .01" />
                                </svg>
                                Listar clientes
                            </Button>
                        </div>
                    </div>
                    <!-- card-header -->

                    <div class="card-body px-6 py-4">
                        <Alert />

                        <form method="POST" @submit.prevent="edit()" id="edit-form">
                            <!-- [input] - NOME -->
                            <div class="flex items-center my-6">
                                <label class="w-1/6 required">Nome</label>
                                <input v-model="form.name" class="block w-5/6 rounded-md border-slate-300 placeholder-slate-300" id="name" name="name" placeholder="Informe o nome do cliente" required />
                            </div>

                            <!-- [input] - TELEFONE -->
                            <div class="flex items-center my-6">
                                <label class="w-1/6 required">Telefone</label>
                                <div class="w-5/6">
                                    <input v-model="form.phone" v-mask="'(##) #####-####'" class="block w-full rounded-md border-slate-300 placeholder-slate-300" id="phone" name="phone" placeholder="Informe o telefone do cliente" required />
                                    <p class="ps-1 text-xs text-slate-500">Informe o DDD seguido do número</p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- card-body -->

                    <div class="card-footer px-6 pt-4 pb-6 border-t">
                        <Button color="primary" btnType="submit" v-bind:class="'px-3 py-2'" form="edit-form" :disabled="form.processing">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 12l5 5l10 -10" />
                                <path d="M2 12l5 5m5 -5l5 -5" />
                            </svg>
                            Salvar
                        </Button>
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
