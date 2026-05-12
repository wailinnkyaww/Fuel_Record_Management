import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import Login from '../views/Login.vue'
import Dashboard from '../views/Dashboard.vue'
import AdminLayout from '../layouts/AdminLayout.vue'
import FuelRecords from '../views/FuelRecords.vue'
import VehicleInfo from '../views/VehicleInfo.vue'
import HomePage from '../views/HomePage.vue'

const routes: Array<RouteRecordRaw> = [
  { path: '/admin', name: 'adminLogin', component: AdminLayout }, //admin login route

  { path: '/', name: 'home', component: HomePage }, //home page route
  { path: '/login', name: 'login', component: Login }, //login route
  { path: '/dashboard', name: 'dashboard', component: Dashboard }, //dashboard
  { path: '/fuelrecord', name: 'fuelrecords', component: FuelRecords }, //add fuel record route
  { path: '/status', name: 'status', component: VehicleInfo }, //status route
  // { path: '/admnin/dashboard', name: 'dashboard', component: Dashboard }, //admindashboard
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
