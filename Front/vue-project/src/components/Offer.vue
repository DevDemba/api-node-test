<template>
    <div>
        <h1>Offer</h1>
        <div class="card" v-for="vehicle in vehicles" :key="vehicle.id">
            <b-card
            :title="`${vehicle.marque}`"
            img-src="https://picsum.photos/600/300/?image=25"
            img-alt="Image"
            img-top
            tag="article"
            style="max-width: 20rem;"
            class="mb-2">
            <b-card-text>
              
            </b-card-text>
            <router-link :to="{ name:'Offer-detail', params: {id: vehicle.id_vehicle } }"><b-button variant="primary">View-detail</b-button></router-link>
            </b-card>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Offer',
    data() {
        return {
            vehicles: [],
        }
    },
    beforeCreate() {
      axios.get('/api/vehicle')
        .then(response => {
          this.vehicles = response.data.data;
        })
        .catch(e => {
          this.errors = e;
        })
    },
    created() {
      axios.get('http://localhost:3000/api/vehicle/:id')
        .then(response => {
          this.vehicles = response.data.data;
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
}
.error {
  color: red;
}
</style>
