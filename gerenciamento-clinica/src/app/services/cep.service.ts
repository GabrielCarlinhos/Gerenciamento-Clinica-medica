import { HttpClient } from "@angular/common/http";
import { Injectable } from "@angular/core";
import { FormGroup, Validators } from "@angular/forms";
import { Cep } from "../models/cep.model";
import { first } from "rxjs";
import { Constants } from "../shared/constants";


@Injectable({
  providedIn: 'root'
})
export class CepService {
  constructor(private http: HttpClient) {

  }

  fillCep(cep: string, form: FormGroup) {
    this.http.get<Cep>(`https://viacep.com.br/ws/${cep}/json/`).pipe(first()).subscribe((response) => {
      if (!response.erro) {
        form.get('nu_cep')?.setErrors(null);
        form.get('ds_logradouro')?.setValue(response.logradouro);
        form.get('ds_bairro')?.setValue(response.bairro);
        form.get('ds_cidade')?.setValue(response.localidade);
        form.get('co_estado')?.setValue(response.uf);
      } else {
        form.get('nu_cep')?.setErrors({ 'customError': true });
      }
    })
  }
}
