
<template>
  <div>
    <h2>Product List</h2>
    <select v-model="selectedCategory" @change="fetchFilteredProducts">
      <option value="">All Categories</option>
      <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
    </select>
    <button @click="sort('name')">Sort by Name</button>
    <button @click="sort('price')">Sort by Price</button>
    <ul>
      <li v-for="product in products" :key="product.id">
        {{ product.name }} - {{ product.price }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      categories: [],
      selectedCategory: '',
    };
  },
  mounted() {
    this.fetchProducts();
    this.fetchCategories();
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await axios.get('/api/products');
        this.products = response.data.products;
      } catch (error) {
        console.error(error);
      }
    },
    async fetchCategories() {
      try {
        const response = await axios.get('/api/categories');
        this.categories = response.data.categories;
      } catch (error) {
        console.error(error);
      }
    },
    async fetchFilteredProducts() {
      try {
        const response = await axios.get(`/api/products/filter/${this.selectedCategory}`);
        this.products = response.data.products;
      } catch (error) {
        console.error(error);
      }
    },
    async sort(by) {
      try {
        const response = await axios.get(`/api/products/sort/${by}`);
        this.products = response.data.products;
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
