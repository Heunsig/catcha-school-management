<template>
  <div>
    <v-btn @click="logout()">Logout</v-btn>
  </div>
</template>
<script>
export default {
  methods: {
    logout () {
      this.$store.dispatch('destroyToken').then(() => {
        this.$router.push({name: 'login'})
      })
    }
  }
}
</script>