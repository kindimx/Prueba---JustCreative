<template>
  <div class="login-register" style="background-image:url(/images/background/login.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5" style="background: #edf2f7!important;">
            <div class="card-body">
              <h2 class="card-title text-center mt-5 green">Iniciar sesión</h2>
              <p class="text-center">Ingresa tus datos para continuar</p>
              <form class="form-signin mt-5">
                <div class="form-label-group">
                  <input type="email" class=" input form-control" :disabled="loading" v-model="loginForm.email" placeholder="Correo electronico" required autofocus>
                </div>
                <br>
                <div class="form-label-group">
                  <input type="password" :disabled="loading" class="input form-control" v-model="loginForm.password" placeholder="Contraseña" required>
                </div>
                <center>
                  <button @click="submit" :disabled="loading" class="btn green-bck btn-lg mt-5 mb-5">
                    Iniciar sesión
                  </button>
                </center>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
        data() {
            return {
                loginForm: {
                    email: '',
                    password: ''
                },
                loading:false,
            }
        },
        components: {
        },
        mounted(){
          this.verificarLogin()
        },
        methods: {
            submit(e){
              this.loading = true;
                e.preventDefault();
                axios.post('/api/auth/login', this.loginForm).then(response =>  {
                 if(response.data.login){
                  this.$store.commit('registarLogin', true)
                  this.$store.commit('registarInfoUsuario', response.data.usuario)
                  this.loading = false;
                  this.$router.push("/home")
                 }else{
                  toastr['error']("Datos incorrectos");
                 }
                }).catch(error => {
                });
            },
            verificarLogin(){
              axios.post('/api/auth/check', this.loginForm).then(response =>  {
                 if(response.data.login){
                  this.$store.commit('registarLogin', true)
                  this.$store.commit('registarInfoUsuario', response.data.usuario)
                  this.loading = false;
                  this.$router.push("/home")
                 }
                }).catch(error => {
                });
            }
        }
    }
</script>
<style type="text/css" scoped>
.input {
  padding: 25px;
  border-radius: 25px;
  box-shadow: none;
  border: 0.5px solid gray;
}

.input:focus {
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .1), 0 10px 10px -5px rgba(0, 0, 0, .04) !important;
}
</style>