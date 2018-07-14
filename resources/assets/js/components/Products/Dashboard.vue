<template>
	<h1>Products</h1>
</template>

<script>
import axios from 'axios'

export default {
	data(){
		return {
			products: []
		}
	},
	mounted(){
		axios('/api/products')
		.then(res => console.log(res.data))
		.catch(error => console.log(error))
	}
}
</script>