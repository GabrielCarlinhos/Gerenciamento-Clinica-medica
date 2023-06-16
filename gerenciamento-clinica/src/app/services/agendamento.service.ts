import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { AgendamentoDto } from "../dto/agendamento.dto";
import { Constants } from "../shared/constants";
import { Sucesso, SucessoLista } from "../shared/sucesso.model";
import { Agendamento } from "../models/agendamento.model";

@Injectable({
  providedIn: 'root'
})
export class AgendamentoService {
  constructor(private http: HttpClient) {

  }

  create(agendamento: Agendamento) {
    return this.http.post<Sucesso<Agendamento>>(`${Constants.api}/agendamentoCreate.php`, agendamento);
  }

  agendamento() {
    return this.http.get<SucessoLista<AgendamentoDto>>(`${Constants.api}/agendas.php`);
  }

  get(id: number) {
    return this.http.get<Sucesso<Agendamento>>(`${Constants.api}/agendamentoGet.php?id=${id}`);
  }

  update(agendamento: Agendamento, id: number) {
    return this.http.put<Sucesso<Agendamento>>(`${Constants.api}/agendamentoUpdate.php?id=${id}`, agendamento);
  }

  delete(id: number, motivo: string) {
    return this.http.put<Sucesso<any>>(`${Constants.api}/agendamentoDelete.php?id=${id}&motivo=${motivo}`, {});
  }
}
