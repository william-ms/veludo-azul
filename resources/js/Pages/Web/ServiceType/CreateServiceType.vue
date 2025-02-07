<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import Alert from "@/Components/Alert.vue";

let breadcrumbs = [
    {
        text: "Tipos de serviço",
        href: route("service.type.index"),
    },
    {
        text: "Cadastrar",
    },
];

const form = useForm({
    name: "",
    value: "",
});

function create() {
    form.post(route("service.type.store"), {
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>

<style scoped>
</style>

<template>
    <WebLayout>
        <Head title="Cadastrar tipo de serviço" />

        <div id="page-content" class="px-5 lg:px-10 pt-8">
            <div id="page-header" class="p-1">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </div>
            <!-- page-header -->

            <div id="page-body" class="">
                <div class="card bg-white border rounded-lg">
                    <div class="card-header flex justify-between px-6 pt-6 pb-4 border-b">
                        <h1 class="text-2xl font-bold text-slate-800">Cadastrar tipo de serviço</h1>

                        <div>
                            <Button btnType="link" :href="route('service.type.index')" :class="'px-3 py-2'">
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
                            </Button>
                        </div>
                    </div>
                    <!-- card-header -->

                    <div class="card-body px-6 py-4">
                        <Alert />

                        <form method="POST" @submit.prevent="create()" id="create-form">
                            <!-- [input] - NOME -->
                            <div class="flex items-center my-6">
                                <label class="w-1/6 required">Nome</label>
                                <div class="w-full md:w-5/6">
                                    <input v-model="form.name" id="name" name="name" class="block w-full rounded-md border-slate-300 placeholder-slate-300" placeholder="Informe o nome do tipo de serviço" required />
                                    <p class="ps-1 text-xs text-slate-500">ex: Bainha, Apertar cintura, etc.</p>
                                </div>
                            </div>

                            <!-- [input] - VALOR -->
                            <div class="md:flex items-center my-6">
                                <label class="w-1/6 required">Valor</label>
                                <input v-model="form.value" type="text" v-mask="['R$ #,##', 'R$ ##,##', 'R$ ###,##']" class="block w-full md:w-5/6 rounded-md border-slate-300 placeholder-slate-300" id="name" name="name" placeholder="R$ 00,00" required />
                            </div>
                        </form>
                    </div>
                    <!-- card-body -->

                    <div class="card-footer px-6 pt-4 pb-6 border-t">
                        <Button color="primary" btnType="submit" :class="'px-3 py-2'" form="create-form" :disabled="form.processing">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checks">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 12l5 5l10 -10" />
                                <path d="M2 12l5 5m5 -5l5 -5" />
                            </svg>
                            Enviar
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
