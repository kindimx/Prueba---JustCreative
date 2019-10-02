<template>
  <div style="z-index:5000000!important;background: #edf2f7; height: 100%!important;position: absolute;width: 100%!important;max-height: 100%;margin-top: 8em;">
    <div class="container">
      <div class="row ">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
          <h3>Total del pedido: <strong><span class="green"> {{total | moneda}}</span></strong></h3>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
          <button @click="nuevoItem" type="button" class="btn btn-light btn-lg green-bck float-right"><i class="fas fa-plus"></i> Mas items</button>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
          <button @click="cerrarPedido" type="button" class="btn btn-light btn-lg green-bck float-right"><i class="fas fa-check-circle"></i> Cerrar pedido</button>
        </div>
      </div>
    </div>
    <div class="mt-5">
      <div class="container">
        <div class="row ">
          <div class="col-12 item-pedido mt-3" v-for="pizza in items">
            <div class="row">
              <div class="col-lg-2 col-md-3 col-sm-3 col-12">
                <center>
                  <img height="110" :src="'images/pizzas/'+pizza.img">
                </center>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                <h2 style="margin-top: 20px" class="text-center">
                  <span>{{pizza.nombre}}</span>
                </h2>
                <p class="text-center lead">Tamaño
                  <span v-if="pizza.tamaño==1">chica</span>
                  <span v-if="pizza.tamaño==2">mediana</span>
                  <span v-if="pizza.tamaño==3">grande</span>
                </p>
              </div>
              <div class="col-lg-7 col-md-6 col-sm-5 col-12">
                <h2 class="text-right green mt-3">{{pizza.precio | moneda}}</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { BusEmisor } from "../../services/bus_emisor.js"
  const formatter = new Intl.NumberFormat('es-MX', {
      style: 'currency',
      currency: 'MXN',
      minimumFractionDigits: 2
    })

  export default {
  props: {
    items: {
      type: Array,
      default: []
    }
  },
  methods:{
    nuevoItem(){
      BusEmisor.$emit("AgregarMasItems", null);
    },
    cerrarPedido(){
      axios.post('/api/pedidos/crear-pedido', {data:{items:this.items,total:this.total}}).then(response =>  {
          if(response.data.registro){
            alert('Pedido registrado con exito')
            if(this.$store.getters.tipoUsuario == 1){
              this.$router.push("/pedidos-creados")
            }else{
              this.$router.push("/home")
            }
          }else{
            alert(response.data.err_msg)
          }
        }).catch(error => {
          alert(error)
      });
    }
  },
  computed:{
    total(){
      var total = 0;
      this.items.forEach((item)=>{
        total += item.precio
      })
      return total;
    }
  },
  filters:{
    moneda(numero){
      return formatter.format(numero)

    }
  }
}
</script>
<style type="text/css">
.item-pedido {
  background: white;
  cursor: pointer;
  padding: 25px;
  border-radius: 25px;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .1), 0 10px 10px -5px rgba(0, 0, 0, .04) !important;
}

.contenedor-precio {

  border-radius: 20px;
  padding: 10px;
}
</style>