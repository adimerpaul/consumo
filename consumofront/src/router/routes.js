import Index from "../pages";
import Login from "../pages/Login";
import Regtramite from "../pages/Regtramite";
import User from "pages/User";
import Form19 from "pages/Form19";
import Firmaregulacion from "pages/Firmaregulacion";
import Verificardocumentacion from "pages/Verificardocumentacion";

const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: Index },
      { path: 'login', component: Login},
      { path: 'user', component: User,meta:{requiresAuth: true}},
      { path: 'regtramite', component: Regtramite,meta:{requiresAuth: true}},
      { path: 'form19', component: Form19,meta:{requiresAuth: true}},
      { path: 'firmaregulacion', component: Firmaregulacion,meta:{requiresAuth: true}},
      { path: 'verificardocumentacion', component: Verificardocumentacion,meta:{requiresAuth: true}},
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
