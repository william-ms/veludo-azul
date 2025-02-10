<script setup>
import BaseAlert from '@/Components/BaseAlert.vue';
import CheckboxSimple from '@/Components/Form/InputCheckbox.vue';
import InputSimple from '@/Components/Form/InputSimple.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import logoLight from '@/../images/logo-light.png';
import LoginLink from '@/../../vendor/spatie/laravel-login-link/resources/js/login-link.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Login" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <div class="text-center pb-4">
            <div class="w-[240px] h-[240px] m-auto">
                <img :src="logoLight" class="w-full h-full"/>
            </div>
            <h1 class="font-bold text-2xl border-b-4 border-[#5272ff] inline">Faça seu login</h1>
        </div>

        <BaseAlert />

        <div class="flex justify-center">
        <LoginLink v-if="$page.props.environment === 'local'" label="Clique aqui para o login de teste" class="px-3 py-1 bg-gray-400 rounded-lg text-white" :redirect-url="route('home')" />

        </div>
        <form @submit.prevent="submit">
            <!-- [input] - EMAIL -->
            <div class="mt-4">
                <label for="email">E-mail:</label>
                <InputSimple type="email" v-model="form.email" id="email" :classes="{wrapper: 'my-1'}" required/>
            </div>

            <!-- [input] - PASSWORD -->
            <div class="mt-4">
                <label for="password">Senha:</label>
                <InputSimple type="password" v-model="form.password" id="password" :classes="{wrapper: 'my-1'}" autocomplete="new-password" required />
            </div>
            
            <!-- [input] - REMEMBER -->
            <CheckboxSimple label="Lembrar de mim" id="remember"/>
            
            <div class="mt-6">
                <!-- [button] - SUBMIT -->
                <BaseButton color="primary" btnType="submit" :class="'w-full justify-center px-3 py-2'" :disabled="form.processing">
                    <svg xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-login-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                        <path d="M3 12h13l-3 -3" />
                        <path d="M13 15l3 -3" />
                    </svg>
                    Entrar
                </BaseButton>

                <!-- [button] - FORGOT PASSWORD -->
                <Link v-if="canResetPassword" :href="route('password.request')" class="block mt-1 text-sm text-end text-gray-600 underline hover:text-[#5272ff] focus:outline-none">
                    Esqueceu sua senha?
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
