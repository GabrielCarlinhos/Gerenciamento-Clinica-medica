import { HttpClient } from "@angular/common/http";
import { Injectable } from "@angular/core";
import { SucessoLista } from "../shared/sucesso.model";
import { Constants } from "../shared/constants";
import { Estado } from "../models/estado.model";

@Injectable({
    providedIn: 'root'
})
export class EstadoService {

    constructor(private http: HttpClient) {

    }

    findAll() {
        return this.http.get<SucessoLista<Estado>>(`${Constants.api}/estadosFindAll.php`);
    }
}