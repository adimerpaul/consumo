<template>
  <q-page>
    <div class="row">
      <div class="col-12">
        <q-banner dense inline-actions class="text-white bg-red text-center text-bold">
          ACTIVIDADES ECONOMICAS - VERIFICAR
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
              <q-td key="nrotramite" :props="props">
                {{ props.row.nrotramite }}
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
                             <div class="col-9"><q-input dense outlined v-model="tramite.caso.clasificacion" label="Actividad" /></div>
                            <div class="col-3"><q-input dense outlined v-model="tramite.caso.inicio" label="Horario" /></div>
  
                    </div>
                    <div class="row">

                      <div class="col-9"><q-input dense outlined v-model="tramite.negocio.razon" label="Nombre" /></div>
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
                                <q-select dense label="Asignar Tecnico" :options="users" v-model="user" option-label="name" outlined  />
                              </div>
                              <div class="col-3 flex flex-center" >
                                <q-btn type="submit" label="Asignar " icon="send" color="positive"/>
                              </div>
                              <div class="col-3 flex flex-center" >
                                <q-btn  label="CANCELAR" v-close-popup color="red" icon="delete"/>
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

<!--        <q-dialog full-width >-->
<!--          <q-card >-->

<!--            <q-card-section >-->
<!--              <q-card-section  class="q-pa-none"><q-banner class="text-h6 bg-grey-7 text-white text-bold text-center">ACTIVIDAD ESPECIFICA</q-banner></q-card-section>-->
<!--              <q-form>-->
<!--                <div class="row">-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="tipo NJ" v-model="tramite.negocio.tipo"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="actividad" v-model="tramite.negocio.actividad"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="sector" v-model="tramite.negocio.sector"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="razon" v-model="tramite.negocio.razon"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="horario" v-model="tramite.negocio.horario"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="descripcionactividad" v-model="tramite.negocio.descripcionactividad"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="mts2" v-model="tramite.negocio.mts2"/></div>-->
<!--                </div>-->
<!--              </q-form>-->
<!--              <q-card-section  class="q-pa-none"><q-banner class="text-h6 bg-grey-7 text-white text-bold text-center">1. DATOS DEL PROPIETARIO </q-banner></q-card-section>-->
<!--              <q-form>-->
<!--                <div class="row">-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="paterno" v-model="tramite.contribuyente.paterno"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="materno" v-model="tramite.contribuyente.materno"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="nombres" v-model="tramite.contribuyente.nombres"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="esposo" v-model="tramite.contribuyente.esposo"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="cedula" v-model="tramite.contribuyente.cedula"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="expedido" v-model="tramite.contribuyente.expedido"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="telefono" v-model="tramite.contribuyente.telefono"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="direccion" v-model="tramite.contribuyente.direccion"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="calle" v-model="tramite.contribuyente.calle"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="numero" v-model="tramite.contribuyente.numero"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="casilla" v-model="tramite.contribuyente.casilla"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="fax" v-model="tramite.contribuyente.fax"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="extragero" v-model="tramite.contribuyente.extragero"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="numeroextrangero" v-model="tramite.contribuyente.numeroextrangero"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="numerodni" v-model="tramite.contribuyente.numerodni"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="zona" v-model="tramite.contribuyente.zona"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="nit" v-model="tramite.contribuyente.nit"/></div>-->
<!--                </div>-->
<!--              </q-form>-->
<!--              <q-card-section  class="q-pa-none"><q-banner class="text-h6 bg-grey-7 text-white text-bold text-center">2. UBICACION DE LA ACTIVIDAD </q-banner></q-card-section>-->
<!--              <q-form>-->
<!--                <div class="row">-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="zona" v-model="tramite.negocio.zona"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="barrio" v-model="tramite.negocio.barrio"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="calle" v-model="tramite.negocio.calle"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="entrecalles" v-model="tramite.negocio.entrecalles"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="telefono" v-model="tramite.negocio.telefono"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="numeroagua" v-model="tramite.negocio.numeroagua"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="numeroelectrico" v-model="tramite.negocio.numeroelectrico"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="fachada" v-model="tramite.negocio.fachada"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="acera" v-model="tramite.negocio.acera"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="iluminacion" v-model="tramite.negocio.iluminacion"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="letrero" v-model="tramite.negocio.letrero"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="observaciones" v-model="tramite.negocio.observaciones"/></div>-->
<!--                </div>-->
<!--              </q-form>-->
<!--              <q-card-section  class="q-pa-none"><q-banner class="text-h6 bg-grey-7 text-white text-bold text-center">3. DATOS DEL ESTABLECIMIENTO </q-banner></q-card-section>-->
<!--              <q-form>-->
<!--                <div class="row">-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="tipo" v-model="tramite.negocio.tipo"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="datoestablecimiento" v-model="tramite.negocio.datoestablecimiento"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="gest" v-model="tramite.negocio.gest"/></div>-->
<!--                  <div class="col-2 q-pa-xs"><q-input dense outlined label="ruc" v-model="tramite.negocio.ruc"/></div>-->
<!--                </div>-->
<!--              </q-form>-->
<!--              <q-card-section  class="q-pa-none"><q-banner class="text-h6 bg-grey-7 text-white text-bold text-center">4. REQUISITOS PRESENTADOS </q-banner></q-card-section>-->
<!--              <q-form>-->
<!--                <div class="row">-->
<!--                  <div class="col-12">-->
<!--                    <ul>-->
<!--                      <li style="padding: 0px;margin: 0px;border: 0px;list-style: none" v-for="r in tramite.requisitos" :key="r.id">{{r.nombre}}</li>-->
<!--                    </ul>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </q-form>-->

