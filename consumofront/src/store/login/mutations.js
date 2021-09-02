/*
export function someMutation (state) {
}
*/
export function auth_request(state){
  state.status = 'loading'
}
export function auth_success(state, data){
  state.status = 'success'
  state.token = data.token
  state.user = data.user
  state.booluser=data.user.permisos.find(permiso=>permiso.id===1)!=undefined
  state.boolregtramite=data.user.permisos.find(permiso=>permiso.id===2)!=undefined
  state.boolform19=data.user.permisos.find(permiso=>permiso.id===3)!=undefined
  state.boolfirmaregulacion=data.user.permisos.find(permiso=>permiso.id===4)!=undefined
  state.boolverificardocumentacion=data.user.permisos.find(permiso=>permiso.id===5)!=undefined
}
export function   auth_error(state){
  state.status = 'error'
}
export function salir(state){
  state.status = ''
  state.token = ''
  state.user = ''
  state.booluser=false
  state.boolregtramite=false
  state.boolform19=false
  state.boolfirmaregulacion=false
  state.boolverificardocumentacion=false
}
