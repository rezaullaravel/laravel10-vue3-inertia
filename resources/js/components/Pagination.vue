<template>

     <nav style="text-align: center;">
        <Link v-for="link in links" :key="link.label" :href="link.url ?? ''"  v-html="link.label" class="text-secondary p-1" style="font-size: 20px;" :class=" {'active-style':link.active,'text-danger':!link.url}"></Link>
     </nav>

</template>


<script setup>
 import { Link } from '@inertiajs/vue3'

 defineProps({
  links:Array
})

</script>

<style>
.active-style {
    background-color: #18c3c8;
    padding: 0px 6px !important;
    border-radius: 10px;
}
</style>

