

<template>
    <Master>
        <Head>
            <title>Product List</title>
        </Head>
        <section class="content pt-3">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-12">
                        <!--flash message-->
                        <div class="alert alert-success alert-dismissible" v-if="$page.props.flash.message">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong> {{ $page.props.flash.message }}
                        </div>
                        <!--flash message end-->
                        <div class="card">
                            <div class="card-header">
                                <h4>Product List
                                    <Link href="/admin/product/create" class="btn btn-info" style="float: right;">Add Product</Link>
                                </h4>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Sl</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Product Name</th>
                                            <th>Thumbnail</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                         <tr v-for="(product,index) in products.data" :key="product.id" class="text-center">
                                           <td>{{ index+1 }}</td>
                                           <td>{{ product.category.category_name }}</td>
                                           <td>{{ product.brand.brand_name }}</td>
                                           <td>{{ product.product_name }}</td>
                                           <td>
                                             <img :src="'/upload/product_thumbnail/'+product.thumbnail" alt="" width="100">
                                           </td>


                                           <td>{{ limitString(product.description,40) }}</td>
                                           <td>
                                             <span v-if="product.status==1">Active</span>
                                             <span v-else>De Active</span>
                                           </td>
                                           <td>
                                            <Link :href="`/admin/view/product/${product.id}`" class="btn btn-primary btn-sm m-2">View</Link>
                                             <Link :href="`/admin/edit/product/${product.id}`" class="btn btn-info btn-sm">Edit</Link>
                                             <button @click.prevent="deleteProduct(product.id)" class="btn btn-danger btn-sm">Delete</button>
                                           </td>
                                        </tr>

                                    </tbody>
                                </table>
                              <!--pagination-->

                                    <div v-if="products.data.length>1">
                                        <Pagination :links="products.links"/>
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

<style>
.preview_multi_img{
    display: inline-block;
    border: 1px solid rgb(229, 188, 188);

}
</style>


<script setup>
    import Master  from '../Master.vue';
    import { Link,usePage,router,Head } from '@inertiajs/vue3'
    import Pagination  from '../../../components/Pagination.vue';


    defineProps({ products: Object })//it comees from Product controller

    //short the product description
    function limitString(str, limit) {
      if (str.length > limit) {
        return str.substring(0, limit) + '...';
      }
      return str;
    }

    //delete product
    function deleteProduct(id){
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
            router.get('/admin/delete/product/'+id)

        }
        });
    }//end function

</script>


