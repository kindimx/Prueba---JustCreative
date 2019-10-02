<template>
  <div>
    <div class="container mt-5">
      <div class="row ">
        <div class="col-12">
          <h1 style="color:#1c4a46"><i class="fas fa-plus"></i> Nuevo pedido</h1>
          <p v-if="mounted"><span v-if="wizard.step==1">Primero selecciona una pizza </span>
            <span v-else>Ahora selecciona el tamaño </span></p>
        </div>
      </div>
    </div>
    <div class="container" style="margin-top:100px;">
      <div v-if="wizard.step==1" :class="['step-1',{'animated fadeInRight delay-4s ':wizard.step==1}]">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-6" v-for="(pizza,index) in tiposDePizzas" :key="pizza.id">
            <div @click="seleccionarTipo(index)" :class="['pizza-item',{'seleccionado':wizard.tipoPizza == index}]">
              <img :src="'images/pizzas/'+pizza.img" class="img-responsive">
              <h3 style="margin-top: 20px" class="text-center"><i v-if="wizard.tipoPizza==index" class="fas fa-check-circle green"></i> {{pizza.nombre}}</h3>
            </div>
          </div>
        </div>
      </div>
      <div v-if="wizard.step==2" :class="['step-2',{'animated fadeInRight delay-4s ':wizard.step==2}]">
        <div class="row">
          <div class="col-lg-4 col-md-12 col-6" >
            <div @click="seleccionarTamaño(1)" :class="['pizza-item',{'seleccionado':wizard.tamañoPizza == 1}]">
              <center><span class="dot chica "></span></center>
              <h3 style="margin-top: 20px" class="text-center"><i v-if="wizard.tamañoPizza==1" class="fas fa-check-circle green"></i> Chica</h3>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-6">
            <div @click="seleccionarTamaño(2)" :class="['pizza-item',{'seleccionado':wizard.tamañoPizza == 2}]">
              <center><span class="dot mediana"></span></center>
              <h3 style="margin-top: 20px" class="text-center"><i v-if="wizard.tamañoPizza==2" class="fas fa-check-circle green"></i> Mediana</h3>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-12">
            <div @click="seleccionarTamaño(3)" :class="['pizza-item',{'seleccionado':wizard.tamañoPizza == 3}]">
              <center><span class="dot grande"></span></center>
              <h3 style="margin-top: 20px" class="text-center"><i v-if="wizard.tamañoPizza==3" class="fas fa-check-circle green"></i> Grande</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="container mt-5 mb-5">
        <div class="row mt-5 mb-5">
          <div class="col-lg-6 col-md-6 col-sm-6 col-6">
            <button @click="volver" type="button" class="btn btn-light btn-lg green float-left"><i class="fas fa-arrow-left"></i> Volver</button>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-6">
            <button @click="continuar" type="button" class="btn green-bck btn-lg float-right">
              <span v-if="wizard.step==1">Continuar </span>
              <span v-else>Agregar al pedido </span>
              <i class="fas fa-arrow-right"></i></button>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</template>
<script>
import { BusEmisor } from "../../services/bus_emisor.js"

export default {
  data() {
    return {
      pizzasDisponibles: [],
      tiposDePizzas: [],
      wizard: {
        step: 1,
        tipoPizza: null,
        tamañoPizza: null,
      },
      mounted: false,
    }
  },
  created() {
    this.obtenerPizzas();
  },
  mounted() {
    this.mounted = true
  },
  methods: {
    obtenerPizzas() {
      axios.get('/api/pizzas').then(
        response => {
          this.pizzasDisponibles = response.data.pizzas
          this.organizarPizzas()
        }).catch(
        error => {

        });
    },
    organizarPizzas() {
      this.pizzasDisponibles.forEach((pizza) => {
        if (pizza.tamaño == 1) {
          this.tiposDePizzas.push(pizza)
        }
      })
    },
    continuar() {
      if (this.wizard.step == 1) {
        if (this.wizard.tipoPizza != null) {
          this.wizard.step = 2
        } else {

        }
      } else if (this.wizard.step == 2) {
        if (this.wizard.tamañoPizza != null) {
          this.agregarAPedido()
        }
      }
    },
    volver() {
      if (this.wizard.step == 2) {
        this.wizard.step = 1
      } else {
        BusEmisor.$emit("SalirCrearPedido", null);
      }
    },
    seleccionarTipo(tipo) {
      this.wizard.tipoPizza = tipo
    },
    seleccionarTamaño(tamaño) {
      this.wizard.tamañoPizza = tamaño
    },
    agregarAPedido() {
      var pizza = this.pizzasDisponibles.filter((item) => {
        if (this.tiposDePizzas[this.wizard.tipoPizza].nombre == item.nombre && item.tamaño == this.wizard.tamañoPizza) {
          return true;
        }
      })
      this.$store.commit('agregarItemAPedido', pizza[0])
      BusEmisor.$emit("ItemAgregado", pizza);
      setTimeout(() => {
        this.resetearWizard()
      }, 1000)
    },
    resetearWizard() {
      this.wizard = {
        step: 1,
        tipoPizza: null,
        tamañoPizza: null,
      }
    }
  }
};
</script>
<style>
.pizza-item {
  transition: all 300ms ease;
  padding: 25px;
  border-radius: 20px;
  cursor: pointer;
}

.pizza-item:hover {
  transition: all 300ms ease;
  background: white !important;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .1), 0 10px 10px -5px rgba(0, 0, 0, .04) !important;
}

.seleccionado {
  background: white !important;
  transition: all 300ms ease;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .1), 0 10px 10px -5px rgba(0, 0, 0, .04) !important;
}

.absulute {
  position: absolute;
}

.dot {
  background-color: #bae9d4;
  border-radius: 50%;
  display: inline-block;
}

.chica {
  height: 100px;
  width: 100px;
}

.mediana {
  height: 150px;
  width: 150px;
}

.grande {
  height: 230px;
  width: 230px;
}
</style>