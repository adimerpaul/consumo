<template>
  <q-page class="q-pa-xs">
    <q-card>
      <div class="text-h6">Modificar Datos Inmueble</div>

        <div>
            <q-select
              filled
              v-model="model"
              use-input
              input-debounce="0"
              label="Contribuyente"
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
            <q-form action="">
                <div class="row">
                    <div class="col-6"><q-input v-model="actividad"  label="Actividad" /></div>
                    <div class="col-6"><q-input v-model="sector"  label="Sector" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.razon" type="text" label="Nombre" /></div>
                    <div class="col-2"><q-input v-model="contribuyente.horario" type="text" label="Horario" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.descripcion" type="text" label="Descripcion" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.mts2" type="text" label="Sup m2" /></div>
                </div>
                <h6>DATO DE PROPIETARIO</h6>
                <div class="row">
                    <div class="col-6"><q-input v-model="contribuyente.paterno" type="text" label="Paterno" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.materno" type="text" label="Materno" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.nombres" type="text" label="Nombres" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.esposo" type="text" label="Ap Esposo" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.cedula" type="text" label="CI" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.nit" type="text" label="NIT" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.zona" type="text" label="ZONA" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.calle" type="text" label="Calle" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.numero" type="text" label="Numero" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.telefono" type="text" label="Telefono" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.casilla" type="text" label="Telefono o" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.fax" type="text" label="Fax" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.extrangero" type="text" label=" Extrangero" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.numeroextrangero" type="text" label="Nro Extrangero" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.numerodni" type="text" label="N DNI  " /></div>
                </div>
                <h6>UBICACION DE LA ACTIVIDAD ECONOMICA</h6>
                <div class="row">
                    <div class="col-6"><q-input v-model="contribuyente.zona" type="text" label="Zona  " /></div>
                    <div class="col-6"><q-input v-model="contribuyente.barrio" type="text" label="Barrio  " /></div>
                    <div class="col-6"><q-input v-model="contribuyente.calleactividad" type="text" label="CA/AV  " /></div>
                    <div class="col-6"><q-input v-model="contribuyente.entrecallles" type="text" label="Entre Calles  " /></div>
                    <div class="col-6"><q-input v-model="contribuyente.numpiso" type="text" label="N Piso  " /></div>
                    <div class="col-6"><q-input v-model="contribuyente.fonoact" type="text" label="Fono  " /></div>
                    <div class="col-6"><q-input v-model="contribuyente.numeroagua" type="text" label="N Medidor Agua" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.numeroelectrico" type="text" label="N Medidor Electrico" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.observaciones" type="text" label="Observaciones" /></div>

                    <div class="col-6"><q-checkbox v-model="contribuyente.fachada" type="text" label="Fachada" /></div>
                    <div class="col-6"><q-checkbox v-model="contribuyente.acera" type="text" label="acera" /></div>
                    <div class="col-6"><q-checkbox v-model="contribuyente.iluminacion" type="text" label="iluminacion" /></div>
                    <div class="col-6"><q-checkbox v-model="contribuyente.letrero" type="text" label="letrero" /></div>

                </div>
                <div class="row">
                    <q-radio v-model="contribuyente.datoestablecimiento" val="1" label="Propio" />
                    <q-radio v-model="contribuyente.datoestablecimiento" val="2" label="Alquilado" />
                    <q-radio v-model="contribuyente.datoestablecimiento" val="3" label="Anticretico" />
                    <q-radio v-model="contribuyente.datoestablecimiento" val="4" label="Otros" />
                </div>
            </q-form>
        </div>

    </q-card>
  </q-page>
</template>

<script>
export default {
  // name: 'Local',
  data(){
    return{
    padron:'',
    model:{label:'',contribuyente:{}},
    options:[],
    options2:[],
    actividades:[],
    actividad:{},
    sectores:[],
    sector:{},
    contribuyente:{},
    contribuyentes:[]
    }
  },
  created(){
    // console.log('aa')
    // setTimeout(() => {
    //   console.log("Refresh")
    // }, 1000)
    // console.log('ias')
    // window.location.reload(true)
     this.$q.loading.show()
     this.$axios.get(process.env.API+'/listadocontrib').then(res=>{
       console.log(res.data)
       //this.contribuyentes=res.data
       this.options=[];
       this.options2=[];
        if (res.data.length > 0) {
            res.data.forEach(r => {
              let dat={
                contribuyente: r,
                label: r.padron + '' + r.representante + ' TIPO:' + r.tipo,
              }
              this.options.push(dat)
              this.options2.push(dat)
            })
          }
       this.$q.loading.hide()
     }).catch(err=>{
       this.$q.loading.hide()
       this.$q.notify({
         message:err.response.data.message,
         color:'red',
         icon:'error'
       })
     })
  },
  methods:{
      cargar(){
          console.log(this.model)
          this.contribuyente=this.model.contribuyente;
            this.$axios.get(process.env.API+'/listactividad/'+this.contribuyente.actividad).then(res=>{
                if(res.data.length>0)
                    this.actividad=res.data[0].detalle;
                    else
                    this.actividad='';
            })
            this.$axios.get(process.env.API+'/listsector/'+this.contribuyente.sector).then(res=>{
                if(res.data.length>0)
                this.sector=res.data[0].detalle;
                else
                this.sector='';
            })
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
