<template>

    <FrontMaster :categories="categories">
        <Head>
            <title>Category Product</title>
        </Head>
        <div class="new-arrivals-w3agile">
					<div class="container">
						<h2 class="tittle">{{ category.category_name }} Category Products</h2>
						<div class="arrivals-grids">

							<div v-if="products.length>0" v-for="product in products" :key="product.id"  class="col-md-3 arrival-grid simpleCart_shelfItem">
								<div class="grid-arr">
									<div  class="grid-arrival">
										<figure>
											<Link :href="route('product.single',product.id)" class="new-gri" data-toggle="modal" data-target="#myModal1">
												<div class="grid-img">
													<img  :src="'/upload/product_thumbnail/'+product.thumbnail" class="" alt="" height="200" max-width="200">
												</div>
											</Link>
										</figure>
									</div>
									<div class="block">
										<div class="starbox small ghosting"> </div>
									</div>
									<div class="women">
										<h6><Link :href="route('product.single',product.id)">{{ product.product_name }}</Link></h6>

										<p >{{ product.price }} TK.</p>
										<a href="#" @click.prevent="addToCart(product.id)"  data-text="Add To Cart" class="my-cart-b item_add">Add To Cart</a>
									</div>
								</div>
							</div>

                            <div v-else>
                                <h3 class="text-danger"> No Result Found....</h3>
                            </div>

							<div class="clearfix"></div>
						</div>
					</div>
		</div>
    </FrontMaster>
</template>

<script setup>
import FrontMaster from '../FrontMaster.vue';
import { Head,Link,router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'

defineProps({
    products:Object, //this is come from FrontHomeController
    category:Object,//this is come from FrontHomeController
    categories:Object,

})

const form = useForm({


})

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
}//end function
</script>
