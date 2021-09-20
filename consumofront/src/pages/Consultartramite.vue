<template>
  <q-page class="q-pa-xs">
    <q-card>
      <q-card class="q-pa-xs">
      <q-badge class="text-h6 full-width text-center" color="accent" >Consultar tramite</q-badge>
      <div class="row">
        <div class="col-12">
          <q-select
            outlined
            v-model="tramite"
            use-input
            input-debounce="0"
            label="Buscar tramite"
            :options="tramites"
            @filter="filterFn2"
            @update:model-value="vertramite"
          >
            <template v-slot:no-option>
              <q-item>
                <q-item-section class="text-grey">
                  No se encontro el tramite
                </q-item-section>
              </q-item>
            </template>
          </q-select>
        </div>
        <div class="col-12">
          <ul>
            <li v-for="(s,i) in seguimientos" :key="i">{{s.nombre}} <q-badge :color="s.observacion=='INICIADO'||s.observacion=='APROBADO'?'positive':'negative'" :label="s.observacion"/> {{s.fecha}}</li>
          </ul>
        </div>
        <div class="col-12" v-if="licencia!=''">
          <q-badge v-if="licencia!=''" color="primary" :label="'Numero '+licencia.num"/>
          <q-badge v-if="licencia.num!=undefined" color="secondary" :label="'Num licencia '+licencia.numlicencia"/>
          <q-badge v-if="licencia.contribuyente!=undefined" color="teal" :label="'contribuyente '+licencia.contribuyente.representante"/>
          <q-badge v-if="licencia.contribuyente!=undefined" color="accent" :label="'razon '+licencia.contribuyente.razon"/>
          <q-badge v-if="licencia.contribuyente!=undefined" color="primary" :label="'direccion '+licencia.contribuyente.direccionrazon"/>
          <q-badge v-if="licencia.fechaautorizacion!=undefined" color="secondary" :label="'fecha emicion '+licencia.fechaautorizacion"/>
          <q-badge v-if="licencia.fechafin!=undefined" color="teal" :label="'fecha fin '+licencia.fechafin"/>
          <q-badge v-if="licencia.caso!=undefined" color="teal" :label="'horario '+licencia.caso.inicio+'-'+licencia.caso.fin"/>
          <q-badge v-if="licencia.contribuyente!=undefined" color="accent" :label="'Actividad autorizada '+licencia.contribuyente.descripcion"/>
          <q-badge v-if="licencia.caso!=undefined" color="teal" :label="'obligacion '+licencia.caso.clasificacion"/>
<!--          <pre>{{licencia}}</pre>-->
        </div>
        <div class="col-12 row" v-if="licencia.num!=undefined">
          <div class="col-6"><q-btn label="Imprimir Licencia" icon="print" color="teal" class="full-width" @click="imprimir"/></div>
          <div class="col-6"><q-btn label="Imprimir Control" icon="print" color="accent" class="full-width" @click="imprimir2"/></div>
        </div>
      </div>
      </q-card>
