
<template>
  <q-page>
    <div class="row">
      <div class="col-12">
        <q-banner dense inline-actions class="text-white bg-red text-center text-bold">
          ENTREGAR TRAMITE
        </q-banner>
      </div>
      <div class="col-12 q-pa-xs">
        <q-btn label="Actualizar" icon="refresh" @click="mistramites" color="info"/>
      </div>
      <div class="col-12">
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
          <template v-slot:body="props">
            <q-tr :props="props">
              <q-td key="tramitador" :props="props">
                {{ props.row.tramitador }}
              </q-td>
              <q-td key="tipo" :props="props">
                <q-badge :color="props.row.tipo=='A'?'green':'warning'">
                  {{ props.row.tipo }}
                </q-badge>
              </q-td>
              <q-td key="clasificacion" :props="props">
                <q-badge :color="props.row.tipo=='A'?'green':'warning'">
                  {{ props.row.clasificacion }}
                </q-badge>
              </q-td>
              <q-td key="tramite" :props="props">
                {{ props.row.tramite }}
              </q-td>
              <q-td key="fecha" :props="props">
                {{ props.row.fecha }}
              </q-td>
              <q-td key="dias" :props="props">
                <q-badge :color="props.row.dias<=1?'green':props.row.dias==2?'warning':'negative'">
                  {{ props.row.dias }}
                </q-badge>
              </q-td>
              <q-td key="estado" :props="props">
                <q-badge :color="props.row.estado=='ENPROCESO'?'green':'warning'">
                  {{ props.row.estado }}
                </q-badge>
              </q-td>
              <q-td key="unidad" :props="props">
                {{ props.row.unidad }}
              </q-td>
              <q-td key="action" :props="props">
                <q-btn color="teal" label="Ver " icon="code" size="xs" @click="ver(props.row)"/>
                <!--              <q-btn color="negative" label="Dar alta" icon="login" size="xs" @click="daralta(props.row)"/>-->
              </q-td>
            </q-tr>
          </template>
        </q-table>
        <q-dialog full-width  v-model="dialogtramite" persistent>
          <q-card >
            <!--            <q-card-section>-->
            <!--              <div class="text-h6">Registro Nuevo Contribuyente</div>-->
            <!--            </q-card-section>-->
            <q-form >
              <!--              <q-select dense filled v-model="tram" :options="tramites" label="Nro Tramites" @update:model-value="cambio(tram.value)"/>-->
              <q-card-section>
                <div class="text-h6 text-center" >DATOS DE CONTRIBUYENTE</div>
                <q-tabs
                  v-model="tramite.negocio.tipo"
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
                    <q-checkbox rigth-label v-model="r.estado" :label="r.nombre" v-for="(r,i) in tramite.requisitos" :key="i" class="full-width" />
                  </div>
                  <div class="col-8">
                    <div class="row">
                      <div class="col-6">
                        <q-input dense outlined v-model="tramite.contribuyente.cedula" label="Cedula de Identidad"/>
                      </div>
                      <div class="col-6">
                        <q-select dense filled v-model="tramite.contribuyente.expedido" :options="exp" label="Expedido" />
                      </div>
                      <div class="row">
                        <div class="col-3"><q-input dense outlined v-model="tramite.contribuyente.paterno" label="Paterno" /></div>
                        <div class="col-3"><q-input dense outlined v-model="tramite.contribuyente.materno" label="Materno" /></div>
                        <div class="col-3"><q-input dense outlined v-model="tramite.contribuyente.nombres" label="Nombres" /></div>
                        <div class="col-3"><q-input dense outlined v-model="tramite.contribuyente.esposo" label="Ap. Esposo" /></div>
                      </div>
                      <div class="row">
                        <div class="col-3"><q-input dense outlined v-model="tramite.contribuyente.nit" label="NIT" /></div>
                        <div class="col-3"><q-input dense outlined v-model="tramite.contribuyente.domicilio" label="zona/domicilio" /></div>
                        <div class="col-3"><q-input dense outlined v-model="tramite.contribuyente.calle" label="Calle" /></div>
                        <div class="col-3"><q-input dense outlined v-model="tramite.contribuyente.numero" label="Numero Casa" /></div>
                      </div>
                      <div class="row">
                        <div class="col-3"><q-input dense outlined v-model="tramite.contribuyente.telefono" label="Telefono" /></div>
                        <div class="col-3"><q-input dense outlined v-model="tramite.contribuyente.telofi" label="Telf Oficina" /></div>
                        <div class="col-3"><q-input dense outlined v-model="tramite.contribuyente.casilla" label="Casilla" /></div>
                        <div class="col-3"><q-input dense outlined v-model="tramite.contribuyente.fax" label="FAX" /></div>
                      </div>
                      <div class="row">
                        <div class="col-4"><q-checkbox dense v-model="tramite.contribuyente.extrangero" label="Extrangero" /></div>
                        <div class="col-4"><q-input dense outlined v-model="tramite.contribuyente.numeroextrangero" label="Nro Extrang" /></div>
                        <div class="col-4"><q-input dense outlined v-model="tramite.contribuyente.numerodni" label="Nro DNI" /></div>
                      </div>
                    </div>
                    <div class="text-h6 text-center">DATOS Y UBICACION DE LA ACTIVIDAD</div>
                    <div class="row">
                      <!--                      <div class="col-6"><q-select dense filled v-model="act" @update:model-value="listadosector(act)" :options="actividades" label="Actividad"/></div>-->
                      <!--                      <div class="col-6"><q-input dense outlined v-model="sectores" label="Sector" readonly /></div>-->
                      <div class="col-6"><q-input dense outlined v-model="tramite.caso.clasificacion" label="Nombre" /></div>
                      <div class="col-6"><q-input dense outlined v-model="tramite.caso.inicio" label="Horario" /></div>
                    </div>
                    <div class="row">

                      <div class="col-9"><q-input dense outlined v-model="tramite.negocio.razon" label="Nombre" /></div>
                      <div class="col-3"><q-input dense outlined v-model="tramite.negocio.horario" label="Horario" /></div>
                    </div>
                    <div class="row">

                      <div class="col-9"><q-input dense outlined v-model="tramite.negocio.descripcionactividad" label="Descripcion" /></div>
                      <div class="col-3"><q-input dense outlined v-model="tramite.negocio.mts2" label="Sup mts2" /></div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-3"><q-input dense outlined v-model="tramite.negocio.zona" label="Zona" /></div>
                      <div class="col-3"><q-input dense outlined v-model="tramite.negocio.Barrio" label="Barrio" /></div>
                      <div class="col-3"><q-input dense outlined v-model="tramite.negocio.calle" label="AV/Calle" /></div>
                      <div class="col-3"><q-input dense outlined v-model="tramite.negocio.entrecalles" label="Entre Calles" /></div>
                    </div>
                    <div class="row">
                      <div class="col-3"><q-input dense outlined v-model="tramite.negocio.numpiso" label="Nro Piso" /></div>
                      <div class="col-3"><q-input dense outlined v-model="tramite.negocio.telefono" label="Telefono" /></div>
                      <div class="col-3"><q-input dense outlined v-model="tramite.negocio.numeroagua" label="No Med Agua" /></div>
                      <div class="col-3"><q-input dense outlined v-model="tramite.negocio.numeroelectrico" label="No Med Elec" /></div>
                    </div>
                    <div class="row">
                      <div class="col-4"><q-input dense outlined v-model="tramite.negocio.observaciones" label="Observacion" /></div>
                      <div class="col-2"><q-checkbox v-model="tramite.negocio.fachada" label="Fachada" /></div>
                      <div class="col-2"><q-checkbox v-model="tramite.negocio.acera" label="Acera" /></div>
                      <div class="col-2"><q-checkbox v-model="tramite.negocio.iluminacion" label="Iluminacion" /></div>
                      <div class="col-2"><q-checkbox v-model="tramite.negocio.letrero" label="Letrero" /></div>
                    </div>

                    <div class="row">
                      <q-radio v-model="tramite.negocio.datoestablecimiento" val="PROPIO" label="PROPIO" />
                      <q-radio v-model="tramite.negocio.datoestablecimiento" val="ALQUILADO" label="ALQUILADO" />
                      <q-radio v-model="tramite.negocio.datoestablecimiento" val="ANTICRETICO" label="ANTICRETICO" />
                      <q-radio v-model="tramite.negocio.datoestablecimiento" val="OTROS" label="OTROS" />
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <q-form @submit.prevent="asignar">
                          <div class="row">
                            <div class="col-6">
                              <!--                              <q-select dense label="Asignar Tecnico" :options="users" v-model="user" option-label="name" outlined  />-->
                            </div>
                            <div class="col-3 flex flex-center" >
                              <q-btn type="submit" label="Aprobar " icon="send" color="positive"/>
                            </div>
                            <div class="col-3 flex flex-center" >
                              <q-btn  label="Cancelar" v-close-popup color="red" icon="delete"/>
                            </div>
                          </div>
                        </q-form>
                      </div>
                    </div>
                  </div>
                </div>
              </q-card-section>

            </q-form>
          </q-card>
        </q-dialog>
      </div>
    </div>
  </q-page>
