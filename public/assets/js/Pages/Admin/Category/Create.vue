

<template>
    <Master>
        <section class="content pt-3">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-header">
                                <h4>Category Create
                                    <Link href="/admin/category/list" class="btn btn-info" style="float: right;">Category List</Link>
                                </h4>
                            </div>

                            <div class="card-body">
                                <form action="" @submit.prevent="submit">
                                    <div class="form-group">
                                        <label>Category Name <span class="text-danger">*</span></label>
                                        <input type="text" v-model="form.category_name" class="form-control">
                                        <div v-if="form.errors.category_name" class="text-danger">{{ form.errors.category_name }}</div>
                                    </div>

                                    <div class="form-group text-right">
                                        <input type="submit" value="Create" class="btn btn-info">
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

const form = useForm({
  category_name: '',

})

function submit() {
   form.post('/admin/store/category')
}


</script>


