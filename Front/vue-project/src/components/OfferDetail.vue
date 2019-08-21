<template>
    <div>
        <div>
            <h1>Offer detail</h1>
        </div>
  
       <div class="card">
            <b-card
            :title="`${vehicles.marque}`"
            :img-src="'http://localhost:3000/uploads/'+`${vehicles.image}`"
            :img-alt="`${vehicles.image}`"
            img-top
            tag="article"
            style="max-width: 20rem;"
            class="mb-2">
            <b-card-text>         
                {{ vehicles.serial_number }}
            </b-card-text>

            <b-card-text>         
               <b-form-input type="color" :value="`${vehicles.color}`" disabled />
            </b-card-text>

            <b-card-text>         
                {{ vehicles.nb_plate }}
            </b-card-text>

            <b-card-text>         
                {{ vehicles.nb_kilometer }} km
            </b-card-text>

            <b-card-text>         
                {{ vehicles.purchase_date | formatDate }}
            </b-card-text>

            <b-card-text>         
                {{ vehicles.price }} $
            </b-card-text>

            <b-card-text>         
                {{ vehicles.available }} available
            </b-card-text> 
            <b-button variant="success" @click="addToCart(vehicle)">
                add to cart
            </b-button>   
            </b-card>
             <router-link :to="{ name:'Offer' }"><b-button variant="primary">Back To offer</b-button></router-link>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'Offer-detail',
    data() {
        return {
            id: '',
            files: [],
            vehicles: [],
        }
    },
    beforeCreate() {
      axios.get('/api/vehicle/' + this.$route.params.id)
        .then(response => {
          this.vehicles = response.data.data;
          //console.log(this.vehicles)
        })
        .catch(e => {
          this.errors = e;
        })
    },
    computed: mapGetters({
      //cartitems: 'allVehicles',
    }),
    methods: mapActions([
        'addToCart'
    ]),
}
</script>


<style scoped>
.card {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}
.error {
  color: red;
}
</style>
  

