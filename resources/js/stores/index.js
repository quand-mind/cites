import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

// stores
import speciesStore from './species'

export default new Vuex.Store({
    modules: {
        speciesStore
    }
})