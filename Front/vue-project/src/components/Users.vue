<template>
  <div class="users">
    <button @click="getUsers">Get Users</button>
    <ul v-for="user in users" :key="user.id">
       <li> {{ user.name }} - {{ user.password }} </li> 
    </ul>
  </div>
</template>

<script>
import {HTTP} from '../http'
export default {
  name: 'Users',
  data () {
    return {
     users: ''
    }
  },
  methods: {
    getUsers: function () {
      HTTP.get('/users')
        .then(response => {
          this.users = response.data.data
          console.log(this.users)
        })
        .catch(e => {
          this.errors = e
        });
    },
    updateUsers: function () {
        HTTP.post('/users:id')
         .then(response => {
             this.users = response.data.data
         })
         .catch(e => {
             this.errors = e
         });
    }
  }
}
</script>

<style scoped>
.users {
  margin-top: 100px;
}
.error {
  color: red;
}
</style>