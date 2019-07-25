<template>
  <div id="app">
    <div>
      <img src="./assets/logo.png">
    </div>
    <div>
      <router-link :to="{ name:'HelloWorld' }"><b-button variant="primary">Home</b-button></router-link>
      <router-link :to="{ name:'Users' }"><b-button variant="primary">Users</b-button></router-link>
      <router-link :to="{ name:'Dashboard'}"><b-button variant="primary">Dashboard</b-button></router-link>
      <router-link :to="{ name:'Offer'}"><b-button variant="primary">Offer</b-button></router-link>
      <router-link :to="{ name:'Login' }"><b-button variant="primary">Login</b-button></router-link>
      <router-link :to="{ name:'Register' }"><b-button variant="primary">Register</b-button></router-link>
      <router-link :to="{ name:'RegisterVehicle' }"><b-button variant="primary">Register Vehicle</b-button></router-link>

      <b-button variant="danger"><a href="#" v-on:click="logout">Logout</a></b-button>
      <router-view/>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import router from './router'

export default {

  name: 'App',
  methods: {
    logout: function (e) {
      axios
        .get('/api/logout')
        .then(() => {
     /*      localStorage.removeItem('user', response.data.user)
          localStorage.removeItem('jwt', response.data.token) */
          router.push('/')
        })
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

</style>
