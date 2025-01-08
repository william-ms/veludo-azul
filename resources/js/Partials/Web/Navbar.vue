<script setup>
import { Link } from "@inertiajs/vue3";
import Logo from "../../../images/logo.png";

let props = defineProps({
    showNavbar: { type: Boolean, default: false },
});
</script>

<template>
    <div v-show="showNavbar">
        <div class="absolute top-0 left-0 w-full h-full bg-slate-950/50" @click="$emit('hideNavbar')"></div>

        <div id="navbar" class="w-full sm:w-80 h-screen p-2 absolute bg-white border-r border-slate-400">
            <div id="navbar-header" class="flex justify-between items-center gap-x-4">
                <div id="navbar-logo" class="flex justify-center items-center h-14 w-full bg-[#5272ff]">
                    <img class="h-full" :src="Logo" />
                </div>

                <div id="navbar-btn-close" class="flex items-center">
                    <Button @click="$emit('hideNavbar')" color="transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                    </Button>
                </div>
            </div>

            <nav class="py-2">
                <ul>
                    <li class="py-1 text-sm">Navegação</li>

                    <li>
                        <ul>
                            <li class="px-3 py-2 rounded-lg hover:bg-gray-200">
                                <Link :href="route('home')" class="flex items-center gap-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                    </svg>
                                    Início
                                </Link>
                            </li>

                            <li class="px-3 py-2 rounded-lg hover:bg-gray-200">
                                <Link :href="route('service.index')" class="flex items-center gap-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
                                        <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                                    </svg>
                                    Serviços
                                </Link>
                            </li>

                            <li class="px-3 py-2 rounded-lg hover:bg-gray-200">
                                <Link :href="route('client.index')" class="flex items-center gap-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                    Clientes
                                </Link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
