import { HttpClient } from "@angular/common/http";
import { Injectable } from "@angular/core";
import { Paciente } from "../models/paciente.model";
import { Sucesso } from "../shared/sucesso.model";
import { Constants } from "../shared/constants";

@Injectable({
  providedIn: 'root'
})
export class PacienteService {
  constructor(private http: HttpClient) { }

  create(paciente: Paciente) {
    return this.http.post<Sucesso<Paciente>>(`${Constants.api}/pacienteCreate.php`, paciente);
  }
}
