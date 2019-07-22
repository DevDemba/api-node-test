<template>
    <div class="login">
        <h1>Login</h1>
        <b-form-input type="email"  v-model="email" placeholder="Email" />
        <b-form-input type="password" v-model="password" placeholder="Password" />
        <b-button type="button" @click="handleSubmit">Login</b-button>
       <!--<form>
            <b-form-input type="email" id="email" v-model="email" required autofocus />
            <b-form-input type="password" id="password" v-model="password" required />
            <b-button type="submit" v-on:click="handleSubmit()">Login</b-button>
        </form>-->
    </div>
</template>

<script>
    import axios from "axios"  
    import router from "../router"    
    export default {    
        name: "Login",  
        props: ["nextUrl"],
        data() {
            return {
                email : "",
                password : ""
            }
        }, 
        methods: {    
            handleSubmit(e){
                e.preventDefault()
                if (this.password.length > 0) {
                  axios.post('http://localhost:3000/api/login', {
                        email: this.email,
                        password: this.password,
                    })
                    .then(response => {
                        let is_admin = response.data.user.is_admin
                        localStorage.setItem('user',JSON.stringify(response.data.user))
                        localStorage.setItem('jwt',response.data.token)

                        if (localStorage.getItem('jwt') != null){
                            this.$emit('loggedIn')
                            if(this.$route.params.nextUrl != null){
                                this.$router.push(this.$route.params.nextUrl)
                            }
                            else {
                                if(is_admin== 1){
                                    router.push('/admin')
                                }
                                else {
                                    router.push('/dashboard')
                                }
                            }
                        }
                    })
                    .catch(function (error) {
                        console.error(error.response);
                    });
                }

                
            }
        }    
    }


    /*login: (e) => {    
                e.preventDefault()    
                let email = e.target.elements.email.value
                let password = e.target.elements.password.value
                
                let login = () => {    
                    let data = {    
                        email: email,    
                        password: password,
                        errorMessage: {
                            type: String,
                            default: ""
                        }

                    }    
                    axios.post("/api/login", data)    
                        .then((response) => {    
                            console.log("Logged in")    
                            router.push("/dashboard")   
                            alert("You are connected !")  
                        })    
                        .catch((errors) => {    
                            console.log("Cannot log in") 
                            alert("Error - Log in")  


                        })    
                }    
                login()    
            }*/

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

