@@ -0,0 +1,148 @@
<template>
  <q-page>
    <div class="row">
      <div class="col-12">
        <q-banner dense inline-actions class="text-white bg-red text-center text-bold">
          ACTIVIDADES ECONOMICAS -VERIFICAR
        </q-banner>
      </div>
      <div class="col-12">
        <q-table
          title="Mis tramites"
          :columns="columns"
          :rows="tramites"
          :filter="filter"
        >
          <template v-slot:top-right>
            <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">
              <template v-slot:append>
                <q-icon name="search" />
              </template>
            </q-input>
          </template>
          <template v-slot:body="props">
            <q-tr :props="props">
              <q-td key="tramitador" :props="props">
                {{ props.row.tramitador }}
              </q-td>
              <q-td key="tipo" :props="props">
                <q-badge :color="props.row.tipo=='A'?'green':'warning'">
                  {{ props.row.tipo }}
                </q-badge>
              </q-td>
              <q-td key="clasificacion" :props="props">
                <q-badge :color="props.row.tipo=='A'?'green':'warning'">
                  {{ props.row.clasificacion }}
                </q-badge>
              </q-td>
              <q-td key="tramite" :props="props">
                {{ props.row.tramite }}
              </q-td>
              <q-td key="fecha" :props="props">
                {{ props.row.fecha }}
              </q-td>
              <q-td key="dias" :props="props">
                <q-badge :color="props.row.dias<=1?'green':props.row.dias==2?'warning':'negative'">
                  {{ props.row.dias }}
                </q-badge>
              </q-td>
              <q-td key="estado" :props="props">
                <q-badge :color="props.row.estado=='ENPROCESO'?'green':'warning'">
                  {{ props.row.estado }}
                </q-badge>
              </q-td>
              <q-td key="unidad" :props="props">
                {{ props.row.unidad }}
              </q-td>
              <q-td key="action" :props="props">
                <q-btn color="teal" label="Ver " icon="code" size="xs" @click="ver(props.row)"/>
                <!--              <q-btn color="negative" label="Dar alta" icon="login" size="xs" @click="daralta(props.row)"/>-->
              </q-td>
            </q-tr>
          </template>
        </q-table>
        <q-dialog v-model="dialogtramite">
          <q-card style="width: 700px;min-width: 70vh">
            <q-card-section><div class="text-h6">Informacion del tramite</div></q-card-section>
            <q-card-section class="q-pt-none">
              <ul>
                <li v-for="(r,i) in misrequisitos" :key="i">{{r.nombre}}</li>
              </ul>
            </q-card-section>
            <q-card-section aling="right">
              <q-btn flat label="ok" icon="delete" color="negative" v-close-popup/>
            </q-card-section>
          </q-card>
        </q-dialog>
      </div>
    </div>
  </q-page>
</template>
<script>
import {date} from "quasar";

export default {
  data(){
    return{
      columns:[
        { name: 'tramitador', label: 'tramitador', field: 'tramitador'},
        { name: 'tipo', label: 'tipo', field: 'tipo'},
        { name: 'clasificacion', label: 'clasificacion', field: 'clasificacion'},
        { name: 'tramite', label: 'tramite', field: 'tramite'},
        { name: 'dias', label: 'dias', field: 'dias'},
        { name: 'estado', label: 'estado', field: 'estado'},
        { name: 'unidad', label: 'unidad', field: 'unidad'},
        { name: 'action', label: 'action', field: 'action'},
      ],
      tramites:[],
      filter:'',
      tramite:{},
      dialogtramite:false,
    }
  },
  created(){
    this.mistramites()
  },
  methods:{
    ver(tramite){
      // console.log(tramite)
      this.tramite=tramite
      this.dialogtramite=true
    },
    mistramites(){
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/mistramites').then(res=>{
        // console.log(res.data)
        this.tramites=[]
        res.data.forEach(r=>{
          const date1 = new Date()
          const date2 = date.extractDate(r.fecha, 'YYYY-MM-DD')
          const unit = 'days'
          const diff = date.getDateDiff(date1, date2, unit)
          this.tramites.push({
            'tramitador':r.tramitador,
            'id':r.id,
            'tipo':r.tipo,
            'clasificacion':r.caso.clasificacion,
            'usuario':r.user.name,
            'tramite':r.nrotramite,
            'fecha':r.fecha,
            'dias':diff,
            'estado':r.estado2,
            'unidad':r.estado,
            'requisitos':r.requisitos
          })
        })
        this.$q.loading.hide()
      }).catch(err=>{
        this.$q.loading.hide()
        this.$q.notify({
          message:err.response.data.message,
          color:'red',
          icon:'error'
        })
      })
    }
  }
}
</script>
