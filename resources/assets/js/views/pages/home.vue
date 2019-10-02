<template>
  <div>
    <div class="container mt-5">
      <div class="row">
        <div class="col-12">
          <h1 style="color:#1c4a46"><i class="fas fa-hand-paper"></i> Hola, {{nombreUsuario}}</h1>
          <p><span>Selecciona una opcion </span></p>
        </div>
      </div>
      <div class="row mt-5">
        <div :class="tipoUsuario==1 ? ' mt-5 col-lg-6 col-md-6 col-sm-6 col-12' : ' mt-5 col-12'"> 
          <div class="opcion" @click="irNuevoPedido">
            <h2 class="green text-center"><i class="fas fa-plus"></i> Crear nuevo pedido</h2>
          </div>
        </div>
         <div class="col-lg-6 col-md-6 col-sm-6 col-12  mt-5" v-if='tipoUsuario==1'>
         <div class="opcion" @click="irAPedidos">
            <h2 class="green text-center"><i class="fas fa-list-ul"></i> Ver pedidos creados</h2>
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
      pedidos: []
    }
  },
  created() {
    
  },
  methods: {
   irAPedidos(){
    if(this.tipoUsuario == 1){
      this.$router.push("/pedidos-creados")
    }

   },
   irNuevoPedido(){
     this.$router.push("/nuevo-pedido")
   }
  },
  computed: {
    login() {
      return this.$store.getters.login
    },
    tipoUsuario() {
      return this.$store.getters.tipoUsuario
    },
    nombreUsuario() {
      return this.$store.getters.nombreUsuario
    }
  }
}
</script>

<style>
  
.opcion {
  transition: all 300ms ease;
  padding: 25px;
  border-radius: 20px;
  background: white !important;
  cursor: pointer;
}


.opcion:hover {
  transition: all 300ms ease;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .1), 0 10px 10px -5px rgba(0, 0, 0, .04) !important;
}

</style>