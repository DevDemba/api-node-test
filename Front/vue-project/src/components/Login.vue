<template>
    <div class="login">
        <h1>Login</h1>
       <!--<b-form-input type="text" name="username" v-model="input.username" placeholder="Username" />
        <b-form-input type="password" name="password" v-model="input.password" placeholder="Password" />
        <b-button type="button" v-on:click="login()">Login</b-button> -->
        <form v-on:submit="login">
            <b-form-input type="text" name="email" placeholder="Email" />    
            <b-form-input type="password" name="password" placeholder="Password" />    
            <b-button type="submit" value="login">Login</b-button>  
              
        </form>
    </div>
</template>

<script>
    import axios from "axios"  
    import router from "../router"    
    export default {    
        name: "Login",    
        methods: {    
            login: (e) => {    
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
            }    
        }    
    }
</script>

<!--<script>
export default {
  name: 'Login',
data() {
            return {
                input: {
                    username: "",
                    password: ""
                }
            }
        },
        methods: {
            login() {
                if(this.input.username != "" && this.input.password != "") {
                    if(this.input.username == this.$parent.mockAccount.username && this.input.password == this.$parent.mockAccount.password) {
                        this.$emit("authenticated", true);
                        this.$router.replace({ name: "secure" });
                    } else {
                        console.log("The username and / or password is incorrect");
                    }
                } else {
                    console.log("A username and password must be present");
                }
            }
        }
    }
</script> -->

<style scoped>
    .login {
        width: 500px;
        border: 1px solid #CCCCCC;
        background-color: #FFFFFF;
        margin: auto;
        margin-top: 20  px;
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

