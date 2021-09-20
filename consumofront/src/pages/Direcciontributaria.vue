<template>
  <q-page class="q-pa-xs">
    <q-card>
      <q-badge class="text-h6 full-width text-center" color="secondary" >Direccion tributaria</q-badge>
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
<!--              <q-badge color="orange">-->
                {{ props.row.tramite }}
<!--              </q-badge>-->
            </q-td>
<!--            <q-td key="fecha" :props="props">-->
<!--&lt;!&ndash;              <q-badge color="primary">&ndash;&gt;-->
<!--                {{ props.row.fecha }}-->
<!--&lt;!&ndash;              </q-badge>&ndash;&gt;-->
<!--            </q-td>-->
            <q-td key="dias" :props="props">
              <q-badge :color="props.row.dias<=2?'green':props.row.dias==2?'warning':'negative'">
                {{ props.row.dias }} dias
              </q-badge>
            </q-td>
<!--            <q-td key="estado" :props="props">-->
<!--              <q-badge :color="props.row.estado=='ENPROCESO'?'green':'warning'">-->
<!--                {{ props.row.estado }}-->
<!--              </q-badge>-->
<!--            </q-td>-->
            <q-td key="unidad" :props="props">
                {{ props.row.unidad }}
            </q-td>
<!--            <q-td key="requisitos" :props="props">-->
<!--              <ul style="padding: 0px;margin: 0px;border: 0px">-->
<!--                <li v-for="(r,i) in props.row.requisitos" :key="i" style="padding: 0px;margin: 0px;border: 0px">-->
<!--&lt;!&ndash;                  <q-badge :label="r.nombre" class="q-pa-none q-ma-none" />&ndash;&gt;-->
<!--                  {{ r.nombre }}-->
<!--                </li>-->
<!--              </ul>-->
<!--            </q-td>-->
            <q-td key="action" :props="props">
              <!--              <q-badge color="amber">-->
              <q-btn color="teal" label="Requisitos" icon="list" size="xs" @click="verrequisitos(props.row.requisitos)"/>
              <q-btn v-if="props.row.unidad=='DIRECCION TRIBUTARIA'" color="negative" label="Enviar" icon="login" size="xs" @click="daralta(props.row)"/>
              <q-btn v-else color="accent" label="Espectaculos publicos" icon="login" size="xs" @click="daraltae(props.row)"/>
              <!--              </q-badge>-->
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
  </q-page>
</template>

<script>
import { date } from 'quasar'
const { addToDate } = date
import $ from 'jquery'
import { jsPDF } from "jspdf";


