<template>
  <q-page class="q-pa-xs">
    <q-card>
      <div class="text-h6 text-center bg-accent text-white">REGISTRO DE TRAMITES NUEVOS</div>
        <q-form
          @submit="crear"
          class="q-gutter-md"
        >
          <div class="row">

          <div class="col-6 q-pa-xs"><q-input outlined label="N° de tramite" v-model="ntramite" required disable/></div>
          <div class="col-6 q-pa-xs"><q-input outlined label="Fecha" v-model="fecha" required disable/></div>
          <div class="col-6 q-pa-xs"><q-select label="Selecionar Caso" v-model="caso" required outlined :options="actividad" /></div>
          <div class="col-6 q-pa-xs"><q-input outlined label="TRAMITADOR" required v-model="tramitador"/></div>
          <div class="row">
          <div class="col-4 q-pa-xs">
            <q-checkbox dense rigth-label v-model="r.estado" :label="r.nombre" v-for="(r,i) in requisitos" :key="i" class="full-width" />
          </div>      

          </div>

          <div class="col-12 " >
            <q-btn label="Crear" class="full-width" type="submit" icon="send" color="primary"/>
          </div>
      </div>
      <div>
      </div>
        </q-form>
          <div class="col-12 " >
            <q-btn label="Registro Datos" class="full-width" icon="grading" color="green" @click="prompt=true"/>
          </div>
    </q-card>

    <q-dialog v-model="prompt" persistent>
      <q-card style="min-width: 350px">
        <q-card-section>
          <div class="text-h6">Registro Nuevo Contribuyente</div>
        </q-card-section>
        <q-form @submit="onSubmit">
          <q-select dense filled v-model="tram" :options="tramites" label="Nro Tramites" />
                <q-card-section>
          <div class="text-h6" align:center>DATOS DE CONTRIBUYENTE</div>
        <q-tabs
          v-model="tab"
          dense
          class="text-grey"
          active-color="primary"
          indicator-color="primary"
          align="justify"
          narrow-indicator
        >
          <q-tab name="N" label="NATURAL" />
          <q-tab name="J" label="JURIDICO" />
        </q-tabs>
        <div class="row">
          <div class="col-6">
            <q-input outlined v-model="contrib.cedula" label="Outlined" />
          </div>
          <div class="col-6">
            <q-select dense filled v-model="contrib.expedido" :options="exp" label="Expedido" />
          </div>
        </div>
            "nombres"
            "paterno"
            "materno"
            "esposo"
            "telefono"
            "telofi"
            "direccion"
            "calle"
            "numero"
            "casilla"
            "fax"
            "extrangero"
            "numeroextrangero"
            "numerodni"
            "zona"
            "nit"
        </q-card-section> 
        <q-card-actions align="right" class="text-primary">
          <q-btn flat label="Cancel" v-close-popup />
          <q-btn flat label="Add address" v-close-popup />
        </q-card-actions>
        </q-form>
      </q-card>
    </q-dialog>
 
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
      exp:['OR','LP','PT','PD','SC','CB','CH','TJ','BN','EX'],
      prompt:false,
      tab:'N',
      tramites:[],
      req:[],
      ntramite:'',
      tipo:'',
      tramitador:'',
      tram:'',
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
      contrib:{},
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
    this.regini()
    this.mifecha()
    this.minum()
    this.miscasos()
  },
  methods:{
    regini(){
      this.$axios.get(process.env.API+'/listregistro').then(res=>{
        this.tramites=[];
        console.log(res.data);
        res.data.forEach(element => {
          this.tramites.push({label:element.nrotramite,value:element});
        });
      });

    },
    requisito(){
      console.log(this.caso);
    },
    miscasos(){
      this.actividad=[];
      this.$axios.get(process.env.API+'/caso').then(res=>{

        res.data.forEach(element => {
          this.actividad.push({label:element.clasificacion + ' ' + element.caso+' '+ element.inicio+'-'+element.fin+' tipo:'+element.tipo
          ,value:{id:element.id,tipo:element.tipo}});
        });
        console.log(this.actividad);
      })

    },
    cambio(caso){
      // console.log(caso)
      this.requisitos=[]
      this.$q.loading.show()
        this.$axios.post(process.env.API+'/listrequisito',caso).then(res=>{
         // console.log(res.data)
          this.$q.loading.hide()
         res.data.forEach(element => {
          this.requisitos.push({id:element.id,nombre:element.nombre,estado:false});
          this.cumple=true;
         });
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
    minum(){
      this.$axios.get(process.env.API+'/tramite/create').then(res=>{
        console.log(res.data)
        let num=parseInt( res.data.nrotramite.substring(0,5)) +1
        this.ntramite=this.zfill(num,5)+'/'+date.formatDate(new Date(),'YY' )
      })
    },
    crear(){

      this.$axios.post(process.env.API+'/tramite',{
        nrotramite:this.ntramite,
        caso:this.caso.value,
        detalle:this.caso.label,
        tramitador:this.tramitador
      }).then(res=>{
        // console.log(res.data)
        // return false
           let myWindowr = window.open("", "Imprimir", "width=200,height=100");
            myWindowr.document.write(res.data);
            myWindowr.focus();
            myWindowr.document.close();
            setTimeout(function(){
              myWindowr.print();
              myWindowr.close();
              // impDetalle(response);
              //    impAniv(response);

               },500);
        this.minum()
        this.mifecha()
        this.tramitador=''

        this.$q.notify({
          color:'positive',
          icon:'send',
          message:'Guardado correctamente'
        })
        this.caso='';
        this.model='';
        this.requisitos=[];
      }).catch(err=>{
        this.$q.loading.hide()
        this.$q.notify({
          message:err.response.data.message,
          color:'red',
          icon:'error'
        })
      })
    },

          imprimir(i){
      // console.log(i)
      var doc = new jsPDF('p','cm','letter')
      // console.log(dat);
      doc.setFont("courier");
      doc.setFontSize(10);
      var x=0,y=0;
      doc.text(x+1, y+1, 'Nro Tramite: '+this.ntramite);
      doc.text(x+1, y+1.5, 'Tramitador: '+this.tramitador);
      doc.text(x+1, y+2, 'Categoria: '+ this.caso.label);
      doc.text(x+1, y+2.5, 'Tipo: '+ this.model.tipo);
      doc.text(x+1, y+3, 'Fecha:' +this.fecha);

        window.open(doc.output('bloburl'), '_blank');
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
