<template>
    <div class="container pt-5">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header">
                        <h4>User Login</h4>
                    </div>
                    <div class="card-body">
                        <div v-if="form.errors.message" class="text-danger">
                            <h4>{{ form.errors.message }}</h4>
                        </div>
                        <form action="" @submit.prevent="submit">
                            <div class="form-group">
                              <label for="">Email</label>
                              <input id="email" name="email" type="email" class="form-control" v-model="form.email">
                              <div v-if="form.errors.email" class="text-danger">{{ form.errors.email }}</div>
                            </div>

                            <div class="form-group">
                                <label for="">Password</label>
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
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'

const form = useForm({
  email: '',
  password: '',

})

const submit = () => {
      form.post('/user-login');
    };




</script>

