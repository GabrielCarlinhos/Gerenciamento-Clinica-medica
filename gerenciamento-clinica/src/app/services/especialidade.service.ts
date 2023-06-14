import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Sucesso, SucessoLista } from '../shared/sucesso.model';
import { Especialidade } from '../models/especialidade.model';
import { Constants } from '../shared/constants';

@Injectable({
  providedIn: 'root'
})
export class EspecialidadeService {

  constructor(private http: HttpClient) { }

  create(especialidade: Especialidade) {
    return this.http.post<Sucesso<Especialidade>>(`${Constants.api}/especialidadeCreate.php`, especialidade);
  }

  findAll() {
    return this.http.get<SucessoLista<Especialidade>>(`${Constants.api}/especialidadeFindAll.php`);
  }

  delete(id: number) {
    return this.http.put<Sucesso<any>>(`${Constants.api}/especialidadeDelete.php?id=${id}`, {});
  }

  update(especialidade: Especialidade, id: number) {
    return this.http.put<Sucesso<Especialidade>>(`${Constants.api}/especialidadeUpdate.php?id=${id}`, especialidade);
  }

}
