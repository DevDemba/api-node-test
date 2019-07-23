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
        <h4>Register Vehicle</h4>
        <form>

            <label for="marque" >Marque </label>
            <div>
                <input id="marque" type="text" v-model="marque" required>
            </div>

            <label for="serial_number" > Serial Number </label>
            <div>
                <input id="serial_number" type="text" v-model="serial_number" required>
            </div>

            <label for="color" >color</label>
            <div>
                <input id="color" type="color" v-model="color" required>
            </div>

            <label for="nb_plate" >Number plate</label>
            <div>
                <input id="nb_plate" type="text" v-model="nb_plate" required>
            </div>

            <label for="nb_kilometer" >Number of kilometer</label>
            <div>
                <input id="nb_kilometer" type="text" v-model="nb_kilometer" required>
            </div>

            <label for="purchase_date" >Purchase date</label>
            <div>
                <input id="purchase_date" type="date" v-model="purchase_date" required>
            </div>
            
            <label for="price" >Price</label>
            <div>
                <input id="price" type="text" v-model="price" required>
            </div>

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

  name: 'RegisterVehicle',
        props : ["nextUrl"],
        data(){
            return {
                marque: "",
                serial_number : "",
                color: "",
                nb_plate: "",
                nb_kilometer:"",
                purchase_date:"",
                price:""
            }
        },
        methods : {
            handleSubmit(e) {
                e.preventDefault()

                    let url = "http://localhost:3000/api/vehicle";

                    let vehicle =  {
                        marque: this.marque,
                        serial_number: this.serial_number,
                        color: this.color,
                        nb_plate: this.nb_plate,
                        nb_kilometer: this.nb_kilometer,
                        purchase_date: this.purchase_date,
                        price: this.price
                    };

                    
                    axios.post(url, vehicle)
                    .then((response) => {
                        localStorage.setItem('vehicle',JSON.stringify(response.data.vehicle))
                        localStorage.setItem('jwt',response.data.token)
                        console.log(response.data.vehicle)
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

