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

    <q-dialog maximized  v-model="prompt" persistent>
      <q-card style="min-width: 350px">
        <q-card-section>
          <div class="text-h6">Registro Nuevo Contribuyente</div>
        </q-card-section>
        <q-form @submit.prevent="registrar" @reset="reset">
          <q-select dense filled v-model="tram" :options="tramites" label="Nro Tramites" @update:model-value="cambio(tram.value)"/>
                <q-card-section>
          <div class="text-h6 text-center" >DATOS DE CONTRIBUYENTE</div>
        <q-tabs
          v-model="tab"
          dense
          class="text-grey"
          active-color="white"
          indicator-color="primary"
          active-bg-color="accent"
          align="justify"
          narrow-indicator
        >
          <q-tab name="N" label="NATURAL" />
          <q-tab name="J" label="JURIDICO" />
        </q-tabs>
        <div class="row">
          <div class="col-4">
          <q-checkbox rigth-label v-model="r.estado" :label="r.nombre" v-for="(r,i) in requisitos" :key="i" class="full-width" />
          </div>
          <div class="col-8">
          <div class="row">
          <div class="col-6">
            <q-input dense outlined v-model="contrib.cedula" label="Cedula de Identidad" @change="buscarcontrib" :rules="[ val => val.length >3 || 'Ingrese cedula' ]"/>
          </div>
          <div class="col-6">
            <q-select dense filled v-model="contrib.expedido" :options="exp" label="Expedido" required />
          </div>
          <div class="row">
            <div class="col-3"><q-input dense outlined v-model="contrib.paterno" label="Paterno" /></div>
            <div class="col-3"><q-input dense outlined v-model="contrib.materno" label="Materno" /></div>
            <div class="col-3"><q-input dense outlined v-model="contrib.nombres" label="Nombres" :rules="[ val => val.length > 3 || 'Ingrese su nombre' ]"/></div>
            <div class="col-3"><q-input dense outlined v-model="contrib.esposo" label="Ap. Esposo" /></div>
          </div>
          <div class="row">
            <div class="col-3"><q-input dense outlined v-model="contrib.nit" label="NIT" /></div>
            <div class="col-3"><q-input dense outlined v-model="contrib.domicilio" label="zona/domicilio" /></div>
            <div class="col-3"><q-input dense outlined v-model="contrib.calle" label="Calle" /></div>
            <div class="col-3"><q-input dense outlined v-model="contrib.numero" label="Numero Casa" /></div>
          </div>
          <div class="row">
            <div class="col-3"><q-input dense outlined v-model="contrib.telefono" label="Telefono" /></div>
            <div class="col-3"><q-input dense outlined v-model="contrib.telofi" label="Telf Oficina" /></div>
            <div class="col-3"><q-input dense outlined v-model="contrib.casilla" label="Casilla" /></div>
            <div class="col-3"><q-input dense outlined v-model="contrib.fax" label="FAX" /></div>
          </div>
          <div class="row">
            <div class="col-4"><q-checkbox dense v-model="contrib.extrangero" label="Extrangero" /></div>
            <div class="col-4"><q-input dense outlined v-model="contrib.numeroextrangero" label="Nro Extrang" /></div>
            <div class="col-4"><q-input dense outlined v-model="contrib.numerodni" label="Nro DNI" /></div>
          </div>
          </div>
                    <div class="text-h6 text-center" >DATOS Y UBICACION DE LA ACTIVIDAD</div>
          <div class="row">
            <div class="col-9"><q-input dense outlined v-model="negact" label="Actividad" readonly /></div>
            <div class="col-3"><q-input dense outlined v-model="neghora" label="Horario" readonly/></div>

          </div>
          <div class="row">

            <div class="col-9"><q-input dense outlined v-model="negocio.razon" label="Nombre" :rules="[ val => val.length > 3 || 'Ingrese Datos' ]"/></div>
          </div>
          <div class="row">

            <div class="col-9"><q-input dense outlined v-model="negocio.descripcionactividad" label="Descripcion" :rules="[ val => val.length > 3 || 'Ingrese Datos' ]"/></div>
            <div class="col-3"><q-input dense outlined v-model="negocio.mts2" label="Sup mts2" /></div>
          </div>
          <hr>
          <div class="row">
            <div class="col-3"><q-input dense outlined v-model="negocio.zona" label="Zona" /></div>
            <div class="col-3"><q-input dense outlined v-model="negocio.barrio" label="Barrio" /></div>
            <div class="col-3"><q-input dense outlined v-model="negocio.calle" label="AV/Calle" /></div>
            <div class="col-3"><q-input dense outlined v-model="negocio.entrecalles" label="Entre Calles" /></div>
          </div>
          <div class="row">
            <div class="col-3"><q-input dense outlined v-model="negocio.numpiso" label="Nro Piso" /></div>
            <div class="col-3"><q-input dense outlined v-model="negocio.telefono" label="Telefono" /></div>
            <div class="col-3"><q-input dense outlined v-model="negocio.numeroagua" label="No Med Agua" /></div>
            <div class="col-3"><q-input dense outlined v-model="negocio.numeroelectrico" label="No Med Elec" /></div>
          </div>
          <div class="row">
            <div class="col-4"><q-input dense outlined v-model="negocio.observacion" label="Observacion" /></div>
            <div class="col-2"><q-checkbox v-model="negocio.fachada" label="Fachada" /></div>
            <div class="col-2"><q-checkbox v-model="negocio.acera" label="Acera" /></div>
            <div class="col-2"><q-checkbox v-model="negocio.iluminacion" label="Iluminacion" /></div>
            <div class="col-2"><q-checkbox v-model="negocio.letrero" label="Letrero" /></div>
          </div>

          <div class="row">
            <q-radio v-model="negocio.establecimiento" val="PROPIO" label="PROPIO" />
            <q-radio v-model="negocio.establecimiento" val="ALQUILADO" label="ALQUILADO" />
            <q-radio v-model="negocio.establecimiento" val="ANTICRETICO" label="ANTICRETICO" />
            <q-radio v-model="negocio.establecimiento" val="OTROS" label="OTROS" />
          </div>
        </div>

            </div>
        </q-card-section>
        <q-card-actions align="right" class="text-primary">
          <q-btn  label="CANCELAR" v-close-popup color="red"/>
          <q-btn  label="REGISTRAR" type="submit"  color="green"/>
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
      exp:['OR','LP','PT','PD','SC','CB','CH','TJ','BE','EX'],
      prompt:false,
      negocio:{},
      tab:'N',
      tramites:[],
      req:[],
      ntramite:'',
      tipo:'',
      tramitador:'',
      tram:'',
      validar:'',
      actividad:[],
      actividades:[],
      sectores:[],
      act:{label:''},
      negact:'',
      neghora:'',
      sect:'',
      caso:'',
      filer:'',
      re:{},
      cumple:true,
      requisitos:[],
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
    this.listadoactividad()
    this.reset()
  },
  methods:{
    buscarcontrib(){
      this.$axios.post(process.env.API+'/buscarcontrib/'+this.contrib.cedula).then(res=>{
        let resulta=this.contrib.cedula
        // console.log(res.data)
          if(res.data.length>0)
            this.contrib=res.data[0];
          else {this.reset
          this.contrib.cedula=resulta;
          
          }
      })

    },
    listadoactividad(){
      this.$axios.get(process.env.API+'/listactividad').then(res=>{
        console.log(res.data);
        this.actividades=[];
        res.data.forEach(element => {
          this.actividades.push({label:element.detalle,value:element});
        });
      })
    },
    listadosector(actividad){
      this.$axios.get(process.env.API+'/lsector/'+actividad.value.sector_id).then(res=>{
        this.sectores=res.data.detalle;
      })
    },
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
       console.log(caso)
       this.negocio.letrero=false;
       this.negocio.iluminacion=false;
       this.negocio.acera=false;
       this.negocio.fachada=false;
       this.contrib.extrangero=false;
       this.negact=caso.caso.clasificacion + ' ' +caso.caso.caso;
       this.neghora= caso.caso.inicio + ' - ' + caso.caso.fin;
       this.contrib.expedido=this.exp[0];

      this.requisitos=[]
        this.$axios.post(process.env.API+'/listrequisito',caso).then(res=>{
         // console.log(res.data)
         res.data.forEach(element => {
          this.requisitos.push({id:element.id,nombre:element.nombre,estado:false});
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
        this.regini();
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

  registrar(){
      this.negocio.tipo=this.tab;
      this.$axios.post(process.env.API+'/regnegocio',{
        contribuyente:this.contrib,
        tramite:this.tram.value,
        negocio:this.negocio,
        requisito:this.requisitos
      }).then(res=>{

      console.log(res.data);
      this.contrib={};
      this.negocio={};
      this.regini();
      this.prompt=false;
      this.requisitos=[];

        this.$q.notify({
          color:'positive',
          icon:'send',
          message:'Guardado correctamente'
        });
      }).catch(err=>{
        this.$q.loading.hide()
        this.$q.notify({
          message:err.response.data.message,
          color:'red',
          icon:'error'
        })
      })
    },
    reset(){
            this.contrib.id="";
            this.contrib.nombres="";
            this.contrib.paterno="";
            this.contrib.materno="";
            this.contrib.esposo="";
            this.contrib.cedula="";
            this.contrib.expedido={};
            this.contrib.telefono="";
            this.contrib.telofi="";
            this.contrib.domicilio="";
            this.contrib.calle="";
            this.contrib.numero="";
            this.contrib.casilla="";
            this.contrib.fax="";
            this.contrib.extrangero=false;
            this.contrib.numeroextrangero='';
            this.contrib.numerodni='';
            this.contrib.zona='';
            this.contrib.nit='';

            this.negocio.actividad={};
            this.negocio.sector='';
            this.negocio.razon='';
            this.negocio.descripcionactividad='';
            this.negocio.telefono='';
            this.negocio.numpiso='';
            this.negocio.horario='';
            this.negocio.mts2='';

            this.negocio.zona='';
            this.negocio.barrio='';
            this.negocio.calle='';
            this.negocio.entrecalles='';
            this.negocio.numeroagua='';
            this.negocio.numeroelectrico='';
            this.negocio.observacion='';

            this.negocio.fachada=false;
            this.negocio.acera=false;
            this.negocio.iluminacion=false;
            this.negocio.letrero=false;

            this.negocio.establecimiento='';

            this.negocio.tipo='';
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
