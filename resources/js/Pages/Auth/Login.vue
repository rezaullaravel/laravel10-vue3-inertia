<template>
    <FrontMaster>
    <Head>
        <title>Login page</title>
    </Head>
    <div class="container-fluid all">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>User Login

                        </h4>
                    </div>
                    <div class="panel-body">
                        <div v-if="form.errors.message" class="alert alert-danger">
                            <p>{{ form.errors.message }}</p>
                        </div>
                        <form action="" @submit.prevent="submit">
                            <div class="form-group">
                              <label for="">Email <span class="text-danger">*</span></label>
                              <input id="email" name="email" type="email" class="form-control" v-model="form.email">
                              <div v-if="form.errors.email" class="text-danger">{{ form.errors.email }}</div>
                            </div>

                            <div class="form-group">
                                <label for="">Password<span class="text-danger">*</span></label>
                                <input name="password" id="password" type="password" class="form-control" v-model="form.password">
                                <div v-if="form.errors.password" class="text-danger">{{ form.errors.password }}</div>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-info" value="Login">
                            </div>
                        </form>

                        <p class="text-info">Have you not an account? Please <Link class="badge" href="/register">register</Link> here.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</FrontMaster>
</template>

<script setup>
import { useForm,Link } from '@inertiajs/vue3'
import { router,Head } from '@inertiajs/vue3'
import FrontMaster from '../Frontend/FrontMaster.vue';


const form = useForm({
  email: '',
  password: '',

})

 function submit()
   {
     form.post('/user-login')

    }




</script>

<style>
.all{
    background-color: #e5e3e97d;
    /* padding:13rem 0rem; */
    margin-top: 7px;
    margin-bottom: 5px;

}

</style>

