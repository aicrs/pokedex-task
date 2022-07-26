import Vue from 'vue'
import VueRouter from 'vue-router'
import Index from './/pages/Index'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'index',
            component: Index
        },
    ]
});

export default router;
