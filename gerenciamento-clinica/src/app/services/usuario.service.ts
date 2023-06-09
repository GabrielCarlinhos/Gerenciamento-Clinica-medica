import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Usuario } from '../models/usuario.model';

@Injectable({
    providedIn: 'root'
})
export class UsuarioService {

    private path: string = 'http://localhost/gerenciamento-clinica-medica/controller';

    constructor(private http: HttpClient) { }

    login(model: Usuario) {
        return this.http.post<Usuario>(`${this.path}/processa_login.php`, model);
    }

}