<!--      <q-card class="q-pa-xs">-->
<!--        <q-badge class="text-h6 full-width text-center" color="positive" >Licencias aceptadas</q-badge>-->
<!--        <div class="row">-->
<!--          <div class="col-12">-->
<!--            <q-select-->
<!--              outlined-->
<!--              v-model="licencia"-->
<!--              use-input-->
<!--              input-debounce="0"-->
<!--              label="Buscar licencias aceptadas"-->
<!--              :options="licencias"-->
<!--              @filter="filterFn"-->
<!--            >-->
<!--              <template v-slot:no-option>-->
<!--                <q-item>-->
<!--                  <q-item-section class="text-grey">-->
<!--                    No se encontro la  licencias-->
<!--                  </q-item-section>-->
<!--                </q-item>-->
<!--              </template>-->
<!--            </q-select>-->
<!--          </div>-->
<!--        </div>-->
<!--      </q-card>-->
<!--      <q-btn @click="mistramites" icon="refresh" label="refrescar" color="secondary" class="q-mt-xs"/>-->
<!--      <q-table-->
<!--        title="Mis tramites"-->
<!--        :columns="columns"-->
<!--        :rows="tramites"-->
<!--        :filter="filter"-->
<!--      >-->
<!--        <template v-slot:top-right>-->
<!--          <q-input borderless dense debounce="300" v-model="filter" placeholder="Search">-->
<!--            <template v-slot:append>-->
<!--              <q-icon name="search" />-->
<!--            </template>-->
<!--          </q-input>-->
<!--        </template>-->
<!--        <template v-slot:body="props">-->
<!--          <q-tr :props="props">-->
<!--            <q-td key="tramitador" :props="props">-->
<!--              {{ props.row.tramitador }}-->
<!--            </q-td>-->
<!--            <q-td key="tipo" :props="props">-->
<!--              <q-badge :color="props.row.tipo=='A'?'green':'warning'">-->
<!--                {{ props.row.tipo }}-->
<!--              </q-badge>-->
<!--            </q-td>-->
<!--            <q-td key="clasificacion" :props="props">-->
<!--              <q-badge :color="props.row.tipo=='A'?'green':'warning'">-->
<!--                {{ props.row.clasificacion }}-->
<!--              </q-badge>-->
<!--            </q-td>-->
<!--            <q-td key="tramite" :props="props">-->
<!--              {{ props.row.tramite }}-->
<!--            </q-td>-->
<!--            <q-td key="fecha" :props="props">-->
<!--              {{ props.row.fecha }}-->
<!--            </q-td>-->
<!--            <q-td key="dias" :props="props">-->
<!--              <q-badge :color="props.row.dias==1?'green':props.row.dias==2?'warning':'negative'">-->
<!--                {{ props.row.dias }}-->
<!--              </q-badge>-->
<!--            </q-td>-->
<!--            <q-td key="estado" :props="props">-->
<!--              <q-badge :color="props.row.estado=='ENPROCESO'?'green':'warning'">-->
<!--                {{ props.row.estado }}-->
<!--              </q-badge>-->
<!--            </q-td>-->
<!--            <q-td key="unidad" :props="props">-->
<!--              {{ props.row.unidad }}-->
<!--            </q-td>-->
<!--            <q-td key="requisitos" :props="props">-->
<!--              <ul>-->
<!--                <li v-for="(r,i) in props.row.requisitos" :key="i">-->
<!--                  <q-badge :label="r.nombre" /></li>-->
<!--              </ul>-->
<!--            </q-td>-->
<!--            <q-td key="action" :props="props">-->
<!--              <q-btn color="teal" label="Requisitos" icon="list" size="xs" @click="verrequisitos(props.row.requisitos)"/>-->
<!--              <q-btn color="negative" label="Dar alta" icon="login" size="xs" @click="daralta(props.row)"/>-->
<!--            </q-td>-->
<!--          </q-tr>-->
<!--        </template>-->
<!--      </q-table>-->
<!--      <q-dialog v-model="requisitos">-->
<!--        <q-card>-->
<!--          <q-card-section><div class="text-h">Requisitos presentados</div></q-card-section>-->
<!--          <q-card-section class="q-pt-none">-->
<!--            <ul>-->
<!--              <li v-for="(r,i) in misrequisitos" :key="i">{{r.nombre}}</li>-->
<!--            </ul>-->
<!--          </q-card-section>-->
<!--          <q-card-section aling="right">-->
<!--            <q-btn flat label="ok" icon="trash" color="negative" v-close-popup/>-->
<!--          </q-card-section>-->
<!--        </q-card>-->
<!--      </q-dialog>-->
    </q-card>
    <div id="qr_code">
    </div>
<!--    <q-dialog v-model="dialog">-->
<!--      <q-card >-->
<!--        <q-form @submit="licencia">-->
<!--          <q-card-section>-->
<!--            <div class="text-h6">Datos de la licencia</div>-->
<!--          </q-card-section>-->
<!--          <q-card-section class="q-pt-none">-->
<!--            <q-input class="q-ma-xs" outlined v-model="dat.num" label="Numero" autofocus/>-->
<!--            <q-input class="q-ma-xs" outlined v-model="dat.numlicencia" label="Numero licencia" />-->
<!--          </q-card-section>-->
<!--          <q-card-actions align="right" class="text-primary">-->
<!--            <q-btn label="Cerrar" icon="delete" color="negative" v-close-popup />-->
<!--            <q-btn label="Crear" color="positive" icon="send" type="submit" />-->
<!--          </q-card-actions>-->
<!--        </q-form>-->
<!--      </q-card>-->
<!--    </q-dialog>-->
  </q-page>
</template>

<script>
import { date } from 'quasar'
const { addToDate } = date
import $ from 'jquery'
import { jsPDF } from "jspdf";

