<template>

  <div class="container d-flex h-100">
    <div class="row align-self-center w-100">
      <div class="col-1 mx-auto">
        <button class="btn text-center" @click="refreshData">
          <img src="https://cdn-icons-png.flaticon.com/512/126/126502.png" alt="Reload" width="40px">
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Reload',
  methods: {
    refreshData() {
      this.$emit('reload')
    }
  }
}
</script>
