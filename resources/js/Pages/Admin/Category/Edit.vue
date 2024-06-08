

<template>
    <Master>
        <section class="content pt-3">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-header">
                                <h4>Category Edit
                                    <Link href="/category/list" class="btn btn-info" style="float: right;">Category List</Link>
                                </h4>
                            </div>

                            <div class="card-body">
                                <form action="" @submit.prevent="update(category.id)">
                                    <div class="form-group">
                                        <label>Category Name <span class="text-danger">*</span></label>
                                        <input type="text" v-model="form.category_name" class="form-control">
                                        <div v-if="form.errors.category_name" class="text-danger">{{ form.errors.category_name }}</div>
                                    </div>

                                    <div class="form-group text-right">
                                        <input type="submit" value="Update" class="btn btn-info">
                                    </div>
                                </form>
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
    import { Link } from '@inertiajs/vue3'
    import { useForm } from '@inertiajs/vue3'

    const props = defineProps({
        errors:Object,
        category:Object,//this category comes from CategoryController
    })

const form = useForm({
  category_name: props.category.category_name,

})

function update(id) {
   form.post('/update/category/'+id)
}


</script>


