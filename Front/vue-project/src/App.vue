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
      <router-link :to="{ name:'RegisterVehicle' }"><b-button variant="primary">Register Vehicle</b-button></router-link>
      <router-link v-if="!authenticated" :to="{ name:'Register' }"><b-button variant="primary">Register</b-button></router-link>
      <router-link v-if="!authenticated" :to="{ name:'Login' }"><b-button variant="primary">Login</b-button></router-link>
      <router-link v-if="authenticated" to="/login" v-on:click.native="logout()" replace><b-button variant="danger" >Logout</b-button></router-link>
      <router-view @authenticated="setAuthenticated"/>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import router from './router';

export default {

  name: 'App',
  data() {
    return {
      authenticated: false
    }
  },
  methods: {
    logout() {
      axios
        .get('/api/logout')
        .then((response) => {
          localStorage.removeItem('user', response.data.user)
          localStorage.removeItem('jwt', response.data.token) 
          this.authenticated = false;
          router.push('/')
        })
    },
    setAuthenticated(status) {
      this.authenticated = status;
    }
  },
  beforeRouteUpdate() {
    // if(localStorage.getItem('jwt') !== null){
    //   this.localStorage = true;
    //   console.log('helllo')
    //     return localStorage;
    // }

    console.log(this.authenticated)
    if(!this.authenticated) {
          this.$router.replace({ name: "login" });
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
