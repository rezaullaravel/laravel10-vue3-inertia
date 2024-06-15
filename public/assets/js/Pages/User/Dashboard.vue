<template>
    <div class="container pt-5">
        <div class="row">
            <div class="col-sm-8 offset-sm-3">

                    <div class="card">

                        <div class="card-body">
                            <h4>User Dashboard</h4>
                            <Link href="/user/logout" class="btn btn-danger">Logout</Link>
                        </div>
                    </div>

            </div>
        </div>
    </div>

</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>

