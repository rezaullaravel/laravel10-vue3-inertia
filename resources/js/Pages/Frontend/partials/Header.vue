<template>
    <div class="header">
			<div class="header-top">
				<div class="container">
					 <div class="top-left">
						<a href="#"> Help  <i class="glyphicon glyphicon-phone" aria-hidden="true"></i> +0123-456-789</a>
					</div>
					<div class="top-right">
					<ul>
						<span v-if="$page.props.user.name">
                            <span v-if="$page.props.user.role=='1'">
                                <li><a href="/admin/dashboard">Admin Dashboard</a></li>
                            </span>
                            <span v-else>
                                <li><Link href="/user/dashboard">User Dashboard</Link></li>
                            </span>

                        </span>

                        <span v-else><li><Link href="/login"> Login/Register </Link></li></span>
                        <!-- <li v-else><Link :href="route('user.login')">Login</Link></li> -->
					</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="heder-bottom">
				<div class="container">
					<div class="logo-nav">
						<div class="logo-nav-left">
							<h1><Link href="/">My Shop <span>Shop anywhere</span></Link></h1>
						</div>
						<div class="logo-nav-left1">
							<nav class="navbar navbar-default">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header nav_2">
								<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
								<ul class="nav navbar-nav">
									<li class="active">
                                        <Link :href="route('home')" class="act">Home</Link>:</li>
									<!-- categories start -->
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="col-sm-12  multi-gd-img">
													<ul class="multi-column-dropdown" style="display: inline;">
														<h6>All Categories</h6>

														<li v-for="category in categories"><Link :href="route('cateWiseProduct',category.id)">{{ category.category_name }}</Link></li>

													</ul>
												</div>
												<div class="clearfix"></div>
											</div>
										</ul>
									</li>
                                    <!--categories end-->

									<!--brands start-->
                                    <li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Brands<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="col-sm-12  multi-gd-img">
													<ul class="multi-column-dropdown" style="display: inline;">
														<h6>All Brands</h6>

														<li v-for="brand in brands"><Link :href="route('brand-wise-product',brand.id)" style="border: 1px solid #c4b7b7; text-align: center; padding:3px;"> <img :src="'/upload/brand_images/'+brand.image" alt="Brand_image" width="30" height="30" > {{ brand.brand_name }}</Link></li>

													</ul>
												</div>
												<div class="clearfix"></div>
											</div>
										</ul>
									</li>
									<!--brands end-->
								</ul>
							</div>
							</nav>
						</div>
						<div class="logo-nav-right">
							<ul class="cd-header-buttons">
								<li><a class="cd-search-trigger" href="#cd-search"> <span></span></a></li>
							</ul> <!-- cd-header-buttons -->
							<div id="cd-search" class="cd-search">
								<form action="#" method="post">
									<input name="Search" type="search" placeholder="Search...">
								</form>
							</div>
						</div>
						<div class="header-right2">
							<div class="cart box_1" v-if="$page.props.user.name">
								<Link :href="route('view.cart')">
									<h3> <div class="total">
										 (<span id="simpleCart_quantity">{{cart_products.length}}</span> items)</div>
										<img src="/frontend/images/bag.png" alt="" />
									</h3>
								</Link>:
								<!-- <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p> -->
								<div class="clearfix"> </div>
							</div>

							<div class="cart box_1" v-else>
								<Link :href="route('view.cart')">
									<h3> 
										<img src="/frontend/images/bag.png" alt="" />
									</h3>
								</Link>:
								<!-- <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p> -->
								<div class="clearfix"> </div>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    categories:Object,
    brands:Object,
    cart_products:Object,
})

</script>

<style scoped>
.multi-column-dropdown li {
    display: inline-block;
    padding: 0px 15px;
    list-style-type: none;
    margin: 7px 0;
}
</style>
