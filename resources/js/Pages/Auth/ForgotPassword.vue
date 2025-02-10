<script setup>
import BaseAlert from '@/Components/BaseAlert.vue';
import InputSimple from '@/Components/Form/InputSimple.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import logoLight from '@/../images/logo-light.png';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Esqueci a senha" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <div class="text-center pb-7">
            <div class="w-[240px] h-[240px] m-auto">
                <img :src="logoLight" class="w-full h-full"/>
            </div>
            <h1 class="font-bold text-2xl border-b-4 border-[#5272ff] inline">Esqueceu sua senha?</h1>
        </div>

        <BaseAlert />

        <div class="mb-4 text-sm text-gray-600">
            <p>Sem problemas. Basta nos informar seu endereço de e-mail e enviaremos a você um link de redefinição de senha que permitirá a você escolher uma nova.</p>
        </div>

        <form @submit.prevent="submit">
            <!-- [input] - EMAIL -->
            <div class="mt-4">
                <label for="email">E-mail:</label>
                <InputSimple type="email" v-model="form.email" id="email" :classes="{wrapper: 'my-1'}" required/>
            </div>
                            
            <div class="mt-6">
                <!-- [button] - SUBMIT -->
                <BaseButton color="primary" btnType="submit" :class="'w-full justify-center px-3 py-2'" :disabled="form.processing">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-send-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4.698 4.034l16.302 7.966l-16.302 7.966a.503 .503 0 0 1 -.546 -.124a.555 .555 0 0 1 -.12 -.568l2.468 -7.274l-2.468 -7.274a.555 .555 0 0 1 .12 -.568a.503 .503 0 0 1 .546 -.124z" /><path d="M6.5 12h14.5" /></svg>
                    Enviar link
                </BaseButton>

                <!-- [button] - BACK TO LOGIN -->
                <Link :href="route('login')" class="flex items-center mt-2 text-sm text-gray-600 underline hover:text-[#5272ff] focus:outline-none">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14l-4 -4l4 -4" /><path d="M5 10h11a4 4 0 1 1 0 8h-1" /></svg>
                    Voltar para o login
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
