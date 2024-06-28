<template>

    <FrontMaster :categories="categories" :brands="brands" :cart_products="cart_products">
        <Head>
            <title>checkout Page</title>
        </Head>

        <div class="container" style="margin-top: 50px;">

            <div class="row">
                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="" @submit.prevent="placeOrder">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Customer Name<span class="text-danger">*</span></label>
                                            <input type="text" v-model="form.customer_name" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Customer Phone<span class="text-danger">*</span></label>
                                            <input type="text" v-model="form.customer_phone" class="form-control" required>
                                        </div>
                                    </div>
                                </div><!--row-->

                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="">Customer Email<span class="text-danger">*</span></label>
                                            <input type="text" v-model="form.customer_email" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label>Shipping Address<span class="text-danger">*</span></label>
                                            <textarea type="text" v-model="form.shipping_address" class="form-control"  rows="5" required></textarea>
                                        </div>
                                    </div>
                                </div><!--row-->

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Payment Type<span class="text-danger">*</span></label>
                                            <label  class="radio-inline">
                                                <input type="radio"  name="payment_type" value="cash_on_delivery" v-model="form.payment_type" checked>Cash On Delivery</label>

                                            <label  class="radio-inline"><input type="radio" v-model="form.payment_type" value="amar_pay">Bkash/Nagad/Rocket</label>
                                        </div>
                                    </div>
                                </div><!--row-->

                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-info">Place Order</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p>Subtotal<strong style="float: right">{{ sum() }} TK.</strong></p>
                            <input type="hidden" name="" v-model="form.subtotal">
                            <input type="hidden" name="" v-model="form.total">

                            <p style="margin-top:5px;" v-if="sum()">Shipping Charge<strong style="float: right"> {{ state.localShippingCharge }} TK.</strong></p>
                            <p style="margin-top:5px;" v-else>Shipping Charge<strong style="float: right"> {{ 0}} TK.</strong></p>

                            <p style="margin-top:5px;" v-if="sum()">Total<strong style="float: right"> {{ sum() + state.localShippingCharge }} TK.</strong></p>
                            <p style="margin-top:5px;" v-else>Total<strong style="float: right"> {{ 0 }} TK.</strong></p>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </FrontMaster>
</template>

<script setup>
import FrontMaster from '../FrontMaster.vue';
import { Head,Link,router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import { computed, reactive } from 'vue';




const props = defineProps({
    cart_products:Object, //this is come from FrontHomeController
    brands:Object,
    categories:Object,
    customer:Object,


})


// Create a reactive state for localShippingCharge
const state = reactive({
    // localSubtotal: props.subtotal,
    // localTotal: props.total,
    localShippingCharge:100,
});

//calculate the total price
const productsArray =  computed(()=>Object.values(props.cart_products));// Convert the object to an array for iteration
function sum(){
      let total = 0;
        for (let product of productsArray.value) {
            total += product.price * product.quantity;
        }
  return total;
}


const form = useForm({
    customer_name:props.customer.name,
    customer_phone:'',
    customer_email:props.customer.email,
    shipping_address:'',
    payment_type:'cash_on_delivery',
    subtotal:sum(),
    total:sum() + state.localShippingCharge,


})



// function reset(){
//     // state.localSubtotal = 0;
//     // state.localTotal = 0;
//     state.localShippingCharge = 0;
// }
function placeOrder(){
    form.post('/place-order',{
        onSuccess:()=>{
            //reset();
            form.reset()
            Toast.fire({
            icon: "success",
            title: "Your order submitted successfully."
            });
        },
        onError:()=>{
            Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Oops...",
            text: "Your shopping cart is empty.Plase add product to cart and then you can place order.",
            });
        },
    })
}










</script>
