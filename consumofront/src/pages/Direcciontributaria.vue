<template>
  <q-page class="q-pa-xs">
    <q-card>
      <q-badge class="text-h6 full-width text-center" color="secondary" >Direccion tributaria</q-badge>
      <q-btn @click="mistramites" icon="refresh" label="consultar" color="secondary" class="q-mt-xs"/>
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
      </q-table>
    </q-card>
  </q-page>
</template>

<script>
import { date } from 'quasar'
const { addToDate } = date


export default {
  // name: 'Local',
  data(){
    return{
      filter:'',
      // contribuyentes:[],
      columns:[
        { name: 'tramitador', label: 'tramitador', field: 'tramitador'},
        { name: 'tipo', label: 'tipo', field: 'tipo'},
        { name: 'clasificacion', label: 'clasificacion', field: 'clasificacion'},
        { name: 'usuario', label: 'usuario', field: 'usuario'},
        { name: 'fecha', label: 'fecha', field: 'fecha'},
        { name: 'dias', label: 'dias', field: 'dias'},
        { name: 'estado', label: 'estado', field: 'estado'},
        { name: 'unidad', label: 'unidad', field: 'unidad'},
        // { name: 'tipo', label: 'tipo', field: 'tipo'},
        { name: 'action', label: 'action', field: 'action'},
      ],
      tramites:[]
    }
  },
  created(){
    // console.log('aa')
    // setTimeout(() => {
    //   console.log("Refresh")
    // }, 1000)
    // console.log('ias')
    // window.location.reload(true)

    this.mistramites()
  },
  methods:{
    mistramites(){
      this.$q.loading.show()
      this.$axios.get(process.env.API+'/direccion').then(res=>{
        console.log(res.data)
        this.tramites=[]


        res.data.forEach(r=>{
          const date1 = new Date()
          const date2 = date.extractDate(r.fecha, 'YYYY-MM-DD')
          const unit = 'days'
          const diff = date.getDateDiff(date1, date2, unit)
          // console.log(diff)

          this.tramites.push({
            'tramitador':r.tramitador,
            'tipo':r.tipo,
            'clasificacion':r.caso.clasificacion,
            'usuario':r.user.name,
            'fecha':r.fecha,
            'dias':diff,
            'estado':r.estado2,
            'unidad':r.estado,
            'action':'',
          })
        })

        // this.contribuyentes=res.data
        this.$q.loading.hide()
      })
    }
  }
}
</script>
