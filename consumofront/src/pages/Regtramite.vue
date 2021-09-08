<template>
  <q-page class="q-pa-xs">
    <q-card>
      <div class="text-h6 text-center bg-accent text-white">REGISTRO DE TRAMITES NUEVOS</div>
      <q-form @submit.prevent="crear">
        <div class="row">
<!--          <div class="col-6 q-pa-xs"><q-input outlined label="N° de tramite" v-model="ntramite" required disable/></div>-->
<!--          <div class="col-6 q-pa-xs"><q-input outlined label="Fecha" v-model="fecha" required disable/></div>-->
<!--          <div class="col-6 q-pa-xs"><q-select v-model="tipo" required outlined :options="[{id:1,label:'REGISTRO ACTIVIDAD ECONOMICA'},{id:2,label:'RENOVACION LICENCIA'}]"/></div>-->
<!--          <div class="col-6 q-pa-xs"><q-input outlined label="TRAMITADOR" required v-model="tramitador"/></div>-->
<!--          <div class="col-12 " >-->
<!--            <q-btn label="Crear" class="full-width" type="submit" icon="send" color="primary"/>-->
<!--          </div>-->
          <div class="col-8 q-pa-xs">
            <q-select
              filled
              v-model="model"
              use-input
              input-debounce="0"
              label="Contribuyente"
              :options="options"
              @filter="filterFn"
              behavior="menu"
              @keyup="cambio"
            >
              <template v-slot:no-option>
                <q-item>
                  <q-item-section class="text-grey">
                    No results
                  </q-item-section>
                </q-item>
              </template>
            </q-select>
          </div>
          <div class="col-2 q-pa-xs">
<!--            <div class="text-4"></div>-->
            <q-badge color="primary" :label="model.gestion"/>
          </div>
          <div class="col-2 q-pa-xs">
            <q-badge color="secondary" :label="model.tipo"/>
          </div>
        </div>
      </q-form>
<!--      <q-table-->
<!--        title="Contribuyente"-->
<!--        :columns="columns"-->
<!--        :rows="contribuyentes"-->
<!--      >-->
<!--        <template v-slot:top-right>-->
<!--          <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">-->
<!--            <template v-slot:append>-->
<!--              <q-icon name="search" />-->
<!--            </template>-->
<!--          </q-input>-->
<!--        </template>-->
<!--      </q-table>-->
    </q-card>
  </q-page>
</template>

<script>
import {date} from "quasar";
export default {
  // name: 'Local',
  data(){
    return{
      fecha:'',
      ntramite:'',
      tipo:'',
      tramitador:'',
      model:{id:0,label:'',gestion:0,tipo:'n'},
      options:[
        {id:0,label:'',gestion:0,tipo:'n'}
      ]
      // contribuyentes:[],
      // columns:[
      //   { name: 'padron', label: 'padron', field: 'padron'},
      //   { name: 'paterno', label: 'paterno', field: 'paterno'},
      //   { name: 'materno', label: 'materno', field: 'materno'},
      //   { name: 'cedula', label: 'cedula', field: 'cedula'},
      //   { name: 'expedido', label: 'expedido', field: 'expedido'},
      //   { name: 'celular', label: 'celular', field: 'celular'},
      //   { name: 'direccion', label: 'direccion', field: 'direccion'},
      //   { name: 'telefono', label: 'telefono', field: 'telefono'},
      //   { name: 'tipo', label: 'tipo', field: 'tipo'},
      //   { name: 'action', label: 'action', field: 'action'},
      // ]
    }
  },
  created(){
    this.mifecha()
    this.minum()
    // this.actualizar();
    //   setInterval(this.actualizar, 1000);

    // console.log('aa')
    // setTimeout(() => {
    //   console.log("Refresh")
    // }, 1000)
    // console.log('ias')
    // window.location.reload(true)
    // this.$q.loading.show()
    // this.$axios.get(process.env.API+'/contribuyente').then(res=>{
    //   console.log(res.data)
    //   // this.contribuyentes=res.data
    //   this.$q.loading.hide()
    // })
  },
  methods:{
    cambio(){
      console.log(this.model)
    },
    filterFn(val, update){
      if (val === '') {
        update(() => {
          this.options = [{id:0,label:'',gestion:0,tipo:'n'}],
            this.model={id:0,label:'',gestion:0,tipo:'n'}
        })
        return
      }

      update(() => {
        // const needle = val.toLowerCase()
        this.$axios.get(process.env.API+'/buscarcon/'+val.toLowerCase()).then(res=>{
          // console.log(res.data)
          // this.options=res.data
          this.options=[{id:0,label:'',gestion:0,tipo:'n'}]
          if (res.data.length>0){
            res.data.forEach(r=>{
              this.options.push({
                id:r.padron,
                label:r.nombre,
                gestion:r.gestion,
                tipo:r.tipo,
              })
            })
          }

        })
        // this.options.value = stringOptions.filter(v => v.toLowerCase().indexOf(needle) > -1)
      })
    },
    mifecha(){
      this.fecha=date.formatDate(new Date(),'YYYY-MM-DD HH:mm:ss' )
    },
    minum(){
      this.$axios.get(process.env.API+'/tramite/create').then(res=>{
        let num=parseInt( res.data.n_tramite.substring(0,5)) +1
        this.ntramite=this.zfill(num,5)+'/'+date.formatDate(new Date(),'YY' )
      })
    },
    crear(){
      // console.log('a')
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/tramite',{
        n_tramite:this.ntramite,
        tipo_tram:this.tipo.id,
        tramitador:this.tramitador,
      }).then(res=>{
        console.log(res.data)
        this.minum()
        this.mifecha()
        this.tramitador=''
        this.$q.loading.hide()
        this.$q.notify({
          color:'positive',
          icon:'send',
          message:'Guardado correctamente'
        })
      })
    },
    zfill(number, width) {
      var numberOutput = Math.abs(number); /* Valor absoluto del número */
      var length = number.toString().length; /* Largo del número */
      var zero = "0"; /* String de cero */

      if (width <= length) {
        if (number < 0) {
          return ("-" + numberOutput.toString());
        } else {
          return numberOutput.toString();
        }
      } else {
        if (number < 0) {
          return ("-" + (zero.repeat(width - length)) + numberOutput.toString());
        } else {
          return ((zero.repeat(width - length)) + numberOutput.toString());
        }
      }
    }
  }
}
</script>
