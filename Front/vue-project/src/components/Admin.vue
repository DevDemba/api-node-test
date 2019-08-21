<template>
    <div class="container fluid">
        <h1>Welcome to administrator page</h1>
<!--         <h2>{{msg}}</h2> -->

        <div class="container card">
            <h2>Vehicles list</h2>
             <table class="cart_table">
                <tr class="table title">
                    <th v-for="column in columns" :key="column.index">{{ column }}</th>
                </tr>

                <tr v-for="vehicle in vehicles" :key="vehicle.id_vehicle"  class="table_value">
                <td>{{ vehicle.id_vehicle }}</td>
                <td>{{ vehicle.serial_number }}</td>
                <td>{{ vehicle.marque }}</td>
                <td>{{ vehicle.color }}</td>
                <td>{{ vehicle.nb_plate }}</td>
                <td>{{ vehicle.nb_kilometer }}</td>
                <td>{{ vehicle.purchase_date | formatDate }}</td>
                <td>{{ vehicle.price }}</td>
                <td>{{ vehicle.available }}</td>
                <td>{{ vehicle.total }}</td>
                <td><i class="material-icons delete_btn"  @click="deleteVehicle(vehicle.id)">clear</i></td> 
                </tr>
            </table>
        </div><br>

        <div class="container card">
            <h2>Users list</h2>
             <table class="cart_table">
                <tr class="table title">
                    <th v-for="column in columns2" :key="column.index">{{ column }}</th>
                </tr>
                <tr v-for="user in users" :key="user.id"  class="table_value">
                    <td>{{ user.id }}</td>
                    <td>{{ user.lastname }}</td>
                    <td>{{ user.firstname }}</td>
                    <td>{{ user.birthday | formatDate }}</td>
                    <td>{{ user.address }}</td>
                    <td>{{ user.gender }}</td>
                    <td>{{ user.email }}</td>
                    <td><i class="material-icons delete_btn"  @click="deleteUser(user.id)">clear</i></td> 
                </tr>
            </table>
        </div>
    </div>
</template>

<script>

import { mapGetters, mapActions } from 'vuex';
import axios from 'axios';

export default {
name: 'Admin',
data () {
    return {
        msg: 'The superheros',
        columns: ['Id', 'Serial Number', 'Marque', 'Color', 'Nb Plate', 'Nb Kilometer','Date', 'Price', 'Available', 'Total'],
        columns2: ['Id', 'Lastname', 'Firstname', 'Birthday', 'Address', 'Gender', 'Email'],
        user: ''
    }
},
methods: {
    deleteUser() {
        axios
            .delete('/api/user/'+ 16)
            .then(resp => {
                this.user = response.data.data;
                console.log(resp)
                commit(this.user)
            })
            .catch(e => {
                this.errors = e;
            })
    }
},
mounted() {
    this.$store.dispatch('getVehicles')
    this.$store.dispatch('getUsers')
},
computed: mapGetters({
    vehicles: 'allVehicles',
    users: 'allUsers',
    length: 'getNumberOfVehicles'
}),
methods: mapActions([
    'getVehicles',
    'getUsers',
    'deleteVehicle',
    'deleteUser'
]),
deleteUsers(){
    console.log('delete')
}
}
</script>

<style scoped>
h1, h2 {
    font-weight: normal;
}
ul {
    list-style-type: none;
    padding: 0;
}
li {
    display: inline-block;
    margin: 0 10px;
}
a {
    color: #42b983;
}
table th, td{
text-align: center;
}
.delete_btn{
cursor: pointer;
}
</style>