</template>
<script>
import {date} from "quasar";

export default {
  data(){
    return{
      exp:['OR','LP','PT','PD','SC','CB','CH','TJ','BE','EX'],
      columns:[
        { name: 'tramitador', label: 'tramitador', field: 'tramitador'},
        { name: 'tipo', label: 'tipo', field: 'tipo'},
        { name: 'clasificacion', label: 'clasificacion', field: 'clasificacion'},
        { name: 'tramite', label: 'tramite', field: 'tramite'},
        { name: 'dias', label: 'dias', field: 'dias'},
        { name: 'estado', label: 'estado', field: 'estado'},
        { name: 'unidad', label: 'unidad', field: 'unidad'},
        { name: 'action', label: 'action', field: 'action'},
      ],
      tramites:[],
      filter:'',
      tramite:{},
      dialogtramite:false,
      // users:[],
      // user:{}
    }
  },
  created(){
    this.mistramites()
    // this.misusuarios()

  },
  methods:{
    asignar(){
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/aprobarterminar',{
        // user_id:this.user.id,
        // name:this.user.name,
        tramite_id:this.tramite.id
      }).then(res=>{
        this.$q.loading.hide()
        // console.log(res.data)
        // return false
        this.dialogtramite=false
        // console.log(res.data)
        this.mistramites()
        // this.$swal('Hello Vue world!!!');

        this.$swal({
          // position: 'top-end',
          icon: 'success',
          title: 'Tramite entregado',
          showConfirmButton: false,
          timer: 2500
        })

        return false
      }).catch(err=>{
        this.$q.loading.hide()
        this.$q.notify({
          message:err.response.data.message,
          color:'red',
          icon:'error'
        })

      })
    },
    // misusuarios(){
    //   this.$axios.get(process.env.API+'/user').then(res=>{
    //     // console.log(res.data)
    //     this.users=[]
    //     res.data.forEach(r=>{
    //       if (r.tipo=='TECNICO')
    //         this.users.push(r)
    //     })
    //     this.user=this.users[0]
    //   })
    // },
    ver(tramite){
      // console.log(tramite)
      // return false
      this.tramite=tramite

      this.tramite.negocio.fachada=this.tramite.negocio.fachada=='1'?true:false
      this.tramite.negocio.acera=this.tramite.negocio.acera=='1'?true:false
      this.tramite.negocio.iluminacion=this.tramite.negocio.iluminacion=='1'?true:false
      this.tramite.negocio.letrero=this.tramite.negocio.letrero=='1'?true:false

      this.dialogtramite=true
    },
    mistramites(){
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/mistramitesterminar').then(res=>{
        // console.log(res.data)
        this.tramites=[]
        res.data.forEach(r=>{
          const date1 = new Date()
          const date2 = date.extractDate(r.fecha, 'YYYY-MM-DD')
          const unit = 'days'
          const diff = date.getDateDiff(date1, date2, unit)
          let d=r
          d.clasificacion=r.caso.clasificacion
          d.dias=diff
          d.estado=r.estado2
          d.unidad=r.estado
          this.tramites.push(d)
          // this.tramites.push({
          //   'tramitador':r.tramitador,
          //   'id':r.id,
          //   'tipo':r.tipo,
          //   'clasificacion':r.caso.clasificacion,
          //   'usuario':r.user.name,
          //   'tramite':r.nrotramite,
          //   'fecha':r.fecha,
          //   'dias':diff,
          //   'estado':r.estado2,
          //   'unidad':r.estado,
          //   'requisitos':r.requisitos
          // })
        })
        this.$q.loading.hide()
      }).catch(err=>{
        this.$q.loading.hide()
        this.$q.notify({
          message:err.response.data.message,
          color:'red',
          icon:'error'
        })
      })
    }
  }
}
</script>
