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
            <b-card-img v-for="file in files" :key="file.id"> 
                {{file.name}}
                <img class="preview" v-bind:ref="'image'+parseInt( key )"/>
            </b-card-img>
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
            <b-button variant="success" @click="addToCart(vehicles)">
                add to cart
            </b-button>   
            </b-card>
             <router-link :to="{ name:'Offer' }"><b-button variant="primary">Back To offer</b-button></router-link>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Offer-detail',
    props: ['image'],
    data() {
        return {
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
    created(){
        // this.files = this.$refs.file;
        // console.log(this.files)

    },
    addToCart(){
        let found = false;

      // Add the item or increase qty
			let itemInCart = this.cartItems.filter(item => item.id===itemToAdd.id);
			let isItemInCart = itemInCart.length > 0;

      if (isItemInCart === false) {
        this.cartItems.push(Vue.util.extend({}, itemToAdd));
      }
      else {
        itemInCart[0].qty += itemToAdd.qty;
      }
			
      itemToAdd.qty = 1;
    }

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
  

