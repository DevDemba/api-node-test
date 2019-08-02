import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Users from '@/components/Users'
import Register from '@/components/Register'
import Login from '@/components/Login'
import Dashboard from '@/components/Dashboard'
import Admin from '@/components/Admin'
import Offer from '@/components/Offer'
import OfferDetail from '@/components/OfferDetail'
import RegisterVehicle from '@/components/RegisterVehicle'
import ShoppingCart from '@/components/ShoppingCart'

Vue.use(Router)

const router = new Router({
  mode: 'history', // le mode history ne recharge pas la page mais
  // il peut y avoir des erreurs 404 si le serveur n'est pas configuré
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld,
      meta: {
        guest: false,
      }
    },
    {
      path: '/users',
      name: 'Users',
      component: Users,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/register',
      name: 'Register',
      component: Register,
      meta: {
        guest: true
      }
    },
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta: {
        guest: true
      },
    },
    {
      path: '/dashboard',
      name: 'Dashboard',
      component: Dashboard,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/admin',
      name: 'Admin',
      component: Admin,
      meta: {
        requiresAuth: true,
        is_admin: true
      }
    },
    {
      path: '/offer',
      name: 'Offer',
      component: Offer,
      // meta: {
      //   guest: true,
      //   requiresAuth: true
      // }
    },
    {
      path: '/offer-detail/:id',
      name: 'Offer-detail',
      component: OfferDetail,
      props: true
      // meta: {
      //   guest: true,
      //   requiresAuth: true
      // }
    },
    {
      path: '/registerVehicle',
      name: 'RegisterVehicle',
      component: RegisterVehicle,
      meta: {
       requiresAuth: true
      }
    },
    {
      path: '/shoppingCart',
      name: 'ShoppingCart',
      component: ShoppingCart
    }
  ]
})

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (localStorage.getItem('jwt') == null) {
      next({
        path: '/login',
        params: { nextUrl: to.fullPath }
      })
    } else {
      let user = JSON.parse(localStorage.getItem('user'))
      if (to.matched.some(record => record.meta.is_admin)) {
        if (user.is_admin == 1) {
          next()
        }
        else {
          next({ name: 'Dashboard' })
        }
      } else {
        next()
      }
    }
  } else if (to.matched.some(record => record.meta.guest)) {
    if (localStorage.getItem('jwt') == null) {
      next()
    }
    else {
      next({ name: 'Dashboard' })
    }
  } else {
    next()
  }
}); 


export default router;