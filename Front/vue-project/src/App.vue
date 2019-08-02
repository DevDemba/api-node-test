<template>
  <div id="app">
    <div class="cart">
      <router-link :to="{name:'ShoppingCart'}">
            <b-button variant="primary">ShoppingCart</b-button>
      </router-link>
    </div>
    <div>
      <img src="./assets/logo.png">
    </div>
    <Navbar/>
  </div>
</template>

<script>

import Navbar from '@/components/Navbar';

export default {

  name: 'App',
  components: {
    Navbar
  },
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 5px;
}
.cart{
  display: flex; 
  justify-content: flex-end; 
  margin: 15px;
}

</style>
