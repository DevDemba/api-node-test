<template>
  <div class="register">
      <h1>Register</h1>
        <form>

            <input type="radio" name="gender" value="Male" checked/> Male
            <input type="radio" name="gender" value="Female"/> Female
            <b-form-input type="text" name="lastname" placeholder="Lastname" />    
            <b-form-input type="text" name="firstname" placeholder="Firstname" />    
            <b-form-input type="date" name="birthday" placeholder="Birthday" />    
            <b-form-input type="text" name="address" placeholder="Address" />    
            <b-form-input type="text" name="phone" placeholder="Phone" />    
            <b-form-input type="text" name="license_driver" placeholder="License driver " />    
            <b-form-input type="text" name="email" placeholder="Email" />    
            <b-form-input type="password" name="password" v-model="password" placeholder="Password" required />  
            <b-form-input type="password" name="password_confirmation" v_model="password_confirmation" placeholder="Password confirmation" required />  

            <div>
                <select v-model="is_admin">
                    <option value=1>Yes</option>
                    <option value=0>No</option>
                </select>
            </div> 
            <b-button type="submit" @click="handleSubmit">Register</b-button>  
              
        </form>  
        </div>
</template>

<script>
import axios from "axios"
import router from "../router" 

export default {

  name: 'Register',
        props : ["nextUrl"],
        data(){
            return {
                gender: "",
                lastname : "",
                firstname: "",
                birthday: "",
                address:"",
                phone:"",
                license_driver:"",
                email : "",
                password : "",
                password_confirmation : "",
               is_admin : null
            }
        },
        methods : {
            handleSubmit(e) {
                e.preventDefault()

                if (this.password === this.password_confirmation && this.password.length > 0)
                {
                    let url = "http://localhost:3000/api/register"
                    if(this.is_admin != null || this.is_admin == 1) url = "http://localhost:3000/api/register-admin"
                    
                    axios.post(url, {
                        gender: this.gender,
                        lastname: this.lastname,
                        firstname: this.firstname,
                        birthday: this.birthday,
                        address: this.address,
                        phone: this.phone,
                        license_driver: this.license_driver,
                        email: this.email,
                        password: this.password,
                    })
                    .then(response => {
                        localStorage.setItem('user',JSON.stringify(response.data.user))
                        localStorage.setItem('jwt',response.data.token)

                        if (localStorage.getItem('jwt') != null){
                            this.$emit('loggedIn')
                            if(this.$route.params.nextUrl != null){
                                this.$router.push(this.$route.params.nextUrl)
                            }
                            else{
                                this.$router.push('/')
                            }
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
                } else {
                    this.password = ""
                    this.password_confirmation = ""

                    return alert("Passwords do not match")
                }
                
            }
        }
    }

/*data() {
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
    }*/
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

