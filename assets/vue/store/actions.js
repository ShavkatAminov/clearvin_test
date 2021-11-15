import axios from 'axios'

const baseUrl = window.location.origin
export default {
    fetchVehicleType({commit}) {
        return new Promise((resolve, reject) => {
            axios.get(`${baseUrl}/api/vehicle-type`, {
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then((response) => {
                    commit('SET_VEHICLE_TYPES', response.data.types)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error.status)
                    reject(error)
                })
        })
    },
    fetchMakesOfType({commit}, type) {
        return new Promise((resolve, reject) => {
            axios.get(`${baseUrl}/api/make/${type}`, {
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then((response) => {
                    commit('SET_MAKES', response.data.makes)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error.status)
                    reject(error)
                })
        })
    },
    fetchModelsOfTypeAndMake({commit}, data) {
        return new Promise((resolve, reject) => {
            axios.get(`${baseUrl}/api/model/${data.type}/${data.make}`, {
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then((response) => {
                    commit('SET_MODELS', response.data.models)
                    resolve(response)
                })
                .catch((error) => {
                    console.log(error.status)
                    reject(error)
                })
        })
    }
}
