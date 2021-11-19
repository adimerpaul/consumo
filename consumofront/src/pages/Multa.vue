<template>
  <q-page class="q-pa-xs">
    <q-card>
      <div class="text-h6">Historial de Multas</div>
        
        <div>
            <q-select
              filled
              v-model="model"
              use-input
              input-debounce="0"
              label="Contribuyente Licencia"
              :options="options"
              @filter="filterFn"
              behavior="menu"
              @update:model-value="cargar"
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

        <div>
                <h6>DATO DE PROPIETARIO</h6>
                <div class="row">
                    <div class="col-6">Cedula de Identidad: {{contribuyente.cedula}}</div>
                    <div class="col-6">Nombre Completo: {{contribuyente.nombres}} {{contribuyente.paterno}} {{contribuyente.materno}}</div>
                </div>
                <h6>UBICACION DE LA ACTIVIDAD ECONOMICA</h6>
                <div class="row">
                    <div class="col-6">Razon Social: {{negocio.razon}}</div>
                    <div class="col-6">Direccion: {{negocio.calle}}, {{negocio.entrecalles}}</div>
                    <div class="col-6">Piso: {{negocio.numpiso}}</div>
                </div>
                <h6>Datos de Licencia</h6>
                <div class="row">
                    <div class="col-6">Clasificacion: {{caso.clasificacion}}</div>
                    <div class="col-6">Dias:{{caso.caso}}</div>
                    <div class="col-3">Horario: {{caso.inicio}} - {{caso.fin}}</div>
                </div>
        </div>
    <div>
        <q-btn color="amber" label="Registrar Sancion" @click="onReg" />
            <q-dialog v-model="dialog_multa" >
      <q-card style="min-width: 350px">
        <q-card-section>
          <div class="text-h6">Registrar Sancion</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
            Representante {{contribuyente.nombres}} {{contribuyente.paterno}} {{contribuyente.materno}}
          <div>
              <q-select :options="multas" label="Tipo de Infraccion" v-model="sancion" @update:model-value="verificar"/>
              <q-select :options="detallemultas" label="Infraccion" v-model="detalle" @update:model-value="llenar"/>
          </div>
          <div class="row">

              <div class="col-6"><q-input readonly label="Dias Suspencion" v-model="regmulta.dia"/></div>
              <div class="col-6"><q-input label="Monto" v-model="regmulta.monto"/></div>
              <div class="col-12"><q-input label="Observacion" v-model="regmulta.observacion"/></div>
          </div>
        </q-card-section>

        <q-card-actions align="right" class="text-primary">
          <q-btn flat label="Cancel" v-close-popup />
          <q-btn flat label="Registrar"  @click="registrarmulta"/>
        </q-card-actions>
      </q-card>
    </q-dialog>
    </div>
      <q-table
       title="Multas y Sanciones"
        :columns="columns"
        :rows="historialmultas"
      >
        <!--<template v-slot:top-right>
                     <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">-->
<!--            <template v-slot:append>-->
<!--              <q-icon name="search" />-->
<!--            </template>-->
<!--          </q-input>-->
<!--        </template>-->
        </q-table>
    </q-card>
  </q-page>
</template>

<script>
export default {
  // name: 'Local',
  data(){
    return{
    padron:'',
    dialog_multa:false,
    model:{label:'',contribuyente:{}},
    options:[],
    options2:[],
    actividades:[],
    actividad:{},
    sectores:[],
    multas:[],
    detallemultas:[],
    sector:{},
    contribuyente:{},
    negocio:{},
    sancion:{},
    caso:{},
    licencia:{},
    detalle:{},
    historialmultas:[],
    contar:0,
    regmulta:{},
    contribuyentes:[],
      // filter:'',
      // contribuyentes:[],
       columns:[
         { name: 'fecha', label: 'fecha', field: 'fecha'},
         { name: 'titulo', label: 'titulo', field: row=>row.detallemulta.multa.titulo},
         { name: 'monto', label: 'monto', field: 'monto'},
         { name: 'dias', label: 'dias', field: row=>row.detallemulta.dia},
         { name: 'inicio', label: 'inicio', field: 'inicio'},
         { name: 'fin', label: 'fin', field: 'fin'},
         { name: 'estado', label: 'estado', field: 'estado'},
      //   { name: 'tipo', label: 'tipo', field: 'tipo'},
      //   { name: 'action', label: 'action', field: 'action'},
       ]
    }
  },
  created(){
    // console.log('aa')
    // setTimeout(() => {
    //   console.log("Refresh")
    // }, 1000)
    // console.log('ias')
    // window.location.reload(true)
    this.licencias();
     this.listmultas();
  },
  methods:{
      licencias(){
               this.$q.loading.show()
     this.$axios.get(process.env.API+'/listlicencia').then(res=>{
       console.log(res.data)
       //this.contribuyentes=res.data
       this.options=[];
       this.options2=[];
            res.data.forEach(r => {
              let dat={
                contribuyente: r.contribuyente,
                caso:r.caso,
                negocio:r.negocio,
                
                licencia:r,                
                historialmultas:r.historialmultas,
                label: 'Lic: '+r.numlicencia + ' ' + r.contribuyente.nombres+' '+r.contribuyente.paterno+' '+r.contribuyente.materno + ' TIPO:' + r.caso.tipo,
              }
              this.options.push(dat)
              this.options2.push(dat)
            })
          
       this.$q.loading.hide()
     })
      },
      listsancion(){
        this.$axios.get(process.env.API+'/historialmulta/'+this.licencia.id).then(res=>{
            console.log(res.data);
            this.historialmultas=res.data;
        })
      },
      registrarmulta(){
          if(this.regmulta=={}){
              this.$q.notify({
          message: 'Debe seleccionar sancion.',
          icon: 'error'
        })  
              return false;
          }

        if(this.licencia.estado=='CLAUSURA'){
              this.$q.notify({
          message: 'Licencia cancelada',
          icon: 'error'
        })  
              return false;
          }

           this.regmulta.licencia_id=this.licencia.id;
          this.regmulta.detallemulta_id=this.regmulta.id;
          this.regmulta.multa_id=this.sancion.value;

    
        this.$axios.post(process.env.API+'/historialmulta',this.regmulta).then(res=>{
                          this.$q.notify({
                message: 'Registro de Sancion.',
                icon: 'send',
                color: 'green'
        }) 
        this.dialog_multa=false;
        this.licencias();
        })

      },
      verificar(){this.detallemultas=[];
      this.detalle={}
          this.sancion.detalle.forEach(element => {
              this.detallemultas.push({label:element.titulo,detallemulta:element})
          });
          
      },
      llenar(){
          this.regmulta=this.detalle.detallemulta;
      },
      onReg(){
          if(this.licencia.estado=='ACTIVO' || this.licencia.estado=='SUSPENCION')
          this.dialog_multa=true;

      },
      listmultas(){this.multas=[];
        this.$axios.get(process.env.API+'/multa').then(res=>{
            res.data.forEach(element => {
                this.multas.push({label:element.titulo,value:element.id,detalle:element.detallemultas,
                });
            });
            console.log(this.multas)
        })

      },
      cargar(){
          console.log(this.model)
          this.contribuyente=this.model.contribuyente;
          this.caso=this.model.caso;
          this.negocio=this.model.negocio;
          this.licencia=this.model.licencia;
          this.historialmultas=this.model.historialmultas;
          console.log(this.historialmultas);
      },
          filterFn (val, update) {
      if (val === '') {
          this.model={label:'',contribuyente:{}};
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
  }

}
</script>
    