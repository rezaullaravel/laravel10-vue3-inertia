<template>

    <FrontMaster :categories="categories" :brands="brands" :cart_products="cart_products">
        <Head>
            <title>Cart Product</title>
        </Head>
        <div class="new-arrivals-w3agile">
					<div class="container">

                        <div class="row">
                            <div class="col-sm-12" v-if="cart_products.length>0">
                                <h2 class="tittle"> Cart Products</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th class="text-center">Sl</th>
                                        <th>Product</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center"> Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="(product,index) in cart_products" :key="product.id">
                                            <td>{{ index+1 }}</td>
                                            <td class="col-sm-8 col-md-6">
                                                <div class="media">
                                                    <a class="thumbnail pull-left" href="javascript:void(0)"> <img class="media-object" :src="'/upload/product_thumbnail/'+product.thumbnail" style="width: 72px; height: 72px;"> </a>
                                                    <div class="media-body">
                                                        <h4 class="media-heading"><a href="#">{{ product.product_name }}</a></h4>
                                                        <h5 class="media-heading"> by <a href="#">{{ product.brand_name }}</a></h5>
                                                        <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="col-sm-2 col-md-2 text-center">
                                                <button @click.prevent="decreaseQuantity(product)">_</button>
                                                <strong style="padding:3px 6px; border:1px solid;">{{ product.quantity }}</strong>
                                                   <button @click.prevent="increaseQuantity(product.id)">+</button>
                                            </td>
                                            <td class="col-sm-1 col-md-1 text-center"><strong>{{ product.price*product.quantity }} TK.</strong></td>
                                            <td class="col-sm-1 col-md-1">
                                            <button type="button" class="btn btn-danger" @click.prevent="deleteCartProduct(product.id)">
                                                <span class="glyphicon glyphicon-remove">

                                                </span> Remove
                                            </button></td>
                                        </tr>

                                        <tr>

                                            <td>   </td>
                                            <td>   </td>
                                            <td><h5>Subtotal</h5></td>
                                            <td class="text-right"><h5><strong>{{sum()}} TK.</strong></h5></td>
                                        </tr>
                                        <tr>

                                            <td>   </td>
                                            <td>   </td>
                                            <td><h5>Estimated shipping</h5></td>
                                            <td class="text-right"><h5><strong>100 TK.</strong></h5></td>
                                        </tr>
                                        <tr>

                                            <td>   </td>
                                            <td>   </td>
                                            <td><h3>Total</h3></td>
                                            <td class="text-right"><h3><strong>{{sum()+100}} </strong></h3></td>
                                        </tr>
                                        <tr>

                                            <td>   </td>
                                            <td>   </td>
                                            <td>
                                            <button type="button" class="btn btn-danger" @click.prevent="clearCart">
                                                 Clear Cart
                                            </button></td>
                                            <td>
                                            <button @click.prevent="checkout" type="button" class="btn btn-success">
                                                Checkout <span class="glyphicon glyphicon-play"></span>
                                            </button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-sm-12" v-else>
                                <h4 class="text-danger">Your cart is empty.....</h4>
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
import {computed} from 'vue';

const props = defineProps({
    cart_products:Object, //this is come from FrontHomeController
    brands:Object,
    categories:Object,

})

const form = useForm({
       subtotal:0,
       total:0,

})




//increase cart product quantity
function increaseQuantity(id){
    form.post('/increase-product-quantity/'+id,{
        preserveScroll: true,//keep scroll position
    })
}//end function

//decrease cart product quantity
function decreaseQuantity(product){
    if(product.quantity>1){
        form.post('/decrease-product-quantity/'+product.id,{
        preserveScroll: true,//keep scroll position
    })
    }

}//end function

//calculate the total price
const productsArray =  computed(()=>Object.values(props.cart_products));// Convert the object to an array for iteration
function sum(){
      let total = 0;
        for (let product of productsArray.value) {
            total += product.price * product.quantity;
        }
  return total;
}

//delete cart single product
function deleteCartProduct(id){
    form.get('/delete-cart-single-product/'+id,{
        preserveScroll: true,//keep scroll position
    })
}

//clear cart
function clearCart(){
   form.get('/clear-cart')
}

// Checkout function
function checkout() {
    const subtotal = sum();
    const total = subtotal + 100;

    form.subtotal=subtotal;
    form.total=total

    form.get('/checkout');
}
</script>
