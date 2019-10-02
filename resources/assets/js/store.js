import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);
import createPersistedState from 'vuex-persistedstate'
import * as Cookies from 'js-cookie'
const store = new Vuex.Store({
    state: {
        auth: {
            usuario: null,
            login: false
        },
        pizzas: [],
        pedidos: [],
        wizard: {
            pedido: [],
        }
    },
    mutations: {
        agregarItemAPedido: (state, item) => {
            state.wizard.pedido.push(item)
        },
        registarLogin: (state, login) => {
            state.auth.login = login
        },
        registarInfoUsuario: (state, info) => {
            state.auth.usuario = info
        },
        cargarPizzasDisponibles: (state, pizzas) => {
            state.pizzas = pizzas
        },
        resetearPedido: (state, empty) => {
            state.wizard.pedido = []
        },
    },
    actions: {},
    getters: {
        login(state) {
            return state.auth.login
        },
        tipoUsuario(state) {
            return state.auth.usuario.tipo;
        },
        nombreUsuario(state) {
            return state.auth.usuario.nombre;
        }
    },
    plugins: [
        //createPersistedState({ storage: window.sessionStorage })
    ]
});
export default store;