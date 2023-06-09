import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Usuario } from '../models/usuario.model';

@Injectable({
    providedIn: 'root'
})
export class UsuarioService {

    private path: string = '../../../../Controller/processa_login.php';

    constructor(private http: HttpClient) { }

    login(model: Usuario) {
        return this.http.post<Usuario>(`${this.path}`, model);
    }

}