<template>
    <div>
      <router-link :to="{ name:'HelloWorld' }"><b-button variant="primary">Home</b-button></router-link>
      <router-link :to="{ name:'Users' }"><b-button variant="primary">Users</b-button></router-link>
      <router-link :to="{ name:'Dashboard'}"><b-button variant="primary">Dashboard</b-button></router-link>
      <router-link :to="{ name:'Admin'}"><b-button variant="primary">Admin</b-button></router-link>
      <router-link :to="{ name:'Offer'}"><b-button variant="primary">Offer</b-button></router-link>
      <router-link :to="{ name:'RegisterVehicle' }"><b-button variant="primary">Add Vehicle</b-button></router-link>
      <router-link v-if="!authenticated" :to="{ name:'Register' }"><b-button variant="primary">Register</b-button></router-link>
      <router-link v-if="!authenticated" :to="{ name:'Login' }"><b-button variant="primary">Login</b-button></router-link>
      <b-button v-if="authenticated" @click="logout" variant="danger">Logout</b-button>
      <router-view/>
    </div>
</template>

<script>

import axios from 'axios';
import router from '../router';

export default {
  name: 'Navbar',
  computed: {
    authenticated: function() { return this.$store.getters.authenticated },
    admin: function() { return this.$store.getters.admin }
  },
  methods: {
    logout: function () {
      this.$store.dispatch('logout')
      .then(() => {
        this.$router.push('/')
        this.$swal({
          position: 'center',
          type: 'success',
          title: 'You are not authenticated',
          showConfirmButton: false,
          timer: 2000
      });
      })
    }
  }

}
</script>
