<template>
  <div class="users">
    <b-button @click="getUsers">Get Users</b-button><br>
    <b-list-group v-for="user in users" :key="user.id">
       <b-list-group-item  style="width: 400px;display:flex; justify-content: space-between;" variant="info">
          <span>{{user.id}} - {{ user.lastname }}  {{ user.firstname }}</span>
        </b-list-group-item>
    </b-list-group>
  </div>
</template>

<script>
import axios from 'axios';

export default {

  name: 'Users',
  data () {
    return {
      id: '',
      users: ''
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
        })
    },
    updateUser: function () {
      axios.put('/api/user')
        .then(response => {
          this.users = response.data.data;
        })
        .catch(e => {
          this.errors = e;
        })
    },
     deleteUser: function () {
      axios.delete('/api/user')
        .then(response => {
          this.users = response.data.data;
        })
        .catch(e => {
          this.errors = e;
        })
    }
  }
}
</script>

<style scoped>
.users {
  margin-top: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
b-button{
  margin: 5px auto;
}
.error {
  color: red;
}
</style>
