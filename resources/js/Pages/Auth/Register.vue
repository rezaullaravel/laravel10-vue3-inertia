<template>
    <FrontMaster>
    <Head>
        <title>Registration page</title>
    </Head>
    <div class="container-fluid all">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">

                <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p style="font-size: 15px;">
                    <strong>Congratulations!</strong> {{ $page.props.flash.message }} <Link class="badge" href="/login">here</Link>.
                </p>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>User Registration

                        </h4>
                    </div>
                    <div class="panel-body">
                        <div v-if="form.errors.message" class="alert alert-danger">
                            <p>{{ form.errors.message }}</p>
                        </div>
                        <form action="" @submit.prevent="register">
                            <div class="form-group">
                              <label for="">Name <span class="text-danger">*</span></label>
                              <input id="name" name="name" type="text" class="form-control" v-model="form.name">
                              <div v-if="form.errors.name" class="text-danger">{{ form.errors.name }}</div>
                            </div>

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
                                <label for="">Confirm password<span class="text-danger">*</span></label>
                                <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" v-model="form.password_confirmation">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-info" value="Register">
                            </div>
                        </form>

                        <p class="text-info">Already Have  an account? Please <Link class="badge" href="/login">login</Link> here.</p>
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
  name:'',
  email: '',
  password: '',
  password_confirmation:'',


})

 function register()
   {
     form.post('/user-registration',{
  preserveScroll: true,
  onSuccess: () => form.reset(),
})

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

