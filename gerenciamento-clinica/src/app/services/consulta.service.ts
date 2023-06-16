import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Consulta } from '../models/consulta.model';
import { Sucesso, SucessoLista } from '../shared/sucesso.model';
import { Constants } from '../shared/constants';

@Injectable({
  providedIn: 'root'
})
export class ConsultaService {

  constructor(private http: HttpClient) {

  }

  create(consulta: Consulta) {
    return this.http.post<Sucesso<Consulta>>(`${Constants.api}/consultaCreate.php`, consulta);
  }

  findAll() {
    return this.http.get<SucessoLista<Consulta>>(`${Constants.api}/consultaFindAll.php`);
  }

}
