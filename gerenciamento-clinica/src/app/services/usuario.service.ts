import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Usuario } from '../models/usuario.model';
import { Sucesso } from '../shared/sucesso.model';
import { Constants } from '../shared/constants';

@Injectable({
  providedIn: 'root'
})
export class UsuarioService {

  constructor(private http: HttpClient) { }

  login(usuario: Usuario) {
    return this.http.post<Sucesso<Usuario>>(`${Constants.api}/login.php`, usuario, Constants.options);
  }

  create(usuario: Usuario) {
    return this.http.post<Sucesso<any>>(`${Constants.api}/usuarioCreate.php`, usuario);
  }

}
