import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormControl, FormGroupDirective, NgForm } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { first, take } from 'rxjs';
import { Especialidade } from 'src/app/models/especialidade.model';
import { Estado } from 'src/app/models/estado.model';
import { CepService } from 'src/app/services/cep.service';
import { DoutorService } from 'src/app/services/doutor.service';
import { EspecialidadeService } from 'src/app/services/especialidade.service';
import { EstadoService } from 'src/app/services/estado.service';
import { Constants } from 'src/app/shared/constants';
import { cpfValidator } from 'src/app/validators/cpf.validator';

import Swal from 'sweetalert2';
import { EspecialidadeFormComponent } from '../../especialidades/especialidade-form/especialidade-form.component';


@Component({
  selector: 'app-doutores-form',
  templateUrl: './doutores-form.component.html',
  styleUrls: ['./doutores-form.component.scss']
})
export class DoutoresFormComponent implements OnInit {

  public genericRequired: string = Constants.genericRequired;

  public form: FormGroup;

  public estados: Estado[] | undefined = [];

  public especialidades: Especialidade[] | undefined = [];

  public validating: boolean = false;

  private submited: boolean = false;

  public selectedEspecialidade: string | null = null;

  private crm_doutor!: string;
  set _crm_doutor(value: string) {
    this.crm_doutor = value;
    this.doutorService.get(value).pipe(first()).subscribe((response) => {
      if (response.success) {
        this.form.patchValue(response.data);
        this.submit = this.update;
      }
    })
  }

  @ViewChild('formDirective') private formDirective?: NgForm

  constructor(private formBuilder: FormBuilder,
    private estadoService: EstadoService,
    private doutorService: DoutorService,
    private especialidadeService: EspecialidadeService,
    private modal: NgbModal,
    private router: Router,
    private cepService: CepService,
    private route: ActivatedRoute,
  ) {
    this.form = this.formBuilder.group({
      'nu_crm': [null, [Validators.required]],
      'no_doutor': [null, [Validators.required]],
      'nu_cpf': [null, [Validators.required, cpfValidator.isValidCpf()]],
      'nu_rg': [null, [Validators.required, Validators.minLength(5)]],
      'nu_telefone': [null],
      'nu_cep': [null, Validators.required],
      'nu_doutor': null,
      'ds_logradouro': [null, Validators.required],
      'ds_bairro': [null, Validators.required],
      'co_estado': [null, Validators.required],
      'ds_cidade': [null, Validators.required],
      'co_especialidade': [null, Validators.required],
    })

    this.form.get('nu_cep')?.valueChanges.subscribe((value) => {
      if (value && value.toString().length >= 8) {
        this.cepService.fillCep(value, this.form);
      }
    })
  }

  ngOnInit(): void {
    if (this.route.params)
      this.route.params.subscribe((params) => {
        if (Object.keys(params).length > 0) {
          this._crm_doutor = params['crm'];
        }
      })
    this.loadEstados();
    this.loadEspecialidades();
  }

  loadEstados() {
    this.estadoService.findAll().pipe(first()).subscribe((response) => {
      this.estados = response.data;
    })
  }

  loadEspecialidades(setValue: string | null = null) {
    this.especialidadeService.findAll().pipe(first()).subscribe((response) => {
      this.especialidades = response.data;
      this.selectedEspecialidade = setValue;
    })
  }

  navigateCep() {
    window.open("https://buscacepinter.correios.com.br/app/endereco/index.php", '_blank');
  }

  submit() {
    if (this.form.invalid || this.submited) {
      return;
    }
    this.submited = true;
    this.doutorService.create(this.form.value).pipe(first(), take(1)).subscribe((response) => {
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
          } else if (result.isConfirmed || result.isDismissed) {
            this.form.reset();
            this.formDirective?.resetForm();
          }
        });
      }
      this.submited = false;
    })
  }

  update() {
    if (this.form.invalid || this.validating) {
      return;
    }
    this.submited = true;
    this.doutorService.update(this.form.value, this.crm_doutor).pipe(first()).subscribe((response) => {
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
          }
        })
      }
      this.submited = false;
    })
  }

  validateCrm() {
    this.validating = true;
    this.doutorService.validateCrm(this.form.get('nu_crm')?.value).pipe(first()).subscribe((response) => {
      if (!response.success) {
        this.form.get('nu_crm')?.setErrors({ 'duplicate': true });
        this.validating = false
      } else {
        this.validating = false;
      }
    })
  }

  openModalEspecialidades() {
    const modalEspecialidade = this.modal.open(EspecialidadeFormComponent, { size: 'md' });
    modalEspecialidade.componentInstance.setEspecialidade.subscribe(($e: Especialidade) => {
      this.loadEspecialidades(String($e.co_especialidade));
    })
  }

  validateRg() {
    this.validating = true;
    this.doutorService.validateRg(this.form.get('nu_rg')?.value).pipe(first()).subscribe((response) => {
      if (!response.success) {
        this.form.get('nu_rg')?.setErrors({ 'duplicate': true });
        this.validating = false
      } else {
        this.validating = false;
      }
    })
  }

  validateCpf() {
    this.validating = true;
    this.doutorService.validateCpf(this.form.get('nu_cpf')?.value).pipe(first()).subscribe((response) => {
      if (!response.success) {
        this.form.get('nu_cpf')?.setErrors({ 'duplicate': true });
        this.validating = false
      } else {
        this.validating = false;
      }
    })
  }

}
