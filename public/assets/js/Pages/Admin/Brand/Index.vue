

<template>
    <Master>
        <Head>
            <title>Brand List</title>
        </Head>
        <section class="content pt-3">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <!--flash message-->
                        <div class="alert alert-success alert-dismissible" v-if="$page.props.flash.message">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong> {{ $page.props.flash.message }}
                        </div>
                        <!--flash message end-->
                        <div class="card">
                            <div class="card-header">
                                <h4>Brand List
                                    <Link href="/admin/brand/create" class="btn btn-info" style="float: right;">Add Brand</Link>
                                </h4>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Sl</th>
                                            <th>Brand Name</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                         <tr v-for="(brand,index) in brands.data" :key="brand.id" class="text-center">
                                           <td>{{ index+1 }}</td>
                                           <td>{{ brand.brand_name }}</td>
                                           <td>
                                             <img :src="'/upload/brand_images/'+brand.image" alt="" width="100">
                                           </td>
                                           <td>
                                             <Link :href="`/admin/edit/brand/${brand.id}`" class="btn btn-info">Edit</Link>
                                             <button @click.prevent="deleteBrand(brand.id)" class="btn btn-danger">Delete</button>
                                           </td>
                                        </tr>

                                    </tbody>
                                </table>
                              <!--pagination-->

                                    <div v-if="brands.data.length>1">
                                        <Pagination :links="brands.links"/>
                                    </div>


                                <!--pagination end-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
       </section>
    </Master>
</template>


<script setup>
    import Master  from '../Master.vue';
    import { Link,usePage,router,Head } from '@inertiajs/vue3'
    import Pagination  from '../../../components/Pagination.vue';


    defineProps({ brands: Object })//it comees from Brand controller

    //delete brand
    function deleteBrand(id){
        Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
            router.get('/admin/delete/brand/'+id)

        }
        });
    }//end function

</script>


