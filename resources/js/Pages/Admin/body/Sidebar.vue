<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <Link href="/admin/dashboard" class="nav-link" :class="{ 'active': isActive('/admin/dashboard') }">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Dashboard
            </p>
          </Link>

        </li>

        <!--category start--->
        <li class="nav-item">
          <Link href="/admin/category/list" class="nav-link" :class="{ 'active': isActive('/category/list') }">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Category
            </p>
          </Link>

        </li>
        <!--category end--->


        <!--brand start--->
        <li class="nav-item">
          <Link href="/admin/brand/list" class="nav-link" :class="{ 'active': isActive('/brand/list') }">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Brand
            </p>
          </Link>

        </li>
        <!--brand end--->

         <!--product start--->
         <li class="nav-item">
          <Link href="/admin/product/list" class="nav-link" :class="{ 'active': isActive('/product/list') }">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Product
            </p>
          </Link>

        </li>
        <!--product end--->

        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <Link href="/admin/logout" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </Link>
              </li>
            </ul>
          </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
</template>

<script setup>
import { Link,usePage } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import axios from 'axios';

const form = useForm({


})

//menu active
const page = usePage()
const isActive = (route) => {
  return page.url.startsWith(route)
}

// function logout() {
//   axios.post('/admin/logout').then(() => {
//     window.location.href = '/';
//   });
// }

</script>
