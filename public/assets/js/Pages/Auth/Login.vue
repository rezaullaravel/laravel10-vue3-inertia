<template>
    <div class="container all">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading btn-style">
                        <h4>User Login
                            <Link href="/" class="btn btn-info " style="float: right;">Home</Link>
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
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</template>

<script setup>
import { useForm,Link } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import axios from 'axios';

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
    padding:13rem 0rem;
    margin-top: 7px;

}
.btn-style{
    padding-bottom: 28px;
}
</style>

