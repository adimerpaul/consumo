<template>
  <q-page class="q-pa-xs">
    <q-card>
      <q-badge class="text-h6 full-width text-center" color="positive" >Aprobar por salubridad</q-badge>
      <q-btn @click="mistramites" icon="refresh" label="refrescar" color="secondary" class="q-mt-xs"/>
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
              <q-badge :color="props.row.dias==1?'green':props.row.dias==2?'warning':'negative'">
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
            <q-td key="requisitos" :props="props">
              <ul>
                <li v-for="(r,i) in props.row.requisitos" :key="i">
                  <q-badge :label="r.nombre" /></li>
              </ul>
            </q-td>
            <q-td key="action" :props="props">
              <q-btn color="teal" label="Requisitos" icon="list" size="xs" @click="verrequisitos(props.row.requisitos)"/>
              <q-btn color="negative" label="Dar alta" icon="login" size="xs" @click="daralta(props.row)"/>
            </q-td>
          </q-tr>
        </template>
      </q-table>
      <q-dialog v-model="requisitos">
        <q-card>
          <q-card-section><div class="text-h">Requisitos presentados</div></q-card-section>
          <q-card-section class="q-pt-none">
            <ul>
              <li v-for="(r,i) in misrequisitos" :key="i">{{r.nombre}}</li>
            </ul>
          </q-card-section>
          <q-card-section aling="right">
            <q-btn flat label="ok" icon="trash" color="negative" v-close-popup/>
          </q-card-section>
        </q-card>
      </q-dialog>
    </q-card>
  </q-page>
</template>

<script>
import { date } from 'quasar'
const { addToDate } = date


export default {
  data(){
    return{
      filter:'',
      requisitos:false,
      misrequisitos:[],
      columns:[
        { name: 'tramitador', label: 'tramitador', field: 'tramitador'},
        { name: 'tipo', label: 'tipo', field: 'tipo'},
        { name: 'clasificacion', label: 'clasificacion', field: 'clasificacion'},
        { name: 'tramite', label: 'tramite', field: 'tramite'},
        { name: 'fecha', label: 'fecha', field: 'fecha'},
        { name: 'dias', label: 'dias', field: 'dias'},
        { name: 'estado', label: 'estado', field: 'estado'},
        { name: 'unidad', label: 'unidad', field: 'unidad'},
        { name: 'requisitos', label: 'requisitos', field: 'requisitos',    align: 'left'},
        { name: 'action', label: 'action', field: 'action'},
      ],
      tramites:[]
    }
  },
  created(){

    this.mistramites()
  },
  methods:{
    daralta(i){
      let id=i.id
      this.$q.dialog({
        title:'Seguro de dar de alta',
        cancel:true
      }).onOk(()=>{
        this.$axios.put(process.env.API+'/direccion/'+id,{
          estado:'PROCESO',
          nombre:'APROBADO SALUBRIDAD',
          observacion:'APROBADO',
          infraestructura:false,
          seguridad:false,
          medio:false,
          salubridad:true,
        }).then(res=>{
          // console.log(res.data)
          this.mistramites()
        })
      })
    },
    verrequisitos(r){
      this.requisitos=true
      this.misrequisitos=r
    },
    mistramites(){
      this.$q.loading.show()
      this.$axios.get(process.env.API+'/direccion/sa').then(res=>{
        console.log(res.data)
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
      })
    }
  }
}
</script>
