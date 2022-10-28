import axios from "axios"

export default {
  async fetchSpecies ({commit}, payload) {
    return new Promise((resolve, reject) => {
      axios.get('/solicitante/species')
      .then(response => {
        console.log(response.data)
        const species = response.data
        commit('fetchSpecies', species)
        resolve(species)
      })
      .catch(err => reject(err))
    })
  },
}