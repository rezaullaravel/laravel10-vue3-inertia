

<template>
    <Master>
        <Head>
            <title>Brand Create</title>
        </Head>
        <section class="content pt-3">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-header">
                                <h4>Brand Create
                                    <Link href="/admin/brand/list" class="btn btn-info" style="float: right;">Brand List</Link>
                                </h4>
                            </div>

                            <div class="card-body">
                                <form action="" @submit.prevent="submit">
                                    <div class="form-group">
                                        <label>Brand Name <span class="text-danger">*</span></label>
                                        <input type="text" v-model="form.brand_name" class="form-control">
                                        <div v-if="form.errors.brand_name" class="text-danger">{{ form.errors.brand_name }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label>Image<span class="text-danger">*</span></label>
                                        <input type="file" @input="change" class="form-control"/>
                                        <!-- <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                        {{ form.progress.percentage }}%
                                        </progress> -->
                                        <div v-if="form.errors.image" class="text-danger">{{ form.errors.image }}</div>
                                        <img :src="form.imagePreview" alt="" width="100">

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
    import { Link,Head } from '@inertiajs/vue3'
    import { useForm } from '@inertiajs/vue3'

const form = useForm({
  brand_name: '',
  image:'',
  imagePreview:''

})

//preview image
function change(event){
   form.image = event.target.files[0];
   form.imagePreview = URL.createObjectURL(event.target.files[0]);
}

function submit() {
   form.post('/admin/store/brand')
}


</script>


