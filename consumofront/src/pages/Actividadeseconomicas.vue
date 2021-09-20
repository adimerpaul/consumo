<template>
  <q-page class="q-pa-xs">
    <q-card>
      <q-badge class="text-h6 full-width text-center" color="accent" >Aprobar por actividades economicas</q-badge>
      <q-btn @click="mistramites" icon="refresh" label="refrescar" color="secondary" class="q-mt-xs"/>
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
            <q-td key="requisitos" :props="props">
              <ul>
                <li v-for="(r,i) in props.row.requisitos" :key="i">
                  <q-badge :label="r.nombre" /></li>
              </ul>
            </q-td>
            <q-td key="action" :props="props">
              <q-btn color="teal" label="Requisitos" icon="list" size="xs" @click="verrequisitos(props.row.requisitos)"/>
              <q-btn color="negative" label="Dar alta" icon="login" size="xs" @click="daralta(props.row)"/>
            </q-td>
          </q-tr>
        </template>
      </q-table>
      <q-dialog v-model="requisitos">
        <q-card>
          <q-card-section><div class="text-h">Requisitos presentados</div></q-card-section>
          <q-card-section class="q-pt-none">
            <ul>
              <li v-for="(r,i) in misrequisitos" :key="i">{{r.nombre}}</li>
            </ul>
          </q-card-section>
          <q-card-section aling="right">
            <q-btn flat label="ok" icon="trash" color="negative" v-close-popup/>
          </q-card-section>
        </q-card>
      </q-dialog>
    </q-card>
    <div id="qr_code">
    </div>
    <q-dialog v-model="dialog">
      <q-card >
        <q-form @submit="licencia">
        <q-card-section>
          <div class="text-h6">Datos de la licencia</div>
        </q-card-section>
        <q-card-section class="q-pt-none">
          <q-input class="q-ma-xs" outlined v-model="dat.num" label="Numero" autofocus/>
          <q-input class="q-ma-xs" outlined v-model="dat.numlicencia" label="Numero licencia" />
        </q-card-section>
        <q-card-actions align="right" class="text-primary">
          <q-btn label="Cerrar" icon="delete" color="negative" v-close-popup />
          <q-btn label="Crear" color="positive" icon="send" type="submit" />
        </q-card-actions>
        </q-form>
      </q-card>
    </q-dialog>
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
      misrequisitos:[],
      columns:[
        { name: 'tramitador', label: 'tramitador', field: 'tramitador'},
        { name: 'tipo', label: 'tipo', field: 'tipo'},
        { name: 'clasificacion', label: 'clasificacion', field: 'clasificacion'},
        { name: 'tramite', label: 'tramite', field: 'tramite'},
        // { name: 'fecha', label: 'fecha', field: 'fecha'},
        { name: 'dias', label: 'dias', field: 'dias'},
        { name: 'estado', label: 'estado', field: 'estado'},
        { name: 'unidad', label: 'unidad', field: 'unidad'},
        // { name: 'requisitos', label: 'requisitos', field: 'requisitos',    align: 'left'},
        { name: 'action', label: 'action', field: 'action'},
      ],
      tramites:[],
      dat:{},
      dialog:false,
    }
  },
  created(){

    this.mistramites()
  },
  methods:{
    licencia(){

      if (this.dat.num==undefined) {
        this.$q.notify({
          message:'Debes colocar Numero',
          color:'red',
          icon:'error'
        })
        return false
      }
      if (this.dat.numlicencia==undefined) {
        this.$q.notify({
          message:'Debes colocar Numero de licencia',
          color:'red',
          icon:'error'
        })
        return false
      }
      // console.log(this.dat.num)
      // return false
      this.$q.loading.show()
      this.$axios.post(process.env.API+'/licencia',this.dat).then(res=>{
        // console.log(res.data)
        this.dialog=false
        this.mistramites()
      })
    },
    imprimir(i){
      // console.log(i)
      var doc = new jsPDF('p','cm','letter')
      // console.log(dat);
      doc.setFont("courier");
      doc.setFontSize(9);
      var x=0,y=0;
      doc.text(x+14.5, y+3.7, 'TRAMITE N '+'ghjgjh');
      // doc.text(x+9.5, y+6, dat.cliente.paterno.toString()+' '+dat.cliente.materno.toString()+' '+dat.cliente.nombre.toString());
      // doc.text(x+9.5, y+7.5, dat.cliente.direccion.toString());
      // doc.text(x+14, y+7.5, dat.cliente.numcasa.toString());
      // doc.text(x+15.6, y+7.5, dat.cliente.ci.toString()+' '+dat.cliente.expedido.toString());
      // doc.text(x+18, y+7.5, dat.cliente.telefono.toString());
      // doc.text(x+3, y+9, dat.varios.toString());
      // doc.text(x+9.5, y+9, 'OR '+ dat.fecha.toString());
      // let xx=x+1.2
      // let yy=x+9.7
      // dat.detalles.forEach(r=>{
      //   doc.text(xx, yy, r.codsubitem.toString());
      //   doc.text(xx+2.5, yy, r.nombreitem.toString());
      //   // doc.text(xx, yy, r.codsubitem.toString());
      //   doc.text(xx+14.5, yy, r.subtotal.toString());
      //   doc.text(xx+2.5, yy+0.5, r.detalle.toString());
      //   yy++
      //   // console.log(r)
      // })
      // doc.text(x+15.5, y+18, dat.total.toString()+' Bs');
      // doc.text(x+2, y+16, dat.literal.toString()+' 00/100Bs');
      //


      // doc.text(x+8.7, y+20.5, dat.controlinterno.toString());
      // doc.save("Comprobante.pdf");
      // var qrcode = await new QRCode(document.getElementById("qr_code"), {
      //   text: "https://cravecookie.com/",
      //   width: 128,
      //   height: 128,
      //   colorDark : "#000000",
      //   colorLight : "#ffffff",
      //   correctLevel : QRCode.CorrectLevel.H
      // });
      // let base64Image =  await $('#qr_code img').attr('src');
      // await  console.log(base64Image);
      //
      // await doc.addImage(base64Image, 'png', 0, 0, 2, 2);
      //
      // await  window.open(doc.output('bloburl'), '_blank');
      let miPrimeraPromise = new Promise((resolve, reject) => {
        // Llamamos a resolve(...) cuando lo que estabamos haciendo finaliza con éxito, y reject(...) cuando falla.
        // En este ejemplo, usamos setTimeout(...) para simular código asíncrono.
        // En la vida real, probablemente uses algo como XHR o una API HTML5.
        var qrcode = new QRCode(document.getElementById("qr_code"), {
          text: 'holas',
          width: 128,
          height: 128,
          colorDark : "#000000",
          colorLight : "#ffffff",
          correctLevel : QRCode.CorrectLevel.H
        });
        setTimeout(function(){
          resolve("¡Éxito!"); // ¡Todo salió bien!
        }, 250);
      });
      miPrimeraPromise.then((successMessage) => {
        // succesMessage es lo que sea que pasamos en la función resolve(...) de arriba.
        // No tiene por qué ser un string, pero si solo es un mensaje de éxito, probablemente lo sea.
        // console.log("¡Sí! " + successMessage);
        let base64Image = $('#qr_code img').attr('src');
        // console.log(base64Image);
        doc.addImage(base64Image, 'png', x+8.7, y+20.5, 1.5, 1.5);
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
    verrequisitos(r){
      this.requisitos=true
      this.misrequisitos=r
    },
    mistramites(){
      this.$q.loading.show()
      this.$axios.get(process.env.API+'/direccion/ac').then(res=>{
        console.log(res.data)
        this.tramites=[]
        res.data.forEach(r=>{
          const date1 = new Date()
          const date2 = date.extractDate(r.fecha, 'YYYY-MM-DD')
          const unit = 'days'
          const diff = date.getDateDiff(date1, date2, unit)

          this.tramites.push({
            'tramitador':r.tramitador,
            'id':r.id,
            'tipo':r.tipo,
            'clasificacion':r.caso.clasificacion,
            'usuario':r.user.name,
            'tramite':r.nrotramite,
            'fecha':r.fecha,
            'dias':diff,
            'estado':r.estado2,
            'unidad':r.estado,
            'requisitos':r.requisitos
          })
        })

        this.$q.loading.hide()
      })
    }
  }
}
</script>
<style>
#qr_code{
  display: none;
}
</style>
