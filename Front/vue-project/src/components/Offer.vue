<template>
    <div class="container fluid">
        <h1>Offer</h1>
        <div class="parent">
          <div class="card">
            <b-card  v-for="vehicle in vehicles" :key="vehicle.id_vehicle" track-by="id"
            :title="`${vehicle.marque}`"
            :img-src="'http://localhost:3000/uploads/'+`${vehicle.image}`"
            :img-alt="`${vehicle.image}`"
            img-top
            tag="article"
            style="max-width: 20rem;"
            class="mb-2 ">
           <p>{{vehicle.price}} €</p>
            <router-link :to="{ name:'Offer-detail', params: {id: vehicle.id_vehicle } }"><b-button variant="primary">View-detail</b-button></router-link>
              <b-button variant="success" @click="addToCart(vehicle)">add to cart </b-button>   
            </b-card>
          </div>
        </div>
    </div> 
</template>

<script>
import axios from 'axios';
import { mapGetters, mapActions, mapState } from 'vuex';

export default {
    name: 'Offer',
    mounted () {
      this.$store.dispatch('getVehicles')
      this.$store.dispatch('addToCart')
    },
    computed: mapGetters({
      vehicles: 'allVehicles',
      length: 'getNumberOfVehicles'
    }),
    methods: mapActions([
        'getVehicles',
        'addToCart'
    ]),
/*     created() {
      axios.get('/api/vehicle')
        .then(response => {
          this.vehicles = response.data.data;
        })
        .catch(e => {
          this.errors = e;
        })
    },  */
    beforeCreate() {
      axios.get('/api/vehicle/:id')
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
.parent {
    display: flex;
    justify-content: center;
    flex-wrap:wrap;
    margin:-10px 0 0 -10px;
}
.card {
  display: flex;
  align-items: center;
  flex-grow: 1;
  margin-top: 10px;
  width: calc(100% * (1/4) - 50px - 1px);
}
.error {
  color: red;
}
</style>
