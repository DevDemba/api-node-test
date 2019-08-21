<template>
    <div class="container fluid"> 
        <h1>Shopping Cart</h1>

        <div class="container card">  
            <!--<h2 @click="checkItems"> {{user.id}}'s Cart </h2> -->
            <p v-show="cartitems.length" class="item_quantity">Your shopping cart have <span>{{cartitems.length}}</span> articles</p>
            <p v-show="!cartitems.length"><i>Your cart is empty!</i> <router-link :to="{ name: 'Offer' }"><b-button variant="primary">Go shopping</b-button></router-link></p>

            <table class="cart_table">
                <tr class="table title">
                    <th v-for="column in columns" :key="column.index">{{column}}</th>
                    <th>　　</th>
                </tr>

                <tr v-for="cartitem in cartitems" :key="cartitem.id"  class="table_value">
                <td>{{cartitem.id}}</td>
                <td>{{cartitem.user}}</td>
                <td>{{cartitem.id_vehicle}}</td>
                <td>{{cartitem.serial_number}}</td>
                <td>{{cartitem.marque}}</td>
                <td>{{cartitem.color}}</td>
                <td>{{cartitem.nb_plate}}</td>
                <td>{{cartitem.nb_kilometer}}</td>
                <td>{{cartitem.purchase_date | formatDate}}</td>
               <!--  <td>{{addComma(cartitem.price)}} €</td> -->
                <td>${{ cartitem.price }}</td>
            <!--     <td>{{cartitem.available}}</td> -->
                <td>{{ cartitem.quantity }}</td>
            <!--     <td>{{addComma(cartitem.total)}}</td> -->
                <td>{{ cartitem.total }}</td>
                <td><i class="material-icons delete_btn"  @click="deleteCartitem(cartitem.id)">clear</i></td>
                </tr>
            </table>

      <!--       <div class="result">
                <table>
                    <tr>
                    <th>Quantité totale</th>
                    <td> {{quantitySum()}}</td>
                    </tr>
                    <tr>
                    <th>Montant total</th>
                    <td>{{addComma(priceSum())}}</td>
                    </tr>
                </table>
            </div> -->
            <div class="result">
                <table>
                     <tr>
                        <td><b>Total:</b></td>
                        <td></td>
                        <td><b>{{ total }} €</b></td>
                    </tr>
                </table>
            </div>
        </div><br>
        <p><b-button v-show="cartitems.length" variant="primary" @click='checkout'>Checkout</b-button></p>
    </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';
import { mapGetters } from 'vuex';

export default {
    name: 'shoppingCart',
    data() {
        return {
            moment: moment,
            columns: ['No', 'User', 'Vehicle Id', 'Serial Number', 'Marque', 'Color', 'Nb Plate', 'Nb Kilometer','Date', 'Price', 'Available', 'Total'],
            //cartitems: [],
            user: null,
            matchitems:[]
        }
    },
    computed: {
        ...mapGetters({
        cartitems: 'cartVehicles'
        }),
        total () {
            return this.cartitems.reduce((total, v) => {
                return total + v.price * v.quantity
            }, 0)
        }
    },
    methods: {
        checkout(){
            alert('Pay on stripe ' + this.total + ' € ') 
        },
       /* priceSum(){
             return this.cartitems.reduce((prev,cur) => prev + cur.total,0)
        },
        quantitySum(){
            return this.cartitems.reduce((prev,cur) => prev + cur.available,0)
        },
        checkItems(){
            for(var i=0; i<=this.cartitems.length; i++){
                if(this.cartitem.user == this.user.alias){
                this.matchitems.push(this.cartitem)
                console.log(this.matchitems)
                }
            }
        },*/
        addComma(num) {
            var regexp = /\B(?=(\d{3})+(?!\d))/g
            return num.toString().replace(regexp, ',')
        },
        deleteCartitem(id) { 
            console.log(id)
            var result = confirm('Are you sure you want to remove it from your shopping list ?')
            if(result){
            this.$store.state.added.doc(id).delete() // This is removed from the database.
           // axios.delete('/api/vehicle/' + id)
            .then(() =>{
                this.cartitems = this.cartitems.filter(cartitem => {
                    return cartitem.id !=id // deleteSmoothie If the sender and the ID do not match, leave them in the list.
                });

                this.$swal({
                    position: 'center',
                    type: 'success',
                    title: 'Deletion completed',
                    showConfirmButton: false,
                    timer: 1000
                });
            })
            }     
        }
    },
/*     created() {
          axios.get('/api/vehicle/')
            .then( /*snapshot => {
                 console.log('je suis ok')
                snapshot.forEach( doc => {
                   let cartitem = doc.data() 
                   cartitem.id = doc.id
                   
                   this.cartitems.push(cartitem)
                         console.log('je suis rentré ,))')
                })
                console.table(this.cartitems)
                response => {
                    this.cartitems = response.data.data;
                    console.log(this.cartitems)
            })
            .catch(e => {
                    this.error = e;
            })
    } */
    
}
</script>

<style scoped>

table th, td{
    text-align: center;
}
.delete_btn{
    cursor: pointer;
}
.result{
margin-top: 40px;
width: 50%;
float: right;
}

</style>
