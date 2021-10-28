<template>
  <q-page class="q-pa-xs">
    <q-card>
      <div class="text-h6 text-center bg-accent text-white">REGISTRO DE TRAMITES NUEVOS</div>
      <q-form @submit.prevent="consultar">
        <div class="row">
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

      <div>
          <q-input v-model="regvutrat" type="text" label="Vutrat" readonly />
      </div>
      <q-table
       title="Pagos"
        :columns="columns"
        :rows="pagos"
        row-key="padron"
      />

    </q-card>
  </q-page>
</template>

<script>
import {date} from "quasar";
import { jsPDF } from "jspdf";
export default {
  // name: 'Local',
  data(){
    return{
      fecha:'',
      req:[],
      ntramite:'',
      tipo:'',
      tramitador:'',
      validar:'',
      actividad:[],
      caso:'',
      filer:'',
      re:{},
      cumple:true,
      requisitos:[],
      model:{id:0,label:'',gestion:0,tipo:'n'},
      options:[
        {id:0,label:'',gestion:0,tipo:'n'}
      ],
      options2:[
        {id:0,label:'',gestion:0,tipo:'n'}
      ],
      regvutrat:'',
      columns:[
         { name: 'padron', label: 'padron', field: 'padron', required: true,},
         { name: 'gestion', label: 'gestion', field: 'gestion'},
         { name: 'fech_pago', label: 'fecha pago', field: 'fech_pago'},
         { name: 'importe', label: 'Importe', field: 'imp_pagar'},
      //   { name: 'action', label: 'action', field: 'action'},
      ],
      pagos:[],
    }
  },
  created(){
        this.$q.loading.show()
        this.$axios.get(process.env.API+'/contribuyente').then(res=> {
          console.log(res.data)
          this.$q.loading.hide()
          // this.options=res.data
          this.options = [{id: 0, label: '', gestion: 0, tipo: 'n'}]
          this.options2 = [{id: 0, label: '', gestion: 0, tipo: 'n'}]
          if (res.data.length > 0) {
            res.data.forEach(r => {
              let dat={
                id: r.padron,
                label: r.padron + '' + r.nombre + ' TIPO:' + r.tipo,
                gestion: r.gestion,
                tipo: r.tipo,
                dir: r.dir,
                des: r.des,
                ci: r.ci,
              }
              this.options.push(dat)
              this.options2.push(dat)
            })
          }
        })

    this.mifecha()
  },
  methods:{

    consultar(){
      this.$q.loading.show()
      // console.log(this.model);
      this.$axios.post(process.env.API+'/conregistro',{padron:this.model.id,tipo:this.model.tipo,ci:this.model.ci}).then(res=>{
         console.log(res.data);
        if(res.data.length>=1)
        {
          this.validar=res.data[0].estado;
        }
        else this.validar='F';
         if(this.validar=='T') this.regvutrat='Se encuentra Registrado en Vutrat';
          else this.regvutrat='No esta Registrado o Incompleto en Vutrat';

        })
        this.pagos=[];
      this.$axios.post(process.env.API+'/conpagos',{padron:this.model.id}).then(res=>{
        console.log(res.data);
       // res.data.forEach(element => {
          //.log(element[0].padron);
        //  this.pagos.push({padron:element[0].padron,gestion:element[0].gestion,fech_pago:element[0].fech_pago,importe:element[0].imp_pagar});

       // });
       this.pagos=res.data;
        console.log(this.pagos);
        this.$q.loading.hide()
      })
    },

    filterFn (val, update) {
      if (val === '') {
          this.model={id:0,label:'',gestion:0,tipo:'n'};
        update(() => {
          this.options = this.options2;
          // here you have access to "ref" which
          // is the Vue reference of the QSelect
        })
        return
      }

      update(() => {
          this.model={id:0,label:'',gestion:0,tipo:'n'};
        const needle = val.toLowerCase()
        this.options = this.options2.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },


    mifecha(){
      this.fecha=date.formatDate(new Date(),'YYYY-MM-DD HH:mm:ss' )
    },


  }
}
</script>
