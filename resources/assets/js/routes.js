import VueRouter from 'vue-router'
let routes = [{
    path: '/',
    redirect: '/home',
    component: require('./layouts/default-page'),
    children: [{
        path: '/home',
        component: require('./views/pages/home')
    }, {
        path: '/nuevo-pedido',
        component: require('./views/pages/nuevo_pedido')
    }, {
        path: '/login',
        component: require('./views/auth/login')
    }, {
        path: '/pedidos-creados',
        component: require('./views/pages/pedidos_creados')
    },]
}];
const router = new VueRouter({
    routes,
    linkActiveClass: 'active',
});
export default router;