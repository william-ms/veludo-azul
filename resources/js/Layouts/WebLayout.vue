<script setup>
import { ref } from "vue";
import Navbar from "@/Partials/Web/Navbar.vue";

let showNavbar = ref(false);
</script>

<template>
    <div class="flex flex-col h-screen justify-between">
        <Navbar :showNavbar="showNavbar" @hideNavbar="showNavbar = !showNavbar" />

        <!-- HEADER -->
        <header class="px-3 lg:px-8 py-4">
            <Button @click="showNavbar = !showNavbar" color="transparent">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </Button>
        </header>

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
