import Vue from 'vue'
import Vuex from 'vuex'
import * as types from './mutation-types'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(Vuex)
Vue.use(VueAxios, axios)

const debug = process.env.NODE_ENV !== 'production'

// initial state
const state = {
    added: [],
    vehicles: []
}

// getters
const getters = {
    allVehicles: state => state.vehicles, // would need action/mutation if data fetched async
    getNumberOfVehicles: state => (state.vehicles) ? state.vehicles.length : 0,
    cartVehicles: state => {
        return state.added.map(({ id, quantity }) => {
            const vehicle = state.vehicles.find(v => v.id === id)
            console.log(vehicle)

            return {
                marque: vehicle.marque,
                serial_number: vehicle.serial_number,
                nb_plate: vehicle.nb_plate,
                color: vehicle.color,
                nb_kilometer: vehicle.nb_kilometer,
                purchase_date: vehicle.purchase_date,
                price:  vehicle.price,
                available: vehicle.available,
                total: vehicle.total,
                quantity
            }
        })
    }
}

// mutations
const mutations = {

    [types.ADD_TO_CART](state, { id }) {
        const record = state.added.find(v => v.id === id)

        if (!record) {
            state.added.push({
                id,
                quantity: 1
            })
        } else {
            record.quantity++
        }
    },
    SET_VEHICLES(state, vehicles) {
        state.vehicles = vehicles
    }   
}

// one store for entire application
export default new Vuex.Store({
    state,
    strict: debug,
    getters,
    actions: {
        getVehicles({ commit }) {
            axios
                .get('/api/vehicle')
                .then(r => {
                    this.vehicles = r.data.data;
                    //console.log(this.vehicles)
                    commit('SET_VEHICLES', this.vehicles)
                })
        },
        addToCart({ commit }, vehicle) {
            commit(types.ADD_TO_CART, {
                id: vehicle.id
            })
        }
    },
    mutations
})