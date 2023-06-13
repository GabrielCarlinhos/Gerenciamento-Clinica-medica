import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormGroupDirective, NgForm } from '@angular/forms';
import { Estado } from 'src/app/models/estado.model';
import { CepService } from 'src/app/services/cep.service';
import { EstadoService } from 'src/app/services/estado.service';
import { Constants } from 'src/app/shared/constants';
import { cpfValidator } from 'src/app/validators/cpf.validator';
import { first } from 'rxjs';
import { PacienteService } from 'src/app/services/paciente.service';
import Swal from 'sweetalert2';
import { Router } from '@angular/router';

@Component({
  selector: 'app-paciente-form',
  templateUrl: './paciente-form.component.html',
  styleUrls: ['./paciente-form.component.scss']
})
export class PacienteFormComponent implements OnInit {

  public form: FormGroup;

  public genericRequired: string = Constants.genericRequired;

  public estados: Estado[] | undefined = [];

  @ViewChild('formDirective') private formDirective?: NgForm;

  constructor(private formBuilder: FormBuilder,
    private cepService: CepService,
    private estadoService: EstadoService,
    private pacienteService: PacienteService,
    private router: Router,
  ) {
    this.form = this.formBuilder.group({
      'no_paciente': [null, [Validators.required]],
      'nu_cpf': [null, [Validators.required, cpfValidator.isValidCpf()]],
      'nu_rg': [null, [Validators.required, Validators.minLength(5)]],
      'dt_nascimento': [null, [Validators.required]],
      'ds_genero': [null, [Validators.required]],
      'nu_telefone': [null, [Validators.required]],
      'nu_cep': [null, [Validators.required]],
      'nu_paciente': [null, [Validators.required]],
      'ds_logradouro': [null, [Validators.required]],
      'ds_bairro': [null, [Validators.required]],
      'ds_cidade': [null, [Validators.required]],
      'co_estado': [null, [Validators.required]],
      'id_convenio': [null],
    })
    this.form.get('nu_cep')?.valueChanges.subscribe((value) => {
      if (value && value.length >= 8) {
        this.cepService.fillCep(value, this.form);
      }
    })
  }

  ngOnInit(): void {
    this.loadEstados();
  }

  submit() {
    if (this.form.invalid) {
      return;
    }
    this.pacienteService.create(this.form.value).pipe(first()).subscribe((response) => {
      if (response.success) {
        Swal.fire({
          icon: 'success',
          text: response.mensagem,
          color: Constants.success,
          showDenyButton: true,
          denyButtonText: 'Voltar para Início',
          confirmButtonText: 'Continuar',
        }).then((response) => {
          if (response.isConfirmed) {
            this.form.reset();
            this.formDirective?.resetForm();
          } else if (response.isDenied) {
            this.router.navigate(['/principal']);
          }
        })
      }
    })
  }

  loadEstados() {
    this.estadoService.findAll().pipe(first()).subscribe((response) => {
      this.estados = response.data;
    })
  }

}
