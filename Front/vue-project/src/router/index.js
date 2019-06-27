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

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld,
      meta: {
        guest: true
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
      meta:{
        guest: true
      }
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
          is_admin : true
      }
    },
    {
      path: '/offer',
      name: 'Offer',
      component: Offer,
      meta: {
        guest: true
      }
    },
    {
      path: '/Offer-detail',
      name: 'Offer-detail',
      component: OfferDetail,
      meta:{
        guest: true
      }
    }
  ]
})
