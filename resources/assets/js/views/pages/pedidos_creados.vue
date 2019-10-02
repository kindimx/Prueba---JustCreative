<template>
  <div>
    <div class="container mt-5 mb-5">
      <div class="row">
        <div class="col-12">
          <h1 style="color:#1c4a46"><i class="fas fa-list-ul"></i> Pedidos creados</h1>
          <p><span>Descubre todos los pedidos creados</span></p>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-12" v-for="pedido in pedidos">
          <div class="item-pedido mt-3">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-12">
                <h5 class='green'><i class="fas fa-info-circle"></i> Numero de pedido:</h5>
                {{pedido.numero}}
              </div>
              <div class="col-lg-4 col-md-4 col-12">
                <h5 class='green'><i class="fas fa-wallet"></i> Total del pedido:</h5>
                {{pedido.total | moneda}}
              </div>
              <div class="col-lg-4 col-md-4 col-12">
                <h5 class='green'><i class="fas fa-calendar-week"></i> Fecha:</h5>
                {{pedido.created_at }}
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-lg-4 col-md-4 col-12">
                <h5 class='green'><i class="fas fa-user"></i> Usuario:</h5>
                {{pedido.usuario.name}}
              </div>
              <div class="col-lg-4 col-md-4 col-12 mt-3">
                <h5 class='green'><i class="fas fa-list-ul"></i> Items:</h5>
                <a class="btn green-bck" data-toggle="collapse" :href="'#collapse'+pedido.id" role="button" aria-expanded="false" :aria-controls="'collapse'+pedido.id">
                  Ver pizzas
                </a>
              </div>
              <div class="col-lg-4 col-md-4 col-12 mt-3">
                <h5 class='green'><i class="fas fa-list-ul"></i> Estatus:</h5>
                Pendiente
              </div>
            </div>
            <div class="collapse mt-5" :id="'collapse'+pedido.id">
              <div class="card card-body" style="border:none!important">
                <div class="container">
                  <div class="row ">
                    <div class="col-12 item-pedido mt-3" v-for="hijo in pedido.hijos">
                      <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-12">
                          <center>
                            <img height="110" :src="'images/pizzas/'+hijo.pizza.img">
                          </center>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                          <h2 style="margin-top: 20px" class="text-center">
                            <span>{{hijo.pizza.nombre}}</span>
                          </h2>
                          <p class="text-center lead">Tamaño
                            <span v-if="hijo.pizza.tamaño==1">chica</span>
                            <span v-if="hijo.pizza.tamaño==2">mediana</span>
                            <span v-if="hijo.pizza.tamaño==3">grande</span>
                          </p>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-5 col-12">
                          <h2 class="text-right green mt-3">{{hijo.pizza.precio | moneda}}</h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
const formatter = new Intl.NumberFormat('es-MX', {
  style: 'currency',
  currency: 'MXN',
  minimumFractionDigits: 2
})

export default {
  data() {
    return {
      pedidos: []
    }
  },
  created() {
    if (this.$store.getters.tipoUsuario != 1) {
      this.$router.push("/home")
    }

    this.obtenerPedidos()
  },
  methods: {
    obtenerPedidos() {
      axios.get('/api/pedidos').then(
        response => {
          this.pedidos = response.data.pedidos
        }).catch(
        error => {

        });
    }
  },
  filters: {
    moneda(numero) {
      return formatter.format(numero)

    }
  }
}
</script>
<style>
.item-pedido {
  background: white;
  cursor: pointer;
  padding: 25px;
  border-radius: 25px;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .1), 0 10px 10px -5px rgba(0, 0, 0, .04) !important;
}
</style>