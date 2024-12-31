<script setup>
let props = defineProps({
    color: { type: String, default: "primary" },
});
</script>

<template>
    <div v-if="$page.props.flash.success">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p class="font-bold">Sucesso</p>
            <p>{{ $page.props.flash.success }}</p>
        </div>
    </div>

    <div v-if="Object.keys($page.props.errors).length > 0">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-octagon">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12.802 2.165l5.575 2.389c.48 .206 .863 .589 1.07 1.07l2.388 5.574c.22 .512 .22 1.092 0 1.604l-2.389 5.575c-.206 .48 -.589 .863 -1.07 1.07l-5.574 2.388c-.512 .22 -1.092 .22 -1.604 0l-5.575 -2.389a2.036 2.036 0 0 1 -1.07 -1.07l-2.388 -5.574a2.036 2.036 0 0 1 0 -1.604l2.389 -5.575c.206 -.48 .589 -.863 1.07 -1.07l5.574 -2.388a2.036 2.036 0 0 1 1.604 0z" />
                    <path d="M12 8v4" />
                    <path d="M12 16h.01" />
                </svg>
                <p class="text-lg font-bold">Oops! Algo deu errado</p>
            </div>

            <ul class="list-disc list-inside ps-1">
                <li v-for="error in $page.props.errors" v-bind:key="error">{{ error }}</li>
            </ul>
        </div>
    </div>
</template>
