<template>
  <div>
    <div v-if="show && $page.props.flash.success" @click="show = false" class="alert alert-info">
      {{ $page.props.flash.success }}
    </div>

    
    <div v-if="show && $page.props.flash.error" @click="show = false" class="alert alert-danger">
      {{ $page.props.flash.error }}
    </div>
  </div>
</template>

<style scoped>
  .alert {
    position: fixed;
    top: 15vh;
    left: 10%;
    width: 80%;
  }
</style>

<script>
export default {
  data() {
    return {
      show: true,
    }
  },
  watch: {
    '$page.props.flash': {
      handler() {
        this.show = true
      },
      deep: true,
    },
  },
}
</script>
