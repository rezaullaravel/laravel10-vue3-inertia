

<template>
    <Master>
        <Head>
            <title>Product Details</title>
        </Head>
        <section class="content pt-3">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4>Product Details
                                    <Link href="/admin/product/list" class="btn btn-info" style="float: right;">Product List</Link>
                                </h4>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                   <tbody>
                                     <tr>
                                        <th width="30%" style="text-align: center;"> Product Name</th>
                                        <td>{{ product.product_name }}</td>
                                     </tr>

                                     <tr>
                                        <th width="30%" style="text-align: center;"> Category</th>
                                        <td>{{ product.category.category_name }}</td>
                                     </tr>

                                     <tr>
                                        <th width="30%" style="text-align: center;"> Brand</th>
                                        <td>{{ product.brand.brand_name }}</td>
                                     </tr>

                                     <tr>
                                        <th width="30%" style="text-align: center;"> Thumbnail</th>
                                        <td>
                                            <img :src="'/upload/product_thumbnail/'+product.thumbnail" alt="" width="300" height="300">
                                        </td>
                                     </tr>


                                     <tr>
                                        <th width="30%" style="text-align: center;"> Multiple Images</th>
                                        <td>
                                            <div v-for="image in product.multi_images" class="preview_multi_img">
                                                <img :src="'/upload/product_multi_images/'+image.image" alt="" width="100" height="100">
                                            </div>
                                        </td>
                                     </tr>

                                     <tr>
                                        <th width="30%" style="text-align: center;"> Price</th>
                                        <td>{{ product.price }} TK.</td>
                                     </tr>

                                     <tr>
                                        <th width="30%" style="text-align: center;"> Desctiption</th>
                                        <td>{{ product.description }}</td>
                                     </tr>

                                     <tr>
                                        <th width="30%" style="text-align: center;"> Status</th>
                                        <td>
                                            <span v-if="product.status==1">Active</span>
                                            <span v-else>De Active</span>
                                        </td>
                                     </tr>
                                   </tbody>


                                </table>
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
    import { Link,Head } from '@inertiajs/vue3'


    defineProps({ product: Object })//it comees from Product controller


</script>


