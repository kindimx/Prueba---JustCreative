<template>
  <div>
    <router-view></router-view>
  </div>
</template>
<script>
export default {
  created() {
    if (!this.login) {
      this.$router.push("/login")
    }
  },
  methods: {

  },
  computed: {
    login() {
      return this.$store.getters.login
    },
    tipoUsuario() {
      return this.$store.getters.tipoUsuario
    }
  },
  watch: {
    $route(to, from) {
      if (!this.login) {
        this.$router.push("/login")
      }
    }
  }

}
</script>
<style>
@font-face {
  font-family: 'Product Sans';
  font-style: normal;
  font-weight: 400;
  src: local('Open Sans'), local('OpenSans'), url(https://fonts.gstatic.com/s/productsans/v5/HYvgU2fE2nRJvZ5JFAumwegdm0LZdjqr5-oayXSOefg.woff2) format('woff2');
}

p,
h1,
h2,
h3,
h4,
h5,
h6,
body {
  font-family: 'Product Sans' !important;
}

body,
html {
  background: #edf2f7 !important;
}

.green {
  color: #26d170 !important;
}

button {
  border-radius: 25px !important;
}

.green-bck {
  background: #26d170 !important;
  color: white;
}
</style>