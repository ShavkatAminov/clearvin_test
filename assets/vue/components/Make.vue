<template>
  <load :status="loading" @upload="upload">
    <div class="card">
      <h5 class="card-header">
        <div class="card-title">{{ this.$route.params.type }}</div>
      </h5>
      <div class="card-body">
        <div class="form-group">
          <select class="form-control" aria-label="Default select example" v-model="selectMake" @change="uploadModels">
            <option v-for="make in makes" :value="make.code">{{ make.description }}</option>
          </select>
        </div>
        <load :status="loadingModels" @upload="uploadModels">
          <div>
            <table class="table">
              <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Code</th>
                <th scope="col">Description</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="(model, index) in models">
                <th scope="row">{{index + 1}}</th>
                <td>{{model.code}}</td>
                <td>{{model.description}}</td>
              </tr>
              </tbody>
            </table>
          </div>
        </load>
      </div>
    </div>
  </load>
</template>

<script>
import Load from './loader/Load'

export default {
  name: 'Make',
  data() {
    return {
      selectMake: null,
      loading: 'load',
      loadingModels: 'success'
    }
  },
  components: {
    Load
  },
  methods: {
    upload() {
      this.loading = 'load'
      this.$store.dispatch('fetchMakesOfType', this.$route.params.type).then(() => {
        this.loading = 'success'
      }).catch(() => {
        this.loading = 'reload'
      })
    },
    uploadModels() {
      this.loadingModels = 'load'
      this.$store.dispatch(
          'fetchModelsOfTypeAndMake',
          {type: this.$route.params.type, make: this.selectMake})
          .then(() => {
        this.loadingModels = 'success'
      }).catch(() => {
        this.loadingModels = 'reload'
      })
    }
  },
  computed: {
    makes: {
      get() {
        return this.$store.state.makes
      },
      set(val) {
         this.$store.commit('SET_MAKES', val)
      }
    },
    models: {
      get() {
        return this.$store.state.models
      },
      set(val) {
        this.$store.commit('SET_MODELS', val)
      }
    }
  },
  created() {
    this.makes = []
    this.models = []
    this.upload()
  }
}
</script>
