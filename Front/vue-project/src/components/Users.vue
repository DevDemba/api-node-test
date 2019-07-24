<template>
  <div class="users">
    <b-button @click="getUsers">Get Users</b-button><br>
    <b-list-group v-for="user in users" :key="user.id">
       <b-list-group-item  style="width: 300px;" variant="info"> {{ user.lastname }} - {{ user.firstname }} </b-list-group-item>
    </b-list-group>
  </div>
</template>

<script>

import axios from 'axios'
export default {
  name: 'Users',
  data () {
    return {
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
    updateUsers: function () {
      axios.post('/api/user:id')
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
.error {
  color: red;
}
</style>
