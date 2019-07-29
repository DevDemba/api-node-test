<template>
    <div class="login">
        <h1>Login</h1>
        <!--<b-form-input type="email"  v-model="email" placeholder="Email"  required autofocus/>
        <b-form-input type="password" v-model="password" placeholder="Password" required />
        <b-button type="button" @click="handleSubmit">Login</b-button>-->
       <form>
            <b-form-input type="email" id="email" v-model="email" placeholder="Email" required autofocus />
            <b-form-input type="password" id="password" v-model="password" placeholder="Password" required />
            <b-button type="submit" @click="login" >Login</b-button>
        </form>
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
            
            axios.post("/api/login", data)
            .then((response) => {
        
            let is_admin = response.data.user.is_admin;
            localStorage.setItem('user', JSON.stringify(response.data.user));
            localStorage.setItem('jwt', response.data.token);
          
              if (localStorage.getItem('jwt') != null) {
                this.$emit('loggedIn')
                alert("You are connected !")
                if (this.$route.params.nextUrl != null) {
                  this.$router.push(this.$route.params.nextUrl)
                } else {
                  if (is_admin == 1) {
                    router.push('/admin')
                  } else {
                    router.push('/dashboard')
                  }
                }
              }
            })
            .catch((errors) => {
                console.log("Cannot log in")
                alert("Error - Log in")
                //console.error(error.response)

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
