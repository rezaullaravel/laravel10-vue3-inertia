<template>
    <FrontMaster>
    <Head>
        <title>User Dashboard</title>
    </Head>
    <div class="container all">
        <div class="row">
            <div class="col-sm-3">
                <ul class="list-group">
                <li class="list-group-item"><a href="" class="btn btn-info">My order</a></li>
                <li class="list-group-item"><a href="" class="btn btn-info">My profile</a></li>
                <li class="list-group-item"><Link href="/user/logout" class="btn btn-danger">Logout</Link></li>

                </ul>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Hello {{ $page.props.user.name }}! Welcome.</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
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

