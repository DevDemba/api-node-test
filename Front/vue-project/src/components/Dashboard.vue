<template>
    <div>
        <h2>Dashboard</h2>
        <p>Name: {{ user.firstname }}</p>
    </div>
</template>
<script>
import axios from 'axios'
import router from '../router'
export default {
  name: 'Login',
  props: ['login'],
  data () {
    return {
      user: {
        firstname: []
      }
    }
  },
  methods: {
    getUserData: function () {
      let self = this
      axios.get('/api/users')
        .then((response) => {
          localStorage.setItem('user', JSON.stringify(response.data.user))
          localStorage.setItem('jwt', response.data.token)
          console.log(response)
          self.$set(this, 'user', response.data.user)
        })
        .catch((errors) => {
          console.log(errors)
          router.push('/')
        })
    }
  },
  mounted () {
    this.getUserData()
  }
}
</script>
