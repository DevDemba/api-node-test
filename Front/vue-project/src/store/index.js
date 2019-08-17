import Vue from 'vue'
import Vuex from 'vuex'
import * as types from './mutation-types'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

// initial state
const state = {
    added: [],
    all: [
        {
            id: 1,
            marque: 'COBOL 101 vintage',
            description: 'Learn COBOL with this vintage programming book',
            price: 399
        },
        {
            id: 2,
            marque: 'Sharp C2719 curved TV',
            description: 'Watch TV like never before with the brand new curved screen technology',
            price: 1995
        },
        {
            id: 3,
            marque: 'Remmington X',
            description: 'Excellent for gaming and typing, this Remmington X keyboard ' +
                'features tactile, clicky switches for speed and accuracy',
            price: 595
        }
    ]
}

// getters
const getters = {
    allVehicles: state => state.all, // would need action/mutation if data fetched async
    getNumberOfVehicles: state => (state.all) ? state.all.length : 0,
    cartVehicles: state => {
        return state.added.map(({ id, quantity }) => {
            const vehicle = state.all.find(v => v.id === id)

            return {
                marque: vehicle.marque,
                price:  vehicle.price,
                quantity
            }
        })
    }
}

// actions
const actions = {
    addToCart({ commit }, vehicle) {
        commit(types.ADD_TO_CART, {
            id: vehicle.id
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