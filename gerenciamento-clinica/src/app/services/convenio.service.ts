import { Injectable } from "@angular/core";
import { HttpClient } from '@angular/common/http';
import { Convenio } from "../models/convenio.model";
import { Sucesso } from "../shared/sucesso.model";
import { Constants } from "../shared/constants";

@Injectable({
  providedIn: 'root'
})
export class ConvenioService {
  constructor(private http: HttpClient) {

  }

  create(convenio: Convenio) {
    return this.http.post<Sucesso<Convenio>>(`${Constants.api}/convenioCreate.php`, convenio);
  }

  validateNumero(numero: number) {
    return this.http.get<Sucesso<Convenio>>(`${Constants.api}/convenioValidateNumero.php?numero=${numero}`);
  }

}
