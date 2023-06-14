import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Sucesso, SucessoLista } from '../shared/sucesso.model';
import { Doutor } from '../models/doutor.model';
import { Constants } from '../shared/constants';

@Injectable({
  providedIn: 'root'
})
export class DoutorService {
  constructor(private http: HttpClient) { }

  create(doutor: Doutor) {
    return this.http.post<Sucesso<Doutor>>(`${Constants.api}/doutorCreate.php`, doutor);
  }

  validateCpf(cpf: string) {
    return this.http.get<any>(`${Constants.api}/doutorValidateCpf.php?cpf=${cpf}`);
  }

  validateCrm(crm: string) {
    return this.http.get<any>(`${Constants.api}/doutorValidateCrm.php?crm=${crm}`);
  }

  validateRg(rg: string) {
    return this.http.get<any>(`${Constants.api}/doutorValidateRg.php?rg=${rg}`);
  }

  findAll() {
    return this.http.get<SucessoLista<Doutor>>(`${Constants.api}/doutorFindAll.php`);
  }

  delete(crm: string) {
    return this.http.put<Sucesso<any>>(`${Constants.api}/doutorDelete.php?crm=${crm}`, {});
  }

  update(doutor: Doutor, crm: string) {
    return this.http.put<Sucesso<Doutor>>(`${Constants.api}/doutorUpdate.php?crm=${crm}`, doutor);
  }

  get(crm: string) {
    return this.http.get<Sucesso<Doutor>>(`${Constants.api}/doutorGet.php?crm=${crm}`);
  }

}
