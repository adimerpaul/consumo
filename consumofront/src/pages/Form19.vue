<template>
  <q-page class="q-pa-xs">
    <q-card>
      <div class="text-h6">Formulario 19 Declaracion Jurada</div>
      <div class="row">
        <div class="col-3 ">
        <q-input v-model="numero" type="text" label="Numero" />
        </div>
      </div>
      <div class="row">
        <div class="col-3"> <q-input v-model="tramite.nro" type="text" label="Nro tramite" /></div>
        <div class="col-2"> <q-input v-model="tramite.fecha" type="date" label="Fecha" /></div>
        <div class="col-2"> <q-input v-model="tramite.hora" type="time" label="Hora" /></div>
        <div class="col-3"> <q-input v-model="tramite.tramitador" type="text" label="Tramitador" /></div>
      </div>
    <div class="q-gutter-y-md" style="width: 100%">
      <q-card>
        <q-tabs
          v-model="tab"
          dense
          class="text-grey"
          active-color="primary"
          indicator-color="primary"
          align="justify"
          narrow-indicator
        >
          <q-tab name="natural" label="Personas Natural" />
          <q-tab name="juridico" label="PersonasJuridico" />
        </q-tabs>

        <q-separator />

        <q-tab-panels v-model="tab" animated>
          <q-tab-panel name="natural">

            <div class="text-h6">Registro y verificacion Datos </div>
            <div class="col-5">
                <q-select v-model="actividad" :options="options" label="Actividad"  @change="cargarequisito"/>
            </div>
            <div class="col-5">
              <h6>REQUISITOS</h6>
              <q-table
                title="REQUISITOS"
                :data="data"
                :columns="columns"
                row-key="name"
              />
            </div>
          
          </q-tab-panel>

          <q-tab-panel name="juridico">
            <div class="text-h6">Alarms</div>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
          </q-tab-panel>

        </q-tab-panels>
      </q-card>

    </div>


    </q-card>
  </q-page>
</template>

<script>
export default {
  // name: 'Local',
  data(){
    return{
      tab: 'natural',
      actividad:'',
      options:[],
      numero:'',
      req:[],
      tramite:{},
      tipo:'N',
      column:[]

      // filter:'',
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
    this.options=[];
     this.$axios.post(process.env.API+'/actividad').then(res=>{
       console.log(res.data)
       res.data.forEach(elem => {
          this.options.push({label:elem.detalle,value:elem.codigo});
       });
   })
  },
  method:{
    cargarequisito(){
    if(this.tab =='natural') this.tipo='N';
    else this.tipo='J';

      this.$axios.post(process.env.API+'/requisito',{codigo:this.actividad.value,tipo:this.tipo}).then(res=>{
          console.log(res.data);
      })

    }
  }
}
</script>