export default {
  // name: 'Local',
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
        // { name: 'estado', label: 'estado', field: 'estado'},
        { name: 'unidad', label: 'Estado', field: 'unidad'},
        // { name: 'requisitos', label: 'requisitos', field: 'requisitos',    align: 'left'},
        // { name: 'tipo', label: 'tipo', field: 'tipo'},
        { name: 'action', label: 'action', field: 'action'},
      ],
      tramites:[]
    }
  },
  created(){
    // console.log('aa')
    // setTimeout(() => {
    //   console.log("Refresh")
    // }, 1000)
    // console.log('ias')
    // window.location.reload(true)

    this.mistramites()
  },
  methods:{
    daraltae(i){

      // return false

      let id=i.id
      this.$q.dialog({
        title:'Seguro de enviar a actividades economicas',
        // message:''
        cancel:true
      }).onOk(()=> {
        this.$q.loading.show()
        // console.log(i)
        this.$axios.put(process.env.API + '/direccion/' + id, {
          estado: 'ACTIVIDADES ECONOMICAS',
          nombre: 'ENVIADO A ACTIVIDADES ECONOMICAS',
          observacion: 'INICIADO',
          infraestructura: true,
          seguridad: true,
          medio: true,
          salubridad: true,
        }).then(res => {
          // console.log(res.data)
          this.mistramites()
          var img= new Image()
          img.src='logo.jpg'

          var doc = new jsPDF('p','cm','letter')
          console.log(i);
          doc.setFont("courier","bold");
          doc.setFontSize(10);
          doc.addImage(img,'jpg',0.5,0.5,2,2)
          let x=0,y=0;
          doc.text(x+11.5, y+1, 'GOBIERNO MUNICIPAL DE ORURO','center');
          doc.text(x+11.5, y+1.5, 'VENTANILLA ÚNICA DA TRÁMITES TRIBUTARIOS','center');
          doc.text(x+11.5, y+2, 'ORDEN DE INSPECCIÓN VUTRAT','center');
          // doc.text(x+11, y+2, i.contribuyente.representante);
          // doc.text(x+11, y+2.5, 'APERTURA '+i.contribuyente.descripcion);
          // doc.text(x+11, y+3, date.formatDate( Date.now(),'DD')+' de '+date.formatDate( Date.now(),'MM')+' del '+date.formatDate( Date.now(),'YYYY'));

          doc.text('Nº tramite:'+i.id+' Tipo de trámite:'+i.caso.clasificacion+' Operador:'+this.$store.state.login.user.name, x+2, y+4);
          doc.setFont("courier","normal");
          let textLines=doc.splitTextToSize('Señor: '+ i.contribuyente.representante.trim(),17)//+' impetrando a la H. comuna autorización para la apertura de: '+i.caso.clasificacion.trim()+'; los informes elevados por la unidad de Actividades Económicas',17)
          doc.text(textLines, x+2, y+5);

          textLines=doc.splitTextToSize('Se le instruye realizar la inspección de la actividad económica: '+i.caso.clasificacion.trim()+' cuya dirección es: '+i.contribuyente.direccionrazon.trim()+', De la propiedad de:  '+ i.contribuyente.representante.trim(),17)
          doc.text(textLines, x+2, y+6);
          // doc.setFont("courier","bold");
          // doc.text('POR TANTO:', x+2, y+9);
          // doc.setFont("courier","normal");
          // textLines=doc.splitTextToSize('SE RESUELVE: Autorizar al (la) Señor(a): '+ i.contribuyente.representante.trim()+', la apertura y legal funcionamiento de: '+i.caso.clasificacion.trim()+', denominado  '+i.contribuyente.razon.trim()+' ubicado en las calles  de la ciudad, debiendo cumplir con el pago de sus obligaciones conforme a la ordenanza de impuesto y patentes ',17)
          // doc.text(textLines, x+2, y+10);
          //
          // textLines=doc.splitTextToSize('Queda inscrita en el padrón municipal de: actividades económicas, bajo el N '+i.id+'  De la capital.',17)
          // doc.text(textLines, x+2, y+12.5);
          //
          // textLines=doc.splitTextToSize('De conformidad a la normativa municipal en vigencia la autorización de estas actividades queda bajo la responsabilidad de las unidades involucradas po lo que deberán prever conforme establece el art. 14 de la ley 1178(control previo) y disposiciones sobre la responsabilidad por la función publica',17)
          // doc.text(textLines, x+2, y+14);

          // textLines=doc.splitTextToSize('',17)
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


        })
      })
    },
    daralta(i){
      let id=i.id


      // return false;

      this.$q.dialog({
        title:'Seguro de dar de alta',
        // message:''
        cancel:true
      }).onOk(()=>{
        this.$q.loading.show()
        // console.log(i)
        this.$axios.put(process.env.API+'/direccion/'+id,{
          estado:'PROCESO',
          nombre:'ENVIADO A INFRAESTRUCTURA SEGURIDAD MEDIO AMBIENTE SALUBRIDAD',
          observacion:'INICIADO',
          infraestructura:false,
          seguridad:false,
          medio:false,
          salubridad:false,
        }).then(res=>{
          // console.log(res.data)
          this.mistramites()
          // this.$q.loading.hide()
          var doc = new jsPDF('p','cm','letter')
          // console.log(i);
          doc.setFont("courier","bold");
          doc.setFontSize(10);
          let x=0,y=0;
          doc.text(x+10, y+1, 'Nº.');
          doc.text(x+15, y+1, 'Fs.');
          doc.text(x+11, y+2, i.contribuyente.representante);
          doc.text(x+11, y+2.5, 'APERTURA '+i.contribuyente.descripcion);
          doc.text(x+11, y+3, date.formatDate( Date.now(),'DD')+' de '+date.formatDate( Date.now(),'MM')+' del '+date.formatDate( Date.now(),'YYYY'));

          doc.text('VISTOS Y CONSIDERANDO', x+2, y+4);
          doc.setFont("courier","normal");
          let textLines=doc.splitTextToSize('Que la solicita presentada por el o la Sr. (a) '+ i.contribuyente.representante.trim()+' impetrando a la H. comuna autorización para la apertura de: '+i.caso.clasificacion.trim()+'; los informes elevados por la unidad de Actividades Económicas',17)
          doc.text(textLines, x+2, y+5);

          textLines=doc.splitTextToSize('Que, habiendo el (la) impetrante cancelado los derechos correspondientes en la caja del tesoro municipal según comprobante adjunto N '+i.id,17)
          doc.text(textLines, x+2, y+7);
          doc.setFont("courier","bold");
          doc.text('POR TANTO:', x+2, y+9);
          doc.setFont("courier","normal");
          textLines=doc.splitTextToSize('SE RESUELVE: Autorizar al (la) Señor(a): '+ i.contribuyente.representante.trim()+', la apertura y legal funcionamiento de: '+i.caso.clasificacion.trim()+', denominado  '+i.contribuyente.razon.trim()+' ubicado en las calles  de la ciudad, debiendo cumplir con el pago de sus obligaciones conforme a la ordenanza de impuesto y patentes ',17)
          doc.text(textLines, x+2, y+10);

          textLines=doc.splitTextToSize('Queda inscrita en el padrón municipal de: actividades económicas, bajo el N '+i.id+'  De la capital.',17)
          doc.text(textLines, x+2, y+12.5);

          textLines=doc.splitTextToSize('De conformidad a la normativa municipal en vigencia la autorización de estas actividades queda bajo la responsabilidad de las unidades involucradas po lo que deberán prever conforme establece el art. 14 de la ley 1178(control previo) y disposiciones sobre la responsabilidad por la función publica',17)
          doc.text(textLines, x+2, y+14);

          // textLines=doc.splitTextToSize('',17)
          doc.text('Regístrese, comuníquese y archívese.', x+2, y+16);

          // textLines=doc.splitTextToSize('ES CONFORME.',17)
          doc.setFont("courier","bold");
          doc.text('ES CONFORME.', x+2, y+17);
          doc.text('SECRETARIA MUNICIPAL DE ECONOMÍA Y HACIENDA.', x+10, y+18);
          doc.setFont("courier","normal");
          window.open(doc.output('bloburl'), '_blank');


        })
      })
    },
    verrequisitos(r){
      // console.log(r)
      this.requisitos=true
      this.misrequisitos=r
    },
    mistramites(){
      this.$q.loading.show()
      this.$axios.get(process.env.API+'/direccion').then(res=>{
        // console.log(res.data)
        this.tramites=[]
        res.data.forEach(r=>{
          const date1 = new Date()
          const date2 = date.extractDate(r.fecha, 'YYYY-MM-DD')
          const unit = 'days'
          const diff = date.getDateDiff(date1, date2, unit)
          // console.log(r)
          this.tramites.push({
            'tramitador':r.tramitador,
            'id':r.id,
            'tipo':r.tipo,
            'clasificacion':r.caso.clasificacion,
            'usuario':r.user.name,
            'tramite':r.nrotramite,
            'fecha':r.fecha,
            'contribuyente':r.contribuyente,
            'dias':diff,
            'estado':r.estado2,
            'unidad':r.estado=='PROCESO'?'EN PROCESO Y REVISADO':r.estado,
            // 'action':'',
            'requisitos':r.requisitos,
            'caso':r.caso
          })
        })

        // this.contribuyentes=res.data
        this.$q.loading.hide()
      })
    }
  }
}
</script>
