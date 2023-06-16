import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { Prontuario } from "../models/prontuario.model";
import { Sucesso } from "../shared/sucesso.model";
import { Constants } from "../shared/constants";


@Injectable
  ({
    providedIn: 'root'
  })
export class ProntuarioService {
  constructor(private http: HttpClient) {

  }

  create(prontuario: Prontuario) {
    return this.http.post<Sucesso<Prontuario>>(`${Constants.api}/prontuarioCreate.php`, prontuario);
  }

  get(id: number) {
    return this.http.get<Sucesso<Prontuario>>(`${Constants.api}/prontuarioGet.php?id=${id}`);
  }

  update(prontuario: Prontuario, id: number) {
    return this.http.post<Sucesso<Prontuario>>(`${Constants.api}/prontuarioUpdate.php?id=${id}`, prontuario);
  }

}
