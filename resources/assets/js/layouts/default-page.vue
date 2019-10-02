<template>
  <div id="main-wrapper" style="width: 100%; height: 100%; background: #edf2f7;">
    <nav v-if="$store.state.auth.login" class="navbar navbar-light bg-light" style="background: #26d170!important">
      <div class="container">
        <a class="navbar-brand text-white" href="#"><img src="https://www.nelson-chambers.co.uk/front/images/default-user.jpg" class="rounded-circle" width="50" alt=""> {{nombreUsuario}}</a>
        <div class="form-inline my-2 my-lg-0">
          <button @click="cerrarSesion" class="btn btn-light green my-2 my-sm-0"><i class="fas fa-sign-out-alt"></i> Cerrar sesion</button>
        </div>
      </div>
    </nav>
    <router-view></router-view>
  </div>
</template>
<script>
export default {
  methods: {
    cerrarSesion() {
      axios.post('/api/auth/logout', this.loginForm).then(response => {
        this.$store.commit('registarLogin', false)
        window.location.reload();
      }).catch(error => {});
    }
  },
  computed: {
    login() {
      return this.$store.state.auth.login
    },
    nombreUsuario() {
      return this.$store.getters.nombreUsuario
    }
  }
}
</script>