<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import WebLayout from "@/Layouts/WebLayout.vue";
import BaseBreadcrumbs from "@/Components/BaseBreadcrumbs.vue";
import BaseAlert from "@/Components/BaseAlert.vue";
import SelectMultiple from "@/Components/Form/SelectMultiple.vue";
import { computed } from "vue";
import InputSimple from "@/Components/Form/InputSimple.vue";
import InputGroup from "@/Components/Form/InputGroup.vue";
import InputGroupItem from "@/Components/Form/InputGroupItem.vue";
import SelectSimple from "@/Components/Form/SelectSimple.vue";

const props = defineProps({
    Service: Object,
    ServiceStatus: Object,
    ServiceTypes: Object,
});

//:::::::::: BREADCRUMBS :::::::::://
const breadcrumbs = [
    {
        text: "Serviços",
        href: route("service.index"),
    },
    {
        text: "Editar",
    },
];

//:::::::::: PLUCK NAMES FROM SERVICE_TYPES :::::::::://
const pluckedServiceTypes = computed(() => {
    return props.ServiceTypes.reduce((acc, item) => {
        acc[item.id] = item.name;
        return acc;
    }, {});
});

//:::::::::::::::::::: FORM :::::::::::::::::::://

// FIELDS
const form = useForm({
    client_id: props.Service.client_id,
    name: props.Service.client.name,
    phone: props.Service.client.phone,
    service_items: [],
    value: props.Service.value,
    delivery_date: props.Service.delivery_date,
    status: props.Service.status,
});

props.Service.items.forEach((item) => {
    form.service_items.push({
        id: item.id,
        piece: item.piece,
        color: item.color,
        type: item.type,
        value: String(item.value),
    });
});

// UPDATE REQUEST
function update() {
    form.put(route("service.update", props.Service.id), {});
}

//:::::::::: SET SERVICE VALUE :::::::::://
const setServiceValue = (service_item)=> {
    service_item.value = 0;

    service_item.type.forEach((type)=> {
        service_item.value += props.ServiceTypes.find(service_type => service_type.name == type).value
    })
}

//:::::::::: SET TOTAL VALUE :::::::::://
const setTotalValue = () => {
    form.value = 0;

    form.service_items.forEach((item) => {
        form.value += parseInt(item.value.replace(/[^0-9]/g, ""));
    });
};

//:::::::::: CHECK CLIENT :::::::::://
const checkClient = async () => {
    if (form.phone.match(/^\(\d{2}\)\s\d{5}-\d{4}$/)) {
        try {
            const response = await fetch(route("client.get", form.phone));

            if (response.status == 200) {
                const data = await response.json();
                form.client_id = data.Client.id;
                form.name = data.Client.name;
            }

            if (response.status == 204) {
                form.client_id = null;
            }
        } catch (error) {
            console.error(error);
        }
    }
};

//:::::::::: ADD SERVICE ITEM :::::::::://
const addServiceItem = () => {
    form.service_items.push({ piece: "", color: "#000000", type: [], value: "" });
};

//:::::::::: REMOVE SERVICE ITEM :::::::::://
const removeServiceItem = (item) => {
    form.service_items.splice(item, 1);
    setTotalValue();
};

//:::::::::: GO BACK :::::::::://
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

            <div id="page-body">
                <div class="card bg-white border rounded-lg">
                    <div class="card-header flex justify-between px-6 pt-6 pb-4 border-b">
                        <div class="flex items-center gap-2">
                            <h1 class="text-2xl font-bold text-slate-800">Serviço #{{ Service.service }}</h1>
                            <!-- <span class="items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset" :class="ServiceStatus[Service.status]['badge']">{{ ServiceStatus[Service.status]["text"] }}</span> -->
                        </div>

                        <div>
                            <!-- [button] - GO BACK -->
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
                            <!-- [input] - PHONE -->
                            <InputSimple type="text" v-model="form.phone" label="Telefone:" id="phone" v-mask="'(##) #####-####'" placeholder="(##) #####-####" subText="Informe o DDD seguido do número" @keyup="checkClient()" required />

                            <!-- [input] - NAME -->
                            <InputSimple type="text" v-model="form.name" label="Nome:" id="name" placeholder="Informe o nome do cliente" required />

                            <!-- SERVICE -->
                            <div class="md:flex items-center my-6">
                                <label class="w-1/6 required">Serviços</label>
                                <div id="service-list" class="w-full md:w-5/6">
                                    <div v-for="(service_item, index) in form.service_items" :key="index" class="flex flex-wrap md:flex-nowrap gap-1 md:gap-4 my-4 md:my-2 p-2 md:p-0 bg-slate-100 md:bg-white">
                                        <div class="flex w-full md:w-5/12">
                                            <InputGroup>
                                                <!-- [input] - PIECE -->
                                                <InputGroupItem position="start" type="text" v-model="service_item.piece" class="w-5/6 md:w-11/12" placeholder="Informe a peça de roupa" required />
                                                
                                                <!-- [input] - COLOR -->
                                                <InputGroupItem position="end" type="color" v-model="service_item.color" class="w-1/6 md:w-1/12" required/>
                                            </InputGroup>

                                            <!-- [button - mobile] - REMOVE SERVICE ITEM -->
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
                                            <InputGroup>
                                                <!-- [select] - TYPE -->
                                                <div class="w-8/12">
                                                    <SelectMultiple v-model="service_item.type" :options="pluckedServiceTypes" :onChange="()=> {setServiceValue(service_item)}" placeholder="Selecione o tipo de serviço"
                                                    :classes="{
                                                        btnDropdown: 'rounded-s-md',
                                                        Dropdown: ''}"
                                                    />
                                                </div>

                                                <!-- [input] - VALUE -->
                                                <InputGroupItem position="end" type="text" v-model="service_item.value" class="w-4/12" v-mask="['R$ #,##', 'R$ ##,##', 'R$ ###,##']" @input="setTotalValue()" placeholder="R$ 00,00" required/>
                                            </InputGroup>
                                        </div>

                                        <!-- [button - desktop] - REMOVE SERVICE ITEM -->
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

                                    <!-- [button] - ADD SERVICE ITEM -->
                                    <BaseButton @click="addServiceItem()" :class="'px-3 py-3 w-full justify-center'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                    </BaseButton>
                                </div>
                            </div>

                            <!-- [input] - TOTAL VALUE -->
                            <InputSimple type="text" v-model="form.value" label="Valor total:" id="value" v-mask="['R$ #,##', 'R$ ##,##', 'R$ ###,##']" placeholder="R$ 00,00" required />

                            <!-- [input] - DELIVERY DATE -->
                            <InputSimple type="date" v-model="form.delivery_date" label="Data de entrega:" id="delivery_date"  required />

                            <!-- [select] - STATUS -->
                            <SelectSimple type="status" v-model="form.status" label="Status:" id="status" :options="ServiceStatus" :meta="{
                                object: true,
                                key: 'status',
                                value: 'status',
                                text: 'text',
                            }" required />
                        </form>
                    </div>
                    <!-- card-body -->

                    <div class="card-footer px-6 pt-4 pb-6 border-t">
                        <!-- [button] - SUBMIT -->
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
