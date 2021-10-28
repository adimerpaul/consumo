import Direcciontributaria from "pages/Direcciontributaria";
import Infraestructura from "pages/Infraestructura";
import Seguridadciudadana from "pages/Seguridadciudadana";
import Medioambiente from "pages/Medioambiente";
import Salubridad from "pages/Salubridad";
import Actividadeseconomicas from "pages/Actividadeseconomicas";
import Consultartramite from "pages/Consultartramite";
import Entregartramite from "pages/Entregartramite";

export default function () {
  return {
    status: '',
    token: localStorage.getItem('tokenvut') || '',
    user : {},
    booluser : false,
    boolregtramite : false,
    boolform19 : false,
    direcciontrbutaria:false,
    infraestructura:false,
    seguridadciudadana:false,
    medioambiente:false,
    salubridad:false,
    activiadeseconomicas:false,
    consultartramite:false,
    entregartramite:false,
    boolregistrarmulta:false,
    boolverifica:false,
    booltecnico:false,
    boolcomprobante:false,
    boolaprobacion:false,
    pedido:[]
  }
}
