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
    vehicles: [],
    users: [],
    status: '',
    token: localStorage.getItem('token') || '',
    admin: localStorage.getItem('user') || '',
    user: {}
}

// getters
const getters = {
    authenticated: state => !!state.token,
    admin: state =>!!state.user.admin,
    user: state => !!state.user,
    userId: state => !!state.user.id,
    authStatus: state => state.status,
    allVehicles: state => state.vehicles, // would need action/mutation if data fetched async
    allUsers: state => state.users,
    getNumberOfVehicles: state => (state.vehicles) ? state.vehicles.length : 0,
    cartVehicles: state => {
        return state.added.map(({ id, quantity }) => {
            const vehicle = state.vehicles.find(v => v.id === id)
           // console.log(vehicle)

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

const actions = {
    getVehicles({ commit }) {
        axios
            .get('/api/vehicle')
            .then(resp => {
                this.vehicles = resp.data.data;
                //console.log(this.vehicles)
                commit('SET_VEHICLES', this.vehicles)
            })
    },
    deleteVehicle({ commit }) {
        axios
            .delete('/api/vehicle/' + 16)
            .then(resp => {
                this.vehicle.splice(id, 16)
                console.log(resp);
            })
            .catch(e => {
                this.errors = e;
            })
    },
    getUsers({ commit }) {
        axios
            .get('/api/users')
            .then(r => {
                this.users = r.data.data;
                //console.log(this.users)
                commit('SET_USERS', this.users)
            })
    },
    deleteUser({ commit }) {
        let id = 16
        axios
            .delete('htpp://localhost:3000/api/users/' + id)
            .then(resp => {
                this.users.splice(id, 1)
                console.log(this.users);
            })
            .catch(e => {
                this.errors = e;
            })
    },
    addToCart({ commit }, vehicle) {
        commit(types.ADD_TO_CART, {
            id: vehicle.id
        })
    },
    login({ commit }, user) {
        return new Promise((resolve, reject) => {
            commit('auth_request')
            axios({ url: '/api/login', data: user, method: 'POST' })
                .then(resp => {
                    const token = resp.data.token
                    const user = resp.data.user
                    localStorage.setItem('token', token)
                    localStorage.setItem('user', JSON.stringify(user))
                    axios.defaults.headers.common['Authorization'] = token
                    commit('auth_success', token, user)
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error')
                    localStorage.removeItem('token')
                    reject(err)
                })
        })
    },
    register({ commit }, user) {
        return new Promise((resolve, reject) => {
            commit('auth_request')
            axios({ url: '/api/register', data: user, method: 'POST' })
                .then(resp => {
                    const token = resp.data.token
                    const user = resp.data.user
                    localStorage.setItem('token', token)
                    localStorage.setItem('user', JSON.stringify(user))
                    axios.defaults.headers.common['Authorization'] = token
                    commit('auth_success', token, user)
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error', err)
                    localStorage.removeItem('token')
                    reject(err)
                })
        })
    },
    logout({ commit }) {
        return new Promise((resolve, reject) => {
            commit('logout')
            axios({ url: '/api/logout', method: 'GET' })
                .then(resp => {
                    const token = resp.data.token
                    const user = resp.data.user
                    localStorage.removeItem('token', token)
                    localStorage.removeItem('user', JSON.stringify(user))
                    resolve(resp)
                })
                .catch(err => {
                    commit('auth_error', err)
                    localStorage.removeItem('token')
                    reject(err)
                })
            localStorage.removeItem('token')
            localStorage.removeItem('user')
            delete axios.defaults.headers.common['Authorization']
            resolve()
        })
    }
}

// mutations
const mutations = {
    auth_request(state) {
        state.status = 'loading'
    },
    auth_success(state, token, user) {
        state.status = 'success'
        state.token = token,
        state.user = user
    },
    auth_error(state) {
        state.status = 'error'
    },
    logout(state) {
        state.status = '',
        state.token = ''
    },
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
    },
    SET_USERS(state, users) {
        state.users = users
    }

}

// one store for entire application
export default new Vuex.Store({
    state,
    strict: debug,
    getters,
    actions,
    mutations
})