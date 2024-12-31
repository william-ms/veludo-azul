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
                                <Link href="" class="flex items-center gap-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                    Serviços
                                </Link>
                            </li>

                            <li class="px-3 py-2 rounded-lg hover:bg-gray-200">
                                <Link :href="route('client.index')" class="flex items-center gap-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
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
