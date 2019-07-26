<template>
    <div>
        <h2>Dashboard</h2>
        <p>Lastame: {{ user.lastname }}</p>
        <p>Fisrtname: {{ user.firstname }}</p>
        <p>Email: {{ user.email }}</p>
        <p>Address: {{ user.address }}</p>
        <p>Phone: {{ user.phone }}</p>
        <p>Birthday: {{ user.birthday }}</p>
        <p>License driver: {{ user.license_driver }}</p>
        <p>Date of register: {{ user.register_date }}</p>
        <p><strong>Point: {{ user.point }}</strong></p>
    </div>
</template>

<script>
import axios from 'axios';
import router from '../router';

export default {

  name: 'Login',
  data () {
    return {
      user: []
    }
  },
  methods: {
    getUsers: function () {
      axios.get('/api/users')
        .then(response => {
          this.users = response.data.data;
          console.log(this.users)
        })
        .catch(e => {
          this.errors = e;
          router.push('/');
        })
    },
     showUser: function () {
      axios.get('/api/users/' + this.$route.params.id)
        .then(response => {
          this.user = response.data.data;
        })
        .catch(e => {
          this.errors = e;
        })
    }
  },
  created () {
    this.showUser()
  }
}
</script>