<!--&lt;!&ndash;              <pre>{{tramite}}</pre>&ndash;&gt;-->
<!--            </q-card-section>-->
<!--            <q-card-section class="q-pt-none">-->
<!--              <q-form @submit.prevent="asignar">-->
<!--                <div class="row">-->
<!--                  <div class="col-8">-->
<!--                    <q-select label="Asignar tecnico" :options="users" v-model="user" option-label="name" outlined  />-->
<!--                  </div>-->
<!--                  <div class="col-4 flex flex-center" >-->
<!--                    <q-btn type="submit" label="Designar Tecnico" icon="send" color="primary"/>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </q-form>-->
<!--            </q-card-section>-->
<!--            <q-card-section aling="right">-->
<!--              <q-btn flat label="ok" icon="delete" color="negative" v-close-popup/>-->
<!--            </q-card-section>-->
<!--          </q-card>-->
<!--        </q-dialog>-->
      </div>
    </div>
  </q-page>
</template>
<script>
import {date} from "quasar";
import { jsPDF } from "jspdf";
export default {
  data(){
    return{
      a:'',
      exp:['OR','LP','PT','PD','SC','CB','CH','TJ','BE','EX'],
      columns:[
        { name: 'tramitador', label: 'tramitador', field: 'tramitador'},
        { name: 'tipo', label: 'tipo', field: 'tipo'},
        { name: 'clasificacion', label: 'clasificacion', field: 'clasificacion'},
        { name: 'nrotramite', label: 'nrotramite', field: 'nrotramite'},
        { name: 'dias', label: 'dias', field: 'dias'},
        { name: 'estado', label: 'estado', field: 'estado'},
        { name: 'unidad', label: 'unidad', field: 'unidad'},
        { name: 'action', label: 'action', field: 'action'},
      ],
      tramites:[],
      filter:'',
      tramite:{},
      dialogtramite:false,
      users:[],
      user:{},
    }
  },
  created(){


    this.mistramites()
    this.misusuarios()

  },
  methods:{
    asignar(){
        //this.daraltae();
        //return false;

      console.log(this.user)
      if (this.user==undefined){
        this.$q.notify({
          message:'Debes seleccionar un tecnico',
          color:'red',
          icon:'error'
        })
        return false
      }
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/asignar',{
        user_id:this.user.id,
        name:this.user.name,
        tramite_id:this.tramite.id
      }).then(res=>{
        this.daraltae();
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
          title: 'Designado al tecnico '+ this.user.name,
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
       daraltae(){
        // console.log(this.tramite)
          var img= new Image()
          img.src='logo.jpg'

          var doc = new jsPDF('p','cm','letter')
          doc.setFont("courier","bold");
          doc.setFontSize(10);
          doc.addImage(img,'jpg',0.5,0.5,2,2)
          let x=0,y=0;
          doc.text(x+11.5, y+1, 'GOBIERNO MUNICIPAL DE ORURO','center');
          doc.text(x+11.5, y+1.5, 'VENTANILLA ÚNICA DA TRÁMITES TRIBUTARIOS','center');
          doc.text(x+11.5, y+2, 'ORDEN DE INSPECCIÓN ','center');

          doc.text('Nº tramite:'+this.tramite.nrotramite+' Tipo de trámite:'+this.tramite.caso.clasificacion+' Operador:'+this.user.name, x+2, y+4);
          doc.setFont("courier","normal");
          let textLines=doc.splitTextToSize('Señor: '+ this.user.name,17)//+' impetrando a la H. comuna autorización para la apertura de: '+i.caso.clasificacion+'; los informes elevados por la unidad de Actividades Económicas',17)
          doc.text(textLines, x+2, y+5);

          textLines=doc.splitTextToSize('Se le instruye realizar la inspección de la actividad económica: '+this.tramite.caso.clasificacion+' '+this.tramite.negocio.razon+' cuya dirección es: '+this.tramite.negocio.calle +' ' +this.tramite.negocio.entrecalles+', De la propiedad de:  '+  this.tramite.contribuyente.nombres +' '+this.tramite.contribuyente.paterno+' '+ this.tramite.contribuyente.materno,17)
          doc.text(textLines, x+2, y+6);
          doc.text('Informar a esta jefatura de acuerdo al siguiente detalle:', x+2, y+8);
          doc.text('Dirección exacta superficie (m2) en la que desarrolla la actividad', x+3, y+9);
          doc.text('Servicios básicos', x+3, y+10);
          doc.text('Condiciones del local ', x+3, y+11);
          doc.text('Área de influencia (servicios específicos)', x+3, y+12);
          // textLines=doc.splitTextToSize('ES CONFORME.',17)
          doc.setFont("courier","bold");
          doc.text('Oruro , ' +date.formatDate(new Date(),'DD')+' de '+date.formatDate(new Date(),'MM')+ ' del '+date.formatDate(new Date(),'YYYY'), x+2, y+14);
          doc.text('SECRETARIA MUNICIPAL DE ECONOMÍA Y HACIENDA.', x+10, y+15);
          doc.setFont("courier","normal");
          window.open(doc.output('bloburl'), '_blank');


    },
    misusuarios(){
      this.$axios.get(process.env.API+'/user').then(res=>{
        // console.log(res.data)
        this.users=[]
        res.data.forEach(r=>{
          if (r.tipo=='TECNICO')
            this.users.push(r)
        })
        this.user=this.users[0]
      })
    },
    ver(tramite){
       console.log(tramite)
      // return false
      this.tramite=tramite
      this.tramite.negocio.fachada=this.tramite.negocio.fachada=='1'?true:false
      this.tramite.negocio.acera=this.tramite.negocio.acera=='1'?true:false
      this.tramite.negocio.iluminacion=this.tramite.negocio.iluminacion=='1'?true:false
      this.tramite.negocio.letrero=this.tramite.negocio.letrero=='1'?true:false
      this.tramite.requisitos.forEach(element => {
        element.estado=true;
      });
      this.dialogtramite=true
    },
    mistramites(){
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/mistramites').then(res=>{
         console.log(res.data)
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
