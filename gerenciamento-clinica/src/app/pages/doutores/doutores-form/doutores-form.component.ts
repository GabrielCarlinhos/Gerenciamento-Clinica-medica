import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { first } from 'rxjs';
import { Doutor } from 'src/app/models/doutor.model';
import { Estado } from 'src/app/models/estado.model';
import { EstadoService } from 'src/app/services/estado.service';


@Component({
  selector: 'app-doutores-form',
  templateUrl: './doutores-form.component.html',
  styleUrls: ['./doutores-form.component.scss']
})
export class DoutoresFormComponent implements OnInit {

  public form: FormGroup;

  public estados: Estado[] | undefined = [];

  constructor(private formBuilder: FormBuilder,
    private estadoService: EstadoService) {
    this.form = this.formBuilder.group({
      'nu_crm': null,
      'no_doutor': null,
      'nu_cpf': null,
      'nu_rg': null,
      'nu_telefone': null,
      'nu_cep': null,
      'nu_doutor': null,
      'ds_rua': null,
      'ds_bairro': null,
      'co_estado': null,
      'ds_cidade': null,
      'co_especialidade': null,
    })
  }

  ngOnInit(): void {
    this.loadEstados();
  }

  loadEstados() {
    this.estadoService.findAll().pipe(first()).subscribe((response) => {
      this.estados = response.data;
    })
  }

}
