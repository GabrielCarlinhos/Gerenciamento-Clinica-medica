import { HttpClient } from "@angular/common/http";
import { Injectable } from "@angular/core";
import { Paciente } from "../models/paciente.model";
import { Sucesso, SucessoLista } from "../shared/sucesso.model";
import { Constants } from "../shared/constants";

@Injectable({
  providedIn: 'root'
})
export class PacienteService {
  constructor(private http: HttpClient) { }

  create(paciente: Paciente) {
    return this.http.post<Sucesso<Paciente>>(`${Constants.api}/pacienteCreate.php`, paciente);
  }

  validateCpf(cpf: string) {
    return this.http.get<Sucesso<any>>(`${Constants.api}/pacienteValidateCpf.php?cpf=${cpf}`);
  }

  validateRg(rg: string) {
    return this.http.get<Sucesso<any>>(`${Constants.api}/pacienteValidateRg.php?rg=${rg}`);
  }

  findAll() {
    return this.http.get<SucessoLista<Paciente>>(`${Constants.api}/pacienteFindAll.php`);
  }

  delete(id?: number) {
    return this.http.put<Sucesso<any>>(`${Constants.api}/pacienteDelete.php?id=${id}`, {});
  }

  update(paciente: Paciente, id: number) {
    return this.http.put<Sucesso<Paciente>>(`${Constants.api}/pacienteUpdate.php?id=${id}`, paciente);
  }

  get(id: number) {
    return this.http.get<Sucesso<Paciente>>(`${Constants.api}/pacienteGet.php?id=${id}`);
  }

}
