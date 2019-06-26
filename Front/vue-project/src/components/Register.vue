<template>
  <div class="register">
      <h1>Register</h1>
        <form v-on:submit="login">

            <input type="radio" name="gender" value="Male" checked/> Male
            <input type="radio" name="gender" value="Female"/> Female
            <b-form-input type="text" name="lastname" placeholder="Lastname" />    
            <b-form-input type="text" name="firstname" placeholder="Firstname" />    
            <b-form-input type="date" name="birthday" placeholder="Birthday" />    
            <b-form-input type="text" name="address" placeholder="Address" />    
            <b-form-input type="text" name="phone" placeholder="Phone" />    
            <b-form-input type="text" name="license_driver" placeholder="License driver " />    
            <b-form-input type="text" name="address" placeholder="Address" />    
            <b-form-input type="text" name="email" placeholder="Email" />    
            <b-form-input type="password" name="password" placeholder="Password" />   
            <b-button type="submit" value="login">Login</b-button>  
              
        </form>  </div>
</template>

<script>
export default {
  name: 'Register',
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

