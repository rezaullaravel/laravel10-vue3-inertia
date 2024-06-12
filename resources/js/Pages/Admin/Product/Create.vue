

<template>
    <Master>
        <Head>
            <title>Product Create</title>
        </Head>
        <section class="content pt-3">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="card">
                            <div class="card-header">
                                <h4>Product Create
                                    <Link href="/product/list" class="btn btn-info" style="float: right;">Product List</Link>
                                </h4>
                            </div>

                            <div class="card-body">
                                <form action="" @submit.prevent="submit">
                                    <div class="row">
                                        <div class="col-sm-6">
                                           <div class="form-group">
                                            <label> Category<span class="text-danger">*</span> </label>
                                            <select v-model="form.category_id" id="" class="form-control">
                                                <option value="" selected disabled>Select One</option>
                                                <option :value="category.id" v-for="category in categories">{{ category.category_name }}</option>
                                            </select>

                                            <div v-if="form.errors.category_id" class="text-danger">{{ form.errors.category_id }}</div>
                                           </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label> Brand<span class="text-danger">*</span> </label>
                                            <select v-model="form.brand_id" id="" class="form-control">
                                                <option value="" selected disabled>Select One</option>
                                                <option :value="brand.id" v-for="brand in brands">{{ brand.brand_name }}</option>
                                            </select>
                                            <div v-if="form.errors.brand_id" class="text-danger">{{ form.errors.brand_id }}</div>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Name <span class="text-danger">*</span></label>
                                        <input type="text" v-model="form.product_name" class="form-control">
                                        <div v-if="form.errors.product_name" class="text-danger">{{ form.errors.product_name }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label>Thumbnail<span class="text-danger">*</span></label>
                                        <input type="file" @input="change" class="form-control"/>
                                        <!-- <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                        {{ form.progress.percentage }}%
                                        </progress> -->
                                        <div v-if="form.errors.thumbnail" class="text-danger">{{ form.errors.thumbnail }}</div>
                                        <!--preview product thumbnail-->
                                        <img :src="form.imagePreview" alt="" width="300" class="thumbnail" v-if="form.imagePreview">
                                        <!--preview product thumbnail-->

                                    </div>

                                    <div class="form-group">
                                        <label>Multiple Images<span class="text-danger">*</span></label>
                                        <input type="file" @input="changeTwo" class="form-control" multiple/>

                                        <div v-if="form.errors.images" class="text-danger">{{ form.errors.images }}</div>

                                        <!--preview multiple images-->
                                        <div v-for="(image,index) in form.multiImagePreview" class="preview_multi_img">
                                            <img :src="image" alt="" width="80" height="80">
                                        </div>
                                        <!--preview multiple images-->

                                    </div>

                                    <div class="form-group">
                                        <label>Price <span class="text-danger">*</span></label>
                                        <input type="text" v-model="form.price" class="form-control">
                                        <div v-if="form.errors.price" class="text-danger">{{ form.errors.price }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span></label>
                                        <textarea  v-model="form.description" class="form-control" rows="7"></textarea>
                                        <div v-if="form.errors.description" class="text-danger">{{ form.errors.description }}</div>
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

<style>
.preview_multi_img{
    display: inline-block;
    margin-top: 5px;
    margin-bottom: 5px;
    margin-left: 5px;
    border: 2px solid rgb(229, 188, 188);
    padding:3px;
}
.thumbnail{
    border: 2px solid rgb(229, 188, 188);
    padding:3px;
}
</style>


<script setup>
    import Master  from '../Master.vue';
    import { Link,Head } from '@inertiajs/vue3'
    import { useForm } from '@inertiajs/vue3'

    defineProps({
        categories:Object,
        brands:Object,//categories and brands comes from product controller
    });

const form = useForm({
    category_id:'',
    brand_id:'',
  product_name: '',
  price:'',
  description:'',
  thumbnail:'',
  imagePreview:null,
  images:[],
  multiImagePreview:[],

})

//preview thumbnail
function change(event){
   form.thumbnail = event.target.files[0];
   form.imagePreview = URL.createObjectURL(event.target.files[0]);
}

//preview multiple images
function changeTwo(event){
      form.images = Array.from(event.target.files);
      form.multiImagePreview = Array.from(event.target.files).map(file => URL.createObjectURL(file));
}

function submit() {
   form.post('/store/product')
}


</script>


