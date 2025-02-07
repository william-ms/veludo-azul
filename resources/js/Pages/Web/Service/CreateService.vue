<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import BaseBreadcrumbs from "@/Components/BaseBreadcrumbs.vue";
import BaseAlert from "@/Components/BaseAlert.vue";

let breadcrumbs = [
    {
        text: "Serviços",
        href: route("service.index"),
    },
    {
        text: "Cadastrar",
    },
];

defineProps({
    ServiceTypes: Object,
});

const form = useForm({
    client_id: "",
    name: "",
    phone: "",
    service_items: [{ piece: "", color: "#000000", type: "", value: "" }],
    value: "",
    delivery_date: "",
});

function create() {
    form.post(route("service.store"), {
        onSuccess: () => {
            form.reset();
        },
    });
}

const setTotalValue = () => {
    form.value = 0;

    form.service_items.forEach((item) => {
        form.value += parseInt(item.value.replace(/[^0-9]/g, ""));
    });
};

const checkClient = async () => {
    if (form.phone.match(/^\(\d{2}\)\s\d{5}-\d{4}$/)) {
        try {
            const response = await fetch(route("client.get", form.phone));
            const data = await response.json();

            if (response.status == 200) {
                form.client_id = data.Client.id;
                form.name = data.Client.name;
            }
        } catch (error) {
            console.error(error);
        }
    }
};

const addServiceItem = () => {
    form.service_items.push({ piece: "", color: "#000000", type: "", value: "" });
};

const removeServiceItem = (item) => {
    form.service_items.splice(item, 1);
    setTotalValue();
};

const goBack = () => {
    return window.history.back();
};
</script>

<template>
    <WebLayout>
        <Head title="Cadastrar serviço" />

        <div id="page-content" class="px-5 lg:px-10 pt-8">
            <div id="page-header" class="p-1">
                <BaseBreadcrumbs :breadcrumbs="breadcrumbs" />
            </div>
            <!-- page-header -->

            <div id="page-body" class="">
                <div class="card bg-white border rounded-lg">
                    <div class="card-header flex justify-between px-6 pt-6 pb-4 border-b">
                        <h1 class="text-2xl font-bold text-slate-800">Cadastrar serviço</h1>

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

                        <form method="POST" @submit.prevent="create()" id="create-form">
                            <!-- [input] - TELEFONE -->
                            <div class="md:flex items-center my-6">
                                <label class="w-1/6 required">Telefone</label>
                                <div class="w-full md:w-5/6">
                                    <input type="text" v-model="form.phone" v-mask="'(##) #####-####'" @keyup="checkClient()" class="block w-full rounded-md border-slate-300 placeholder-slate-300" id="phone" name="phone" placeholder="(##) #####-####" required />
                                    <p class="ps-1 text-xs text-slate-500">Informe o DDD seguido do número</p>
                                </div>
                            </div>

                            <!-- [input] - NOME -->
                            <div class="md:flex items-center my-6">
                                <label class="w-1/6 required">Nome</label>
                                <input type="text" v-model="form.name" class="block w-full md:w-5/6 rounded-md border-slate-300 placeholder-slate-300" id="name" name="name" placeholder="Informe o nome do cliente" required />
                            </div>

                            <!-- [input] - SERVIÇO -->
                            <div class="md:flex items-center my-6">
                                <label class="w-1/6 required">Serviços</label>
                                <div id="service-list" class="w-full md:w-5/6">
                                    <div v-for="(service_item, index) in form.service_items" :key="index" class="flex flex-wrap md:flex-nowrap gap-2 md:gap-4 my-2">
                                        <div class="flex w-full md:w-5/12">
                                            <input type="text" v-model="service_item.piece" class="w-5/6 md:w-11/12 border-slate-300 placeholder-slate-300 rounded-s-md" name="piece[]" placeholder="Informe a peça de roupa" required />
                                            <input type="color" v-model="service_item.color" class="w-1/6 md:w-1/12 h-full border-slate-300 rounded-e-md" name="color[]" required />

                                            <div class="block md:hidden md:w-1/12 ms-2">
                                                <BaseButton :disabled="form.service_items.length < 2" @click="removeServiceItem(index)" color="danger" :class="'px-3 w-full h-full justify-center'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </BaseButton>
                                            </div>
                                        </div>

                                        <div class="flex w-full md:w-6/12">
                                            <select v-model="service_item.type" class="w-8/12 border-slate-300 rounded-s-md" name="type[]" @change="service_item.value = ServiceTypes[service_item.type]" required>
                                                <option value="">Selecione o tipo de serviço</option>
                                                <option v-for="(value, service) in ServiceTypes" :key="service" :value="service">{{ service }}</option>
                                            </select>

                                            <input type="text" v-model="service_item.value" v-mask="['R$ #,##', 'R$ ##,##', 'R$ ###,##']" @input="setTotalValue()" class="w-4/12 border-slate-300 placeholder-slate-300 rounded-e-md" name="value[]" placeholder="R$ 00,00" required />
                                        </div>

                                        <div class="hidden md:block md:w-1/12">
                                            <BaseButton :disabled="form.service_items.length < 2" @click="removeServiceItem(index)" color="danger" :class="'px-3 w-full h-full justify-center'">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </BaseButton>
                                        </div>
                                    </div>

                                    <BaseButton @click="addServiceItem()" :class="'px-3 py-3 w-full justify-center'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                    </BaseButton>
                                </div>
                            </div>

                            <!-- [input] - VALOR TOTAL -->
                            <div class="md:flex items-center my-6">
                                <label class="w-1/6 required">Valor total</label>
                                <input type="text" v-model="form.value" v-mask="['R$ #,##', 'R$ ##,##', 'R$ ###,##']" class="block w-full md:w-5/6 rounded-md border-slate-300 placeholder-slate-300" id="name" name="name" placeholder="R$ 00,00" required />
                            </div>

                            <!-- [input] - DATA DE ENTREGA -->
                            <div class="md:flex items-center my-6">
                                <label class="w-1/6 required">Data de entrega</label>
                                <input type="date" v-model="form.delivery_date" class="block w-full md:w-5/6 rounded-md border-slate-300 placeholder-slate-300" id="name" name="name" required />
                            </div>
                        </form>
                    </div>
                    <!-- card-body -->

                    <div class="card-footer px-6 pt-4 pb-6 border-t">
                        <BaseButton color="primary" btnType="submit" :class="'px-3 py-2'" form="create-form" :disabled="form.processing">
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
