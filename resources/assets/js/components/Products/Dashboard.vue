<template>
	<div class="row">
		<div class="col-md-12 justify-content-center">
			<h1>Products</h1>
		</div>
		<div class="col-md-4">
			<div class="list-group">
				<a v-for="product in products" href="#" class="list-group-item list-group-item-action" :key="product.id" @click.prevent="setActive(product)">
					{{ product.title }}
				</a>
			</div>
		</div>
		<div class="col-md-8">
			<div v-if="active" class="card">
				<h5 class="card-header">
					{{ active.title }}
					<button type="button" class="close" @click.prevent="clearActive" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</h5>
				<div class="card-body">
					<h5 class="card-title">Status: {{ active.availability ? 'Available' : 'Out of Stock' }}</h5>
					<p class="card-text">Price: {{ active.price }}</p>
					<p class="card-text">{{ active.description }}</p>
					<a href="#" class="btn btn-primary" @click.prevent="editProduct(active)">Edit</a>
					<a href="#" class="btn btn-danger" @click.prevent="deleteProduct(active)">Delete</a>
				</div>
			</div>
			<div class="clearfix"></div>

			<div class="card">
				<div class="card-header">Add Product</div>
				<div class="card-body">
					<form class="new-product">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="title">Title</label>
								<input type="text" class="form-control" id="title" placeholder="Title" v-model="newProduct.title">
							</div>
							<div class="form-group col-md-6">
								<label for="price">Price</label>
								<input type="text" class="form-control" id="price" placeholder="Price" v-model="newProduct.price">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								<label for="description">Description</label>
								<textarea class="form-control" name="description" id="description" v-model="newProduct.description"></textarea>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-12">
								In Stock: 
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="yes" name="availability" class="custom-control-input" value="1" v-model="newProduct.availability">
									<label class="custom-control-label" for="yes">Yes</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input type="radio" id="no" name="availability" class="custom-control-input" value="0" v-model="newProduct.availability">
									<label class="custom-control-label" for="no">No</label>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="card-footer">
					<button @click="saveProduct" type="submit" class="btn btn-primary">Save</button>
					<button @click="resetForm" type="submit" class="btn btn-info">Reset</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from 'axios'

export default {
	data(){
		return {
			products: [],
			active: null,
			newProduct: {},
			form: null
		}
	},
	methods:{
		fetchProducts(){
			axios({ 
				method: 'GET', 
				url: 'api/products', 
				headers: { Authorization: "Bearer " + localStorage.getItem('token') }, 
			})
			.then(res => this.products = res.data)
			.catch(error => console.log(error))
		},
		setActive(product){
			this.active = product
		},
		clearActive(){
			this.active = null
		},
		editProduct(product){
			this.newProduct = product
			this.newProduct.edit = true
			this.active = null
		},
		saveProduct(){
			let vm = this
			if (this.newProduct.edit) {
				console.log('Edit: saving to db')
				delete this.newProduct.edit
				axios({ 
					method: 'PUT', 
					url: 'api/products/' + this.newProduct.id, 
					headers: { Authorization: "Bearer " + localStorage.getItem('token') }, 
					data: this.newProduct
				})
				.then(res => {
					console.log(res)
					vm.newProduct = {}
					vm.form.reset()
					vm.fetchProducts()
				})
				.catch(error => console.log(error))
			} else {
				console.log('Store: saving to db')
				axios({ 
					method: 'POST', 
					url: 'api/products', 
					headers: { Authorization: "Bearer " + localStorage.getItem('token') }, 
					data: this.newProduct
				})
				.then(response => {
					console.log(response)
					vm.products.push(response.data)
					vm.newProduct = {}
					vm.form.reset()
					vm.fetchProducts()
				})
				.catch(error => console.log(error))
			}			
		},
		deleteProduct(product){
			let vm = this
			axios({ 
				method: 'DELETE', 
				url: 'api/products/' + product.id, 
				headers: { Authorization: "Bearer " + localStorage.getItem('token') }, 
			})
			.then(res => {
				console.log(res)
				vm.active = null
				vm.newProduct = {}
				vm.form.reset()
				vm.fetchProducts()
			})
			.catch(error => console.log(error))
		},
		resetForm(){
			this.newProduct = {}
			this.form.reset()
		}
	},
	mounted(){
		this.fetchProducts()
		this.form = document.querySelector('.new-product')
	}
}
</script>