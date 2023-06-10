import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Usuario } from '../models/usuario.model';
import { Sucesso } from '../shared/sucesso.model';
import { Constants } from '../shared/constants';

@Injectable({
    providedIn: 'root'
})
export class UsuarioService {

    private path: string = Constants.api;
    private options = { withCredentials: true };;

    constructor(private http: HttpClient) { }

    login(model: Usuario) {
        return this.http.post<Sucesso<Usuario>>(`${this.path}/processa_login.php`, model, this.options);
    }

}