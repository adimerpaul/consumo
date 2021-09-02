export default function () {
  return {
    status: '',
    token: localStorage.getItem('tokenvut') || '',
    user : {},
    booluser : false,
    boolregtramite : false,
    boolform19 : false,
    boolfirmaregulacion : false,
    boolverificardocumentacion : false,
    pedido:[]
  }
}
