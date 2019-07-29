<template>
    <div>
        <h1>Offer</h1>
        <div class="parent">
            <div class="card">
            <b-card  v-for="vehicle in vehicles" :key="vehicle.id"
            :title="`${vehicle.marque}`"
            img-src="https://picsum.photos/600/300/?image=25"
            img-alt="Image"
            img-top
            tag="article"
            style="max-width: 20rem;"
            class="mb-2 ">
            <b-card-text>
              
            </b-card-text>
            <router-link :to="{ name:'Offer-detail', params: {id: vehicle.id_vehicle } }"><b-button variant="primary">View-detail</b-button></router-link>
            </b-card>
        </div>
        </div>
    </div> 
</template>

<script>
import axios from 'axios';

export default {
    name: 'Offer',
    data() {
        return {
            files: [],
            vehicles: [],
        }
    },
    beforeMount() {
      axios.get('/api/vehicle')
        .then(response => {
          this.vehicles = response.data.data;
        })
        .catch(e => {
          this.errors = e;
        })
    },
    created() {
        // let uploadedFiles = this.$refs.file.files[0];
        // for( var i = 0; i < uploadedFiles.length; i++ ){
        //   this.files.push( uploadedFiles[i] );
        // }
        // console.log(this.files)

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
