<template>


	<!--header-->
     <Header :categories="categories" :brands="brands" :cart_products="cart_products"></Header>
	<!--header-->
		<!--banner-->

		<!--banner-->

		<!--content-->
        <slot></slot>
		<!--content-->

		<!---footer--->
        <Footer></Footer>
		<!---footer--->



</template>

<script setup>
import Banner from './partials/Banner.vue';
import Header from './partials/Header.vue';
import Footer from './partials/Footer.vue';
import {Link} from '@inertiajs/vue3';

defineProps({
    categories:Object,//from different partial component
    brands:Object,//from different partial component
    cart_products:Object,
})
</script>
