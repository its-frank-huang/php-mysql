import Vue from 'vue'
import Router from 'vue-router'
import Home from '../pages/Home'
import Login from '../pages/Login'
import AddItem from '../components/AddItem'
import Detail from '../components/Detail'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home,
      children:[
        {
          path:'add',
          component: AddItem
        },
        {
          path:'detail/:id',
          component: Detail
        }
      ]
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    }
  ]
})
