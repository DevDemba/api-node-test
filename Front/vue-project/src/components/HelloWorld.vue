<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <h2>Essential Links</h2>
    <welcome></welcome>
  </div>
</template>

<script>
import Welcome from './Welcome';

export default {
  name: 'HelloWorld',
  components: {
    Welcome
  },
  data () {
    return {
      msg: 'Welcome to Your Booking App'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
