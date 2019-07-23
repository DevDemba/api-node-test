<template>

    <div>
        <div>
            <h1>Offer detail</h1>
        </div>
  
       <div class="card" v-if="vehicles">
            <b-card
            title="Card Title"
            img-src="https://picsum.photos/600/300/?image=25"
            img-alt="Image"
            img-top
            tag="article"
            style="max-width: 20rem;"
            class="mb-2">
            <b-card-text>
                {{ vehicles.marques }}
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
   BeforeCreate() {
      axios.get('/api/vehicle:id')
        .then(response => {
          this.vehicles = response.data.data
          console.log(this.vehicles)
        })
        .catch(e => {
          this.errors = e
        })
    }
    
}
</script>


<style scoped>
.card {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.error {
  color: red;
}
</style>
  

