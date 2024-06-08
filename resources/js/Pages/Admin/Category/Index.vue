

<template>
    <Master>
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
                                <h4>Category List
                                    <Link href="/category/create" class="btn btn-info" style="float: right;">Add Category</Link>
                                </h4>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Sl</th>
                                            <th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                         <tr v-for="(category,index) in categories.data" :key="category.id" class="text-center">
                                           <td>{{ index+1 }}</td>
                                           <td>{{ category.category_name }}</td>
                                           <td>
                                             <Link class="btn btn-info">Edit</Link>
                                             <Link class="btn btn-danger">Delete</Link>
                                           </td>
                                        </tr>

                                    </tbody>
                                </table>
                              <!--pagination-->

                                    <Pagination :links="categories.links"/>
                                     

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
    import { Link,usePage } from '@inertiajs/vue3'
    import Pagination  from '../../../components/Pagination.vue';

    defineProps({ categories: Object })

</script>


