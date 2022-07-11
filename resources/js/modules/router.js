import store from './store.js';
import { createRouter, createWebHashHistory } from 'vue-router'

const routes = [
    {
        name: 'Login', path: '/login', component: require('./../pages/login.vue').default, meta: {
            guest: true
        }
    },
    {
        name: 'CreateRole', path: '/role/add', component: require('./../pages/roles/create.vue').default, meta: {
            requiresAuth: true
        }
    },
    {
        name: 'ShowRole', path: '/role/index', component: require('./../pages/roles/index.vue').default, meta: {
            requiresAuth: true
        }
    },
    {
        name: 'UpdateRole', path: '/role/update/:id', component: require('./../pages/roles/update.vue').default, meta: {
            requiresAuth: true
        }
    },
    {
        name: 'ViewRole', path: '/role/show/:id', component: require('./../pages/roles/show.vue').default, meta: {
            requiresAuth: true
        }
    },
    {
        name: 'CreateUser', path: '/user/add', component: require('./../pages/users/create.vue').default, meta: {
            requiresAuth: true
        }
        
    },
    {
        name: 'ShowUser', path: '/user/index', component: require('./../pages/users/index.vue').default, meta: {
            requiresAuth: true
        }
    },
    {
        name: 'UpdateUser', path: '/user/update/:id', component: require('./../pages/users/update.vue').default, meta: {
            requiresAuth: true
        }
    },
    {
        name: 'ViewUser', path: '/user/show/:id', component: require('./../pages/users/show.vue').default, meta: {
            requiresAuth: true
        }
        
    }
    
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    if (to.name == 'Login' && store.getters.isLoggedIn) {
        next({ name: from.name })
    }
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.isLoggedIn) {
            next({ name: 'Login' })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router;