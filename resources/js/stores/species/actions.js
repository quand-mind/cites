import axios from "axios"

export default {
  async fetchBuyOrders ({commit}, payload) {
    return new Promise((resolve, reject) => {
      axios.get('/solicitante/species')
      .then(response => {
        const species = response.data.map(specie => {
          return specie
        })
        commit('fetchSpecies', species)
        resolve(species)
      })
      .catch(err => reject(err))
    })
  },
}