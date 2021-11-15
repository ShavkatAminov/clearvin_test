<template>
  <load :status="loading" @upload="upload">
    <div class="row">
      <div class="col-3 mb-3" v-for="type in types">
        <div class="card">
          <h5 class="card-header">
            <div class="card-title float-left">{{ type.code }}</div>
            <div class="card-tools float-right">
              <router-link :to="{name: 'makesOfType', params: {type: type.code}}">View</router-link>
            </div>
          </h5>
          <div class="card-body">
            <p class="card-text">{{ type.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </load>
</template>

<script>
import Load from './loader/Load'

export default {
  name: 'VehicleType',
  data() {
    return {
      loading: 'load'
    }
  },
  components: {
    Load
  },
  methods: {
    upload() {
      this.loading = 'load'
      this.$store.dispatch('fetchVehicleType').then(() => {
        this.loading = 'success'
      }).catch(() => {
        this.loading = 'reload'
      })
    }
  },
  computed: {
    types: {
      get() {
        return this.$store.state.types
      },
      set(val) {
        //  this.$store.commit('UPDATE_TYPE', val)
      }
    }
  },
  created() {
    this.upload()
  }
}
</script>
