import Index from "../pages/Index";
import Login from "../pages/Login";
import Verificar from "../pages/Verificar";
import Regtramite from "../pages/Regtramite";
import User from "pages/User";
// import Form19 from "pages/Form19";
// import Firmaregulacion from "pages/Firmaregulacion";
// import Verificardocumentacion from "pages/Verificardocumentacion";
import Direcciontributaria from "pages/Direcciontributaria";
import Infraestructura from "pages/Infraestructura";
import Seguridadciudadana from "pages/Seguridadciudadana";
import Medioambiente from "pages/Medioambiente";
import Salubridad from "pages/Salubridad";
import Actividadeseconomicas from "pages/Actividadeseconomicas";
import Consultartramite from "pages/Consultartramite";
import Entregartramite from "pages/Entregartramite";
import Modifica from "pages/Modifica";
import Multa from "pages/Multa";
import Verifica from "pages/Verifica";
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: Index },
      { path: 'login', component: Login},
      { path: 'user', component: User,meta:{requiresAuth: true}},
      { path: 'verificar', component: Verificar,meta:{requiresAuth: true}},
      { path: 'verifica', component: Verifica,meta:{requiresAuth: true}},
      { path: 'regtramite', component: Regtramite,meta:{requiresAuth: true}},
      { path: 'direcciontrbutaria', component: Direcciontributaria,meta:{requiresAuth: true}},
      { path: 'infraestructura', component: Infraestructura,meta:{requiresAuth: true}},
      { path: 'seguridadciudadana', component: Seguridadciudadana,meta:{requiresAuth: true}},
      { path: 'medioambiente', component: Medioambiente,meta:{requiresAuth: true}},
      { path: 'salubridad', component: Salubridad,meta:{requiresAuth: true}},
      { path: 'activiadeseconomicas', component: Actividadeseconomicas,meta:{requiresAuth: true}},
      { path: 'consultartramite', component: Consultartramite,meta:{requiresAuth: true}},
      { path: 'entregartramite', component: Entregartramite,meta:{requiresAuth: true}},
      { path: 'modifica', component: Modifica,meta:{requiresAuth: true}},
      { path: 'multa', component: Multa,meta:{requiresAuth: true}},
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
