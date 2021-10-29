<template>
  <q-layout view="lHh Lpr lFf">
    <q-header >
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />

        <q-toolbar-title>
          {{$store.state.login.user.name}}
        </q-toolbar-title>
        <div><div><q-btn @click="logout" label="Salir" icon="logout" size="xs"/></div></div>
      </q-toolbar>
      <div class="q-px-lg q-pt-xl q-mb-md">
        <div class="text-h3">G.A.M.O.</div>
        <div class="text-subtitle1">{{now}} </div>
      </div>
      <q-img
        src="~assets/mountains.jpg"
        class="header-image absolute-top"
      />
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      :width="200"
      :breakpoint="600"
    >
      <q-scroll-area style="height: calc(100% - 192px); margin-top: 192px; border-right: 1px solid #ddd">
        <q-list bordered>
          <q-item to="/" exact clickable v-ripple>
            <q-item-section avatar>
              <q-icon name="home" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Principal</q-item-label>
              <q-item-label caption>Menu de consulta</q-item-label>
            </q-item-section>
          </q-item>
          <q-item to="/login" exact clickable v-ripple v-if="!$store.getters['login/isLoggedIn']">
            <q-item-section avatar>
              <q-icon name="login" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Ingresar</q-item-label>
              <q-item-label caption>Ingresar al sistema</q-item-label>
            </q-item-section>
          </q-item>
          <q-item to="user"  exact clickable v-ripple v-if="$store.state.login.booluser">
            <q-item-section avatar>
              <q-icon name="people" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Usuarios</q-item-label>
              <q-item-label caption>Control de usuarios</q-item-label>
            </q-item-section>
          </q-item>

          <q-item to="verificar"  exact clickable v-ripple v-if="$store.state.login.boolregtramite">
            <q-item-section avatar>
              <q-icon name="search" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Verifica Deudas</q-item-label>
<!--              <q-item-label caption>Iniscio de tramite</q-item-label>-->
            </q-item-section>
          </q-item>

          <q-item to="regtramite"  exact clickable v-ripple v-if="$store.state.login.boolregtramite">
            <q-item-section avatar>
              <q-icon name="login" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Inicio tramite</q-item-label>
<!--              <q-item-label caption>Iniscio de tramite</q-item-label>-->
            </q-item-section>
          </q-item>

          <q-item to="modifica"  exact clickable v-ripple v-if="$store.state.login.boolregtramite">
            <q-item-section avatar>
              <q-icon name="update" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Actualizar datos</q-item-label>
<!--              <q-item-label caption>Iniscio de tramite</q-item-label>-->
            </q-item-section>
          </q-item>

<!--          <q-item to="direcciontrbutaria"  exact clickable v-ripple v-if="$store.state.login.direcciontrbutaria">-->
<!--            <q-item-section avatar>-->
<!--              <q-icon name="list" />-->
<!--            </q-item-section>-->
<!--            <q-item-section>-->
<!--              <q-item-label> Direccion tributaria</q-item-label>-->
<!--              <q-item-label caption>Registro de datos</q-item-label>-->
<!--            </q-item-section>-->
<!--          </q-item>-->

