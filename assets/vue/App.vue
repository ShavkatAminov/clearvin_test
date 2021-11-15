<template>
  <div>
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
      <router-link to="/" class="navbar-brand">
        <img src="https://cdn-icons-png.flaticon.com/512/3202/3202926.png" width="30" height="30" class="d-inline-block align-top"
             alt="">
        Vehicle
      </router-link>
    </nav>
    <div class="container-fluid pt-3">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>

export default {
  name: 'App'
}
</script>
