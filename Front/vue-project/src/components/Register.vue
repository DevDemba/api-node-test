<!--
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
</template> -->

<template>
    <div>
        <h4>Register</h4>
        <form>
            <label for="gender">Gender</label>
            <div>
                <input id="gender" type="radio" v-model="gender" value="Male" checked /> Male
                <input id= "gender" type="radio" v-model="gender" value="Female" checked /> Female
            </div>

            <label for="lastname" >Lastname </label>
            <div>
                <input id="lastname" type="text" v-model="lastname" required>
            </div>

            <label for="firstname" > Firstname </label>
            <div>
                <input id="firstname" type="text" v-model="firstname" required>
            </div>

            <label for="birthday" >Birthday</label>
            <div>
                <input id="birthday" type="date" v-model="birthday" required>
            </div>

            <label for="address" >Address</label>
            <div>
                <input id="address" type="text" v-model="address" required>
            </div>

            <label for="phone" >Phone</label>
            <div>
                <input id="phone" type="text" v-model="phone" required>
            </div>

            <label for="license_driver" >License driver</label>
            <div>
                <input id="license_driver" type="text" v-model="license_driver" required>
            </div>
            
            <label for="email" >E-Mail Address</label>
            <div>
                <input id="email" type="email" v-model="email" required>
            </div>

            <label for="password">Password</label>
            <div>
                <input id="password" type="password" v-model="password" required>
            </div>

            <label for="password-confirm">Confirm Password</label>
            <div>
                <input id="password-confirm" type="password" v-model="password_confirmation" required>
            </div>

            <!--
            <label for="password-confirm">Is this an administrator account?</label>
            <div>
                <select v-model="is_admin">
                    <option value=1>Yes</option>
                    <option value=0>No</option>
                </select>
            </div>
            -->

            <div>
                <button type="submit" @click="handleSubmit">
                    Register
                </button>
            </div>
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
                    let url = "http://localhost:3000/api/register";

                    let user =  {
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
                    };

                    if(this.is_admin != null || this.is_admin == 1) url = "http://localhost:3000/api/register-admin"
                    
                    axios.post(url, user)
                    .then((response) => {
                        localStorage.setItem('user',JSON.stringify(response.data.user))
                        localStorage.setItem('jwt',response.data.token)
                        console.log(response.data.user)
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
                    this.passwordConfirm  = ""

                    return alert("Passwords do not match")
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