<!--          <q-item to="infraestructura"  exact clickable v-ripple v-if="$store.state.login.infraestructura">-->
<!--            <q-item-section avatar>-->
<!--              <q-icon name="list" />-->
<!--            </q-item-section>-->
<!--            <q-item-section>-->
<!--              <q-item-label> Infraestructura</q-item-label>-->
<!--              <q-item-label caption>Registro de datos</q-item-label>-->
<!--            </q-item-section>-->
<!--          </q-item>-->
<!--          <q-item to="seguridadciudadana"  exact clickable v-ripple v-if="$store.state.login.seguridadciudadana">-->
<!--            <q-item-section avatar>-->
<!--              <q-icon name="list" />-->
<!--            </q-item-section>-->
<!--            <q-item-section>-->
<!--              <q-item-label> Seguridad ciudadana</q-item-label>-->
<!--              <q-item-label caption>Registro de datos</q-item-label>-->
<!--            </q-item-section>-->
<!--          </q-item>-->
<!--          <q-item to="medioambiente"  exact clickable v-ripple v-if="$store.state.login.medioambiente">-->
<!--            <q-item-section avatar>-->
<!--              <q-icon name="home" />-->
<!--            </q-item-section>-->
<!--            <q-item-section>-->
<!--              <q-item-label> Medio ambiente</q-item-label>-->
<!--              <q-item-label caption>Registro de datos</q-item-label>-->
<!--            </q-item-section>-->
<!--          </q-item>-->
<!--          <q-item to="salubridad"  exact clickable v-ripple v-if="$store.state.login.salubridad">-->
<!--            <q-item-section avatar>-->
<!--              <q-icon name="list" />-->
<!--            </q-item-section>-->
<!--            <q-item-section>-->
<!--              <q-item-label> Salubridad</q-item-label>-->
<!--              <q-item-label caption>Registro de datos</q-item-label>-->
<!--            </q-item-section>-->
<!--          </q-item>-->
<!--          <q-item to="activiadeseconomicas"  exact clickable v-ripple v-if="$store.state.login.activiadeseconomicas">-->
<!--            <q-item-section avatar>-->
<!--              <q-icon name="code" />-->
<!--            </q-item-section>-->
<!--            <q-item-section>-->
<!--              <q-item-label> Actividades economicas</q-item-label>-->
<!--              <q-item-label caption>Registro de datos</q-item-label>-->
<!--            </q-item-section>-->
<!--          </q-item>-->


          <q-item to="consultartramite"  exact clickable v-ripple v-if="$store.state.login.consultartramite">
            <q-item-section avatar>
              <q-icon name="search" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Consultar tramite</q-item-label>
              <q-item-label caption>Registro de datos</q-item-label>
            </q-item-section>
          </q-item>

          <q-item to="entregartramite"  exact clickable v-ripple v-if="$store.state.login.entregartramite">
            <q-item-section avatar>
              <q-icon name="logout" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Entregar tramite</q-item-label>
              <q-item-label caption>Registro de datos</q-item-label>
            </q-item-section>
          </q-item>


          <q-item to="multa"  exact clickable v-ripple v-if="$store.state.login.boolregistrarmulta">
            <q-item-section avatar>
              <q-icon name="policy" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Registro de Multa</q-item-label>
              <q-item-label caption>Multas y sanciones</q-item-label>
            </q-item-section>
          </q-item>

          <q-item to="verifica"  exact clickable v-ripple v-if="$store.state.login.boolverifica">
            <q-item-section avatar>
              <q-icon name="add_circle" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Verificar tramite</q-item-label>
              <q-item-label caption> Verificar tramite</q-item-label>
            </q-item-section>
          </q-item>

          <q-item to="tecnico"  exact clickable v-ripple v-if="$store.state.login.booltecnico">
            <q-item-section avatar>
              <q-icon name="work_outline" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Tecnicos tramite</q-item-label>
              <q-item-label caption> Tecnicos tramite</q-item-label>
            </q-item-section>
          </q-item>
          <q-item to="revisado"  exact clickable v-ripple v-if="$store.state.login.boolcomprobante">
            <q-item-section avatar>
              <q-icon name="assignment_ind" />
            </q-item-section>
            <q-item-section>
              <q-item-label> comprobante tramite</q-item-label>
              <q-item-label caption> comprobante tramite</q-item-label>
            </q-item-section>
          </q-item>
          <q-item to="aprobacion"  exact clickable v-ripple v-if="$store.state.login.boolaprobacion">
            <q-item-section avatar>
              <q-icon name="engineering" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Aprobacion tramite</q-item-label>
              <q-item-label caption> Aprobacion tramite</q-item-label>
            </q-item-section>
          </q-item>

          <q-item @click="logout"  exact clickable v-ripple v-if="$store.getters['login/isLoggedIn']">
            <q-item-section avatar>
              <q-icon name="logout" />
            </q-item-section>
            <q-item-section>
              <q-item-label> Salir</q-item-label>
              <q-item-label caption>Salir del sistema</q-item-label>
            </q-item-section>
          </q-item>

        </q-list>
      </q-scroll-area>

      <q-img class="absolute-top" src="~assets/mountains.jpg" style="height: 192px">
        <div class="absolute-bottom bg-transparent">
          <q-avatar size="56px" class="q-mb-sm">
            <img src="~assets/logo.png">
          </q-avatar>
          <div class="text-weight-bold">G.A.M.O.</div>
          <div>Gobierno autonomo</div>
        </div>
      </q-img>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import {date} from 'quasar';
export default {
  name: 'MainLayout',
  data () {
    return {
      leftDrawerOpen: false,
      // essentialLinks: linksData
    }
  },
  computed:{
    now(){
      let timeStamp = Date.now()
      // let formattedString = date.formatDate(timeStamp, 'dddd D MMMM');
      let formattedString = date.formatDate(timeStamp, 'dddd D MMMM', {
        days: ['Domingo', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo' /* and all the rest of days - remember starting with Sunday */],
        daysShort: ['Dum', 'Lun', /* and all the rest of days - remember starting with Sunday */],
        months: ['Enero', 'Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre', /* and all the rest of months */],
        monthsShort: ['Ian', 'Feb', /* and all the rest of months */]
      })
      return formattedString
    }
  },
  methods:{
    logout(){
      this.$q.loading.show()
      this.$store.dispatch('login/logout')
        .then(() => {
          this.$q.loading.hide()
          this.$router.push('/login')
        })
    }
  }
}
</script>
<style lang="scss">
.header-image{
  height: 100%;
  z-index: -1;
  opacity: 0.2;
  filter: grayscale(100%);
}
</style>
