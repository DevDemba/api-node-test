<template>
  <div class="register">
      <h1>Register</h1>
        <form>
            <input type="radio" v-model="gender" value="Male" checked required/> Male
            <input type="radio" v-model="gender" value="Female" required/> Female
            <b-form-input type="text" v-model="lastname" placeholder="Lastname" required />
            <b-form-input type="text" v-model="firstname" placeholder="Firstname" required />
            <b-form-input type="date" v-model="birthday" placeholder="Birthday" required />
            <b-form-input type="text" v-model="address" placeholder="Address" required />
            <b-form-input type="text" v-model="phone" placeholder="Phone" />
            <b-form-input type="text" v-model="license_driver" placeholder="License driver " />
            <b-form-input type="email" v-model="email" placeholder="Email" required />
            <b-form-input type="password" v-model="password" placeholder="Password" required />
            <b-form-input type="password" v-model="password_confirmation" placeholder="Password confirmation" required />
            <b-button type="submit" @click="handleSubmit">Register</b-button>
        </form>
        </div>
</template>

<script>
import axios from 'axios';

export default {

  name: 'Register',
  props: ['nextUrl'],
  data () {
    return {
      gender: '',
      lastname: '',
      firstname: '',
      birthday: '',
      address: '',
      phone: '',
      license_driver: '',
      email: '',
      password: '',
      password_confirmation: '',
      is_admin: null
    }
  },
  methods: {
    handleSubmit (e) {
      e.preventDefault()

      if (this.password === this.password_confirmation && this.password.length > 0) {
        let url = 'http://localhost:3000/api/register'

        let user = {
          gender: this.gender,
          lastname: this.lastname,
          firstname: this.firstname,
          birthday: this.birthday,
          address: this.address,
          phone: this.phone,
          license_driver: this.license_driver,
          email: this.email,
          password: this.password,
          is_admin: this.is_admin
        }

        if (this.is_admin != null || this.is_admin === 1) url = 'http://localhost:3000/api/register-admin'

        axios.post(url, user)
          .then((response) => {
            localStorage.setItem('user', JSON.stringify(response.data.user))
            localStorage.setItem('jwt', response.data.token)
            console.log(response.data.user)
            if (localStorage.getItem('jwt') != null) {
              this.$emit('loggedIn')
              if (this.$route.params.nextUrl != null) {
                this.$router.push(this.$route.params.nextUrl)
              } else {
                this.$router.push('/')
              }
            }
          })
          .catch(error => {
            console.error(error)
          })
      } else {
        this.password = ''
        this.passwordConfirm = ''

        return alert('Passwords do not match')
      }
    }
  }
}
</script>

<style scoped>
    .register {
        width: 500px;
        border: 1px solid #CCCCCC;
        background-color: #FFFFFF;
        margin: auto;
        margin-top: 30px;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    #app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
