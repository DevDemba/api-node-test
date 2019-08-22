<template>
    <div class="login">
        <h1>Login</h1>
       <b-form-group>
            <b-form-input type="email" id="email" v-model="email" placeholder="Email" required autofocus />
            <b-form-input type="password" id="password" v-model="password" placeholder="Password" required />
            <b-button type="submit" @click="login" >Login</b-button>
        </b-form-group>
    </div>
</template>

<script>

import axios from 'axios';
import router from '../router';

export default {

  name: 'Login',
  data () {
      return {
            email: '',
            password:''
      }
  },
  methods: {
    login (e) {
        e.preventDefault()
            let data = {
                email: this.email,
                password: this.password
            };
            this.$store.dispatch('login', data)
            .then( response => {
              let is_admin = response.data.user[0].is_admin;
              //console.log(is_admin)
              if (localStorage.getItem('token') != null) {
                //this.$emit('loggedIn');
                this.$emit("authenticated", true);
                this.$swal({
                          position: 'center',
                          type: 'success',
                          title: 'You are authenticated',
                          showConfirmButton: false,
                          timer: 2000
                });
                if (this.$route.params.nextUrl != null) {
                  this.$router.push(this.$route.params.nextUrl)
                } else {
                    if (is_admin == 1) {
                      this.$router.push('/admin');
                    } else {
                      this.$router.push('/dashboard');
                    }
                }
              }
            })
            .catch((error) => {
                console.error(error.response);
                this.email = '';
                this.password = '';
                this.$swal({
                    position: 'center',
                    type: 'warning',
                    title: 'login or password not matches',
                    showConfirmButton: false,
                    timer: 1500
                });

            })  
      }
           
  }

} 

</script>

<style scoped>
    .login {
        width: 500px;
        border: 1px solid #CCCCCC;
        background-color: #FFFFFF;
        margin: auto;
        margin-top: 30px;
        padding: 20px;
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
