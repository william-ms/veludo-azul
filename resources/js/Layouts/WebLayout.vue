<script setup>
import { onMounted, ref, watch } from "vue";
import Navbar from "@/Partials/Web/NavbarWeb.vue";

let showNavbar = ref(false);
let cronAlert = ref(true);

onMounted(() => {
    const storedCronAlert = sessionStorage.getItem("cronAlert");
    if (storedCronAlert !== null) {
        cronAlert.value = storedCronAlert === "true";
    }
});

watch(cronAlert, (newValue) => {
    sessionStorage.setItem("cronAlert", newValue);
});
</script>

<template>
    <div class="flex flex-col h-screen justify-between">
        <Navbar :showNavbar="showNavbar" @hideNavbar="showNavbar = !showNavbar" />

        <!-- HEADER -->
        <header class="px-3 lg:px-8 py-4">
            <BaseButton @click="showNavbar = !showNavbar" color="transparent">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </BaseButton>
        </header>

        <div v-if="$page.props.environment === 'local'" v-show="cronAlert" class="flex items-center gap-2 mx-5 lg:mx-10 p-5 text-white rounded-lg bg-yellow-500/70 border border-yellow-400">
            <svg xmlns="http://www.w3.org/2000/svg"  width="40"  height="40"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-info-triangle">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                <path d="M12 9h.01" />
                <path d="M11 12h1v4h1" />
            </svg>

            <div class="w-full">
                <p class="">O sistema está configurado para atualizar o banco de dados a cada 12 horas.</p>
                <p class="">Com isso, tenha em mente que toda a alteração realizada nesse perído será removida.</p>
            </div>

            <button type="button" @click="cronAlert = !cronAlert">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Page Content -->
        <main class="mb-auto">
            <slot />
        </main>

        <footer class="flex items-center justify-center py-6 gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-heart text-[#5272ff]">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z" />
            </svg>
            <h2 class="text-sm">Veludo Azul</h2>
        </footer>
    </div>
</template>