export default {
  data(){
    return{
      filter:'',
      requisitos:false,
      tramites:[],
      tramites2:[],
      seguimientos:[],
      tramite:'',
      licencias:[],
      licencias2:[],
      licencia:'',
    }
  },
  created(){
    this.mislicencias()
  },
  methods:{
    vertramite(i){
      // console.log(i)
      this.seguimientos=i.seguimientos
      this.licencia=''
      if (i.licencia!=null){
        this.licencia=i.licencia
      }
      // console.log(i.licencia)

    },
    filterFn (val, update) {
      if (val === '') {
        update(() => {
          this.licencias = this.licencias2
        })
        return
      }
      update(() => {
        const needle = val.toLowerCase()
        this.licencias = this.licencias2.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },
    filterFn2 (val, update) {
      if (val === '') {
        update(() => {
          this.tramites = this.tramites2
        })
        return
      }

      update(() => {
        const needle = val.toLowerCase()
        this.tramites = this.tramites2.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
      })
    },
    imprimir(i){
      // console.log(i)
      var doc = new jsPDF('p','cm','letter')
      // console.log(dat);
      doc.setFont("courier");
      doc.setFontSize(10);
      var x=0,y=0;
      doc.text(x+15, y+6.5, this.licencia.num);
      doc.text(x+2, y+8, this.licencia.contribuyente.representante);
      doc.text(x+2, y+9.5, this.licencia.contribuyente.razon);
      doc.text(x+2, y+11, this.licencia.contribuyente.direccionrazon);
      doc.text(x+2, y+12.5, this.licencia.fechaautorizacion);
      doc.text(x+6, y+12.5, this.licencia.fechafin);
      doc.text(x+11, y+12.5, this.licencia.caso.inicio+'-'+this.licencia.caso.fin);
      doc.text(x+16, y+12.5, this.licencia.numlicencia);
      doc.text(x+2, y+15, this.licencia.contribuyente.descripcion);
      doc.text(x+2, y+17, this.licencia.caso.clasificacion);
      console.log(this.licencia)
      let miPrimeraPromise = new Promise((resolve, reject) => {
        // Llamamos a resolve(...) cuando lo que estabamos haciendo finaliza con éxito, y reject(...) cuando falla.
        // En este ejemplo, usamos setTimeout(...) para simular código asíncrono.
        // En la vida real, probablemente uses algo como XHR o una API HTML5.
        var qrcode = new QRCode(document.getElementById("qr_code"), {
          text: process.env.API2+"/entregartramite/"+this.licencia.tramite_id,
          width: 128,
          height: 128,
          colorDark : "#000000",
          colorLight : "#ffffff",
          correctLevel : QRCode.CorrectLevel.H
        });
        setTimeout(function(){
          resolve("¡Éxito!"); // ¡Todo salió bien!
        }, 1000);
      });
      miPrimeraPromise.then((successMessage) => {
        // succesMessage es lo que sea que pasamos en la función resolve(...) de arriba.
        // No tiene por qué ser un string, pero si solo es un mensaje de éxito, probablemente lo sea.
        // console.log("¡Sí! " + successMessage);
        let base64Image = $('#qr_code img').attr('src');
        // console.log(base64Image);
        doc.addImage(base64Image, 'png', x+8, y+15,2, 2);
        window.open(doc.output('bloburl'), '_blank');
      });
    },
        imprimir2(i){
      // console.log(i)
      var doc = new jsPDF('p','cm','letter')
      // console.log(dat);
      doc.setFont("courier");
      doc.setFontSize(10);
      var x=0,y=0;
      doc.text(x+2, y+13.5, this.licencia.contribuyente.representante);
      doc.text(x+2, y+15.5, this.licencia.contribuyente.razon);
      doc.text(x+2, y+17, this.licencia.contribuyente.direccionrazon);

      doc.text(x+2, y+19, this.licencia.caso.tipo);
      doc.text(x+6, y+19, this.licencia.caso.inicio+'-'+this.licencia.caso.fin);
      doc.text(x+12, y+19, this.licencia.numlicencia);

      doc.text(x+2, y+20.5, this.licencia.fechaautorizacion);
      doc.text(x+10.5, y+20.5, this.licencia.fechafin);


      let miPrimeraPromise = new Promise((resolve, reject) => {
        // Llamamos a resolve(...) cuando lo que estabamos haciendo finaliza con éxito, y reject(...) cuando falla.
        // En este ejemplo, usamos setTimeout(...) para simular código asíncrono.
        // En la vida real, probablemente uses algo como XHR o una API HTML5.
        var qrcode = new QRCode(document.getElementById("qr_code"), {
          text: process.env.API2+"/entregartramite/"+this.licencia.tramite_id,
          width: 128,
          height: 128,
          colorDark : "#000000",
          colorLight : "#ffffff",
          correctLevel : QRCode.CorrectLevel.H
        });
        setTimeout(function(){
          resolve("¡Éxito!"); // ¡Todo salió bien!
        }, 1000);
      });
      miPrimeraPromise.then((successMessage) => {
        // succesMessage es lo que sea que pasamos en la función resolve(...) de arriba.
        // No tiene por qué ser un string, pero si solo es un mensaje de éxito, probablemente lo sea.
        // console.log("¡Sí! " + successMessage);
        let base64Image = $('#qr_code img').attr('src');
        // console.log(base64Image);
        doc.addImage(base64Image, 'png', x+8, y+22,2, 2);
        window.open(doc.output('bloburl'), '_blank');
      });
    },

    daralta(i){
      this.dat.id=i.id
      this.dialog=true

      // this.dat.id=i.id
      // this.$q.dialog({
      //   title:'Seguro de dar de alta',
      //   cancel:true,
      // }).onOk(()=>{
      //   this.dialog=true
      //
      //
      //   // this.$axios.put(process.env.API+'/locencia',{
      //   //   id,
      //   //   nombre:'APROBADO ACTIVIDADES ECNOMICAS',
      //   //   observacion:'APROBADO',
      //   //   infraestructura:true,
      //   //   seguridad:true,
      //   //   medio:true,
      //   //   salubridad:true,
      //   // }).then(res=>{
      //   //   // console.log(res.data)
      //   //   this.mistramites()
      //   // })
      //
      //
      // })
    },
    // verrequisitos(r){
    //   this.requisitos=true
    //   this.misrequisitos=r
    // },
    mislicencias(){
      this.$q.loading.show()
      this.$axios.get(process.env.API+'/direccion/tra').then(res=>{
        this.tramites=[]
        this.tramites2=[]
        res.data.forEach(r=>{
          console.log(r)
          let dato=r
          dato.label=r.padron +' T:'+r.tramitador+' C:'+r.caso.clasificacion+' T:'+r.tipo+' nro:'+r.nrotramite
          this.tramites.push(dato)
          this.tramites2.push(dato)
        })

        this.$q.loading.hide()
      })

      // this.$axios.get(process.env.API+'/direccion/todo').then(res=>{
      //   this.$axios.get(process.env.API+'/direccion/tra').then(res=>{
      //
      //     this.tramites=[]
      //     this.tramites2=[]
      //     res.data.forEach(r=>{
      //       console.log(r)
      //       let dato=r
      //       dato.label=r.padron +' T:'+r.tramitador+' C:'+r.caso.clasificacion+' T:'+r.tipo+' nro:'+r.nrotramite
      //       this.tramites.push(dato)
      //       this.tramites2.push(dato)
      //     })
      //
      //     this.$q.loading.hide()
      //   })
      //   // console.log(res.data)
      //   // return false
      //   this.licencias=[]
      //   this.licencias2=[]
      //
      //   res.data.forEach(r=>{
      //     // const date1 = new Date()
      //     // const date2 = date.extractDate(r.fecha, 'YYYY-MM-DD')
      //     // const unit = 'days'
      //     // const diff = date.getDateDiff(date1, date2, unit)
      //     // console.log(r)
      //     let dato=r
      //     dato.label=r.contribuyente.padron +' '+r.contribuyente.representante+' '+r.contribuyente.descripcion+' '+r.contribuyente.direccion
      /*    // let dato={*/
      /*    //   tramitador:r.tramitador,*/
      /*    //   label:r.contribuyente.padron +' '+r.contribuyente.representante+' '+r.contribuyente.descripcion+' '+r.contribuyente.direccion,*/
      /*    //   id:r.id,*/
      /*    //   // tipo:r.tipo,*/
      /*    //   // clasificacion:r.caso.clasificacion,*/
      /*    //   // usuario:r.user.name,*/
      //     //   // tramite:r.nrotramite,
      //     //   // fecha:r.fecha,
      //     //   // dias:diff,
      //     //   // estado:r.estado2,
      //     //   // unidad:r.estado,
      //     //   // requisitos:r.requisitos
      //     // }
      //     this.licencias.push(dato)
      //     this.licencias2.push(dato)
      //   })
      // })
    }
  }
}
</script>
<style>
#qr_code{
  display: none;
}
</style>
