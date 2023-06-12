import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { first } from 'rxjs';
import { Doutor } from 'src/app/models/doutor.model';
import { Especialidade } from 'src/app/models/especialidade.model';
import { Estado } from 'src/app/models/estado.model';
import { DoutorService } from 'src/app/services/doutor.service';
import { EspecialidadeService } from 'src/app/services/especialidade.service';
import { EstadoService } from 'src/app/services/estado.service';
import { Constants } from 'src/app/shared/constants';
import Swal from 'sweetalert2';


@Component({
  selector: 'app-doutores-form',
  templateUrl: './doutores-form.component.html',
  styleUrls: ['./doutores-form.component.scss']
})
export class DoutoresFormComponent implements OnInit {

  public form: FormGroup;

  public estados: Estado[] | undefined = [];

  public especialidades: Especialidade[] | undefined = [];

  constructor(private formBuilder: FormBuilder,
    private estadoService: EstadoService,
    private doutorService: DoutorService,
    private especialidadeService: EspecialidadeService,
    private router: Router,
  ) {
    this.form = this.formBuilder.group({
      'nu_crm': null,
      'no_doutor': null,
      'nu_cpf': null,
      'nu_rg': null,
      'nu_telefone': null,
      'nu_cep': null,
      'nu_doutor': null,
      'ds_logradouro': null,
      'ds_bairro': null,
      'co_estado': null,
      'ds_cidade': null,
      'co_especialidade': null,
    })
  }

  ngOnInit(): void {
    this.loadEstados();
    this.loadEspecialidades();
  }

  loadEstados() {
    this.estadoService.findAll().pipe(first()).subscribe((response) => {
      this.estados = response.data;
    })
  }

  loadEspecialidades() {
    this.especialidadeService.findAll().pipe(first()).subscribe((response) => {
      this.especialidades = response.data;
    })
  }

  navigateCep(){
    window.open("https://buscacepinter.correios.com.br/app/endereco/index.php",'_blank');
  }

  submit() {
    this.doutorService.create(this.form.value).pipe(first()).subscribe((response) => {
      if (response.success) {
        Swal.fire({
          icon: 'success',
          text: response.mensagem,
          color: Constants.success,
          showDenyButton: true,
          denyButtonText: 'Voltar para Início',
          confirmButtonText: 'Continuar',
        }).then((result) => {
          if (result.isDenied) {
            this.router.navigate(['/principal']);
          }else if(result.isConfirmed){
            this.form.reset();
          }
        });
      }
    })
  }

}
