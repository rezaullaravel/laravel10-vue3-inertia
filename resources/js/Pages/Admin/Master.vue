<template>
    <div>
        <div class="wrapper">



<!-- Navbar -->
<Navbar/>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<Sidebar/>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <!-- Main content -->
  <slot></slot>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!---footer-->
<Footer></Footer>
<!---footer end-->


</div>
    </div>
</template>


<script setup>
import { Link } from '@inertiajs/vue3'
import Navbar from './body/Navbar.vue';
import Footer from './body/Footer.vue';
import Sidebar from './body/Sidebar.vue';
</script>
