<template>
  <div id="app">
    <div class="cart">
      <router-link :to="{name: 'Fidelity'}">
            <b-button variant="primary"><i class="material-icons white-text">favorite</i></b-button>
      </router-link>
      <router-link :to="{name:'ShoppingCart'}">
            <b-button variant="primary"><i class="material-icons white-text">local_grocery_store</i>({{itemsInCart}})</b-button>
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
import { mapGetters } from 'vuex';

export default {

  name: 'App',
  components: {
    Navbar
  },
  computed: {
    itemsInCart(){
      let cart = this.$store.getters.cartVehicles;
      return cart.reduce((accum, item) => accum + item.quantity, 0)
    }
  }
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
