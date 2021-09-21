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
                    <div class="col-6"><q-input v-model="contribuyente.actividad" type="text" label="Actividad" /></div>
                    <div class="col-6"><q-input v-model="contribuyente.sector" type="text" label="Sector" /></div>
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
                    <div class="col-6"><q-input v-model="contribuyente.numerodni" type="text" label="N DNI  " /></div>

                </div>
            </q-form>
        </div>

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
export default {
  // name: 'Local',
  data(){
    return{
    padron:'',
    model:{},
    options:[],
    options2:[],
    contribuyente:{},
    contribuyentes:[]
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
     })
  },
  methods:{
      cargar(){
          console.log(this.model)
          this.contribuyente=this.model.contribuyente;
      }
  }

}
</script>
