<template>
  <q-page class="q-pa-xs">
    <q-card>
      <div class="text-h6 text-center bg-accent text-white">REGISTRO DE TRAMITES NUEVOS</div>
      <q-form @submit.prevent="consultar">
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
            <br>
            <q-badge color="accent" :label="model.dir"/>
          </div>
          <div class="col-2 q-pa-xs">
            <q-badge color="secondary" :label="model.tipo"/>
            <br>
            <q-badge color="positive" :label="model.des"/>
          </div>
          <div class="col-12 q-pa-xs flex flex-center">
<!--            <q-badge color="secondary" :label="model.tipo"/>-->
            <q-btn label="Consultar" icon="search" color="primary" type="submit"/>
          </div>
        </div>
      </q-form>
      <q-table
       title="Pagos"
        :columns="columns"
        :rows="contribuyentes"
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
import {date} from "quasar";
export default {
  // name: 'Local',
  data(){
    return{
      fecha:'',
      ntramite:'',
      tipo:'',
      tramitador:'',
      validar:'',
      model:{id:0,label:'',gestion:0,tipo:'n'},
      options:[
        {id:0,label:'',gestion:0,tipo:'n'}
      ],
      pagos:[],
      columns:[
         { name: 'padron', label: 'padron', field: 'padron'},
         { name: 'gestion', label: 'gestion', field: 'gestion'},
         { name: 'fech_pago', label: 'fecha pago', field: 'fech_pago'},
         { name: 'importe', label: 'Importe', field: 'imp_pagar'},
      //   { name: 'action', label: 'action', field: 'action'},
      ]
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
    consultar(){
      console.log(this.model);
      this.$axios.post(process.env.API+'/conregistro',{padron:this.model.id,tipo:this.model.tipo_tram,ci:this.model.ci}).then(res=>{
        console.log(res.data);
        if(res.data.length>0)
        {
          this.validar=res.data[0].estado;
        }
        else this.validar='F';
        })
      this.$axios.post(process.env.API+'/conpagos',{padron:this.model.id}).then(res=>{
        console.log(res.data);
        this.pagos=res.data;  
      })
    },
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
                label:r.padron+''+r.nombre + ' TIPO:'+r.tipo,
                gestion:r.gestion,
                tipo:r.tipo,
                dir:r.dir,
                des:r.des,
                ci:r.ci,
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
