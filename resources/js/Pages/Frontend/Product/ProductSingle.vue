

<template>
    <FrontMaster :categories="categories" :brands="brands" :cart_products="cart_products">
        <Head>
            <title>Product Single</title>
        </Head>
        <div class="content">
			<!--single-->
			<div class="single-wl3">
				<div class="container">
					<div class="single-grids">
						<div class="col-md-9 single-grid">
							<div clas="single-top">
								<div class="single-left">
									<div class="flexslider">
										<ul class="slides">
											<li>
												<div  class="thumb-image">
                                                    <img :src="'/upload/product_thumbnail/'+product.thumbnail" data-imagezoom="true" class="img-responsive">
                                                </div>
											</li>

										 </ul>
									</div>
								</div>
								<div class="single-right simpleCart_shelfItem">
									<h4>{{ product.product_name }}</h4>
									<div class="block">
										<div class="starbox small ghosting"> </div>
									</div>
									<p class="price item_price">{{ product.price }} TK.</p>
									<div class="description">
										<p><span>Quick Overview : </span> {{ product.description }} </p>
									</div>
									<div class="color-quality">
										<h6>Quality :</h6>
											<div class="quantity">
												<div class="quantity-select">
													<div class="entry value-minus1" @click="decrement">&nbsp;</div>
													<div class="entry value1">
                                                        <span>{{ quantity }}</span>
                                                        <input type="hidden"  v-model="form.quantity">
                                                    </div>
													<div class="entry value-plus1 active" @click.prevent="increment">&nbsp;</div>
												</div>
											</div>
									</div>
									<div class="women">
										<button @click.prevent="addToCart(product.id)" data-text="Add To Cart" class="my-cart-b item_add">Add To Cart</button>
									</div>
								</div>
								<div class="clearfix"> </div>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>

				</div>
			</div>
			<!--single-->
		</div>
    </FrontMaster>
</template>

<script setup>
import { ref,watch } from 'vue';
import FrontMaster from '../FrontMaster.vue';
import { useForm } from '@inertiajs/vue3'


defineProps({
    product:Object, //this is come from FrontHomeController
    categories:Object,//from FrontHomeController
    brands:Object,//from FrontHomeController
    cart_products:Object
})

// Define reactive state
const quantity = ref(1);

const form = useForm({
  quantity: quantity.value,

})
// Watch the quantity ref and update form.quantity accordingly
watch(quantity, (newQuantity) => {
  form.quantity = newQuantity;
});

function increment() {
  quantity.value++;
}


function decrement() {
  if (quantity.value > 1) {
    quantity.value--;
  }
}
function addToCart(id){

	form.post('/add-to-cart/'+id,{
        onSuccess:()=>{
            Toast.fire({
            icon: "success",
            title: "Product added to cart successfully"
            });

        },
        onError:()=>{
            Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Oops...",
            text: "This product is already exists in cart.",
            });
        },
        preserveScroll: true,//keep scroll position
    })
}
</script>




