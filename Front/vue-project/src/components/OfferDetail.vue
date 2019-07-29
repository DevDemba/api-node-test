<template>

    <div>
        <div>
            <h1>Offer detail</h1>
        </div>
  
       <div class="card">
            <b-card
            :title="`${vehicles.marque}`"
            img-src="https://picsum.photos/600/300/?image=25"
            img-alt="Image"
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
                {{ vehicles.mb_kilometer }}
            </b-card-text>

            <b-card-text>         
                {{ vehicles.purchase_date }}
            </b-card-text>

            <b-card-text>         
                {{ vehicles.price }}
            </b-card-text>

            <b-card-text>         
                {{ vehicles.available }}
            </b-card-text>    
            </b-card>
             <router-link :to="{ name:'Offer' }"><b-button variant="primary">Back To offer</b-button></router-link>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Offer-detail',
    data() {
        return {
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
    }
    
}
</script>


<style scoped>
.card {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.error {
  color: red;
}
</style>
  

