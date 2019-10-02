<template>
  <div>
    <InfoPedido v-if="itemsPedido.length > 0" :items="itemsPedido" :class="[{'animated slideInUp faster':animaciones.infoPedido.entrar},{'animated slideOutDown':animaciones.infoPedido.salir}]" />
    <wizard />
    <div v-if="itemsPedido.length > 0 && !animaciones.infoPedido.entrar " @click="verPedido" class="volver-pedido animated slideInUp faster delay-2s">
      <div class="container">
        <h4 class="text-white text-center mt-3">
          <i class="fas fa-arrow-up"></i> Volver al pedido
        </h4>
      </div>
    </div>
  </div>
</template>
<script>
import wizard from "./wizard.vue"
import InfoPedido from "./info_pedido.vue"
import { BusEmisor } from "../../services/bus_emisor.js"

export default {
  data() {
    return {
      animaciones: {
        infoPedido: {
          entrar: true,
          salir: false,
        }
      }
    }
  },
  components: {
    wizard,
    InfoPedido
  },
  mounted() {
    BusEmisor.$on("ItemAgregado", (payload) => {
      this.verPedido()
    })
    BusEmisor.$on("AgregarMasItems", (payload) => {
       this.ocultarPedido()
    })
    BusEmisor.$on("SalirCrearPedido", () => {
     if(this.itemsPedido.length > 0){
      var salir = confirm("Seguro que deseas salir?")
      if(salir){
        this.$store.commit('resetearPedido', [])
        this.$router.push("/home")
      }
     }else{
       this.$router.push("/home")
     }
    })
  },
  methods: {
    verPedido(){
      //$('body').attr("style","overflow:hidden")
      window.scrollTo(0, 0);

      this.animaciones.infoPedido.salir = false
      this.animaciones.infoPedido.entrar = true
    },
    ocultarPedido(){
       $('body').attr("style","overflow:visible")
      this.animaciones.infoPedido.entrar = false
      this.animaciones.infoPedido.salir = true
    }
  },
  computed: {
    itemsPedido() {
      return this.$store.state.wizard.pedido;
    }
  }

};
</script>
<style>
.volver-pedido{
  z-index:400000!important;
  background: #26d170; 
  height:4em!important;
  position: fixed;width: 100%!important;
  bottom: 0;cursor:pointer;
}
</style>