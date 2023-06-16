import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormGroupDirective, NgForm } from '@angular/forms';
import { DatePipe } from '@angular/common';
import { Estado } from 'src/app/models/estado.model';
import { CepService } from 'src/app/services/cep.service';
import { EstadoService } from 'src/app/services/estado.service';
import { Constants } from 'src/app/shared/constants';
import { cpfValidator } from 'src/app/validators/cpf.validator';
import { first, take } from 'rxjs';
import { PacienteService } from 'src/app/services/paciente.service';
import Swal from 'sweetalert2';
import { ActivatedRoute, Router } from '@angular/router';
import { ConvenioService } from 'src/app/services/convenio.service';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { AcompanhanteFormComponent } from '../acompanhantes/acompanhante-form/acompanhante-form.component';
import { Acompanhante } from 'src/app/models/acompanhante.model';
import { timeValidator } from 'src/app/validators/time.validator';

@Component({
  selector: 'app-paciente-form',
  templateUrl: './paciente-form.component.html',
  styleUrls: ['./paciente-form.component.scss']
})
export class PacienteFormComponent implements OnInit {

  public form: FormGroup;

  public genericRequired: string = Constants.genericRequired;

  public estados: Estado[] | undefined = [];

  public validating: boolean = false;

  private submited: boolean = false;

  private id_paciente!: number;

  set _id_paciente(value: number) {
    this.pacienteService.get(value).pipe(first()).subscribe((response) => {
      this.id_paciente = response.data.id_paciente;
      this.form.patchValue(response.data);
      this.form.patchValue(response.data.convenio);
      this.submit = this.update;
      this.form.get('acompanhante')?.setValue(response.data.acompanhante);
      this.form.get('no_acompanhante')?.setValue(response.data.acompanhante?.no_acompanhante);
    })
  }

  startDate = new Date(2002, 6, 1);

  @ViewChild('formDirective') private formDirective?: NgForm;

  constructor(private formBuilder: FormBuilder,
    private cepService: CepService,
    private estadoService: EstadoService,
    private pacienteService: PacienteService,
    private convenioService: ConvenioService,
    private modal: NgbModal,
    private router: Router,
    private route: ActivatedRoute,
    private datePipe: DatePipe
  ) {
    this.form = this.formBuilder.group({
      'no_paciente': [null, [Validators.required]],
      'nu_cpf': [null, [Validators.required, cpfValidator.isValidCpf()]],
      'nu_rg': [null, [Validators.required, Validators.minLength(5)]],
      'dt_nascimento': [null, [Validators.required, timeValidator.date(), timeValidator.lessThanToday()]],
      'ds_genero': [null, [Validators.required]],
      'nu_telefone': [null, [Validators.required]],
      'nu_cep': [null, [Validators.required]],
      'nu_paciente': [null],
      'ds_logradouro': [null, [Validators.required]],
      'ds_bairro': [null, [Validators.required]],
      'ds_cidade': [null, [Validators.required]],
      'co_estado': [null, [Validators.required]],
      'nu_convenio': [null],
      'id_convenio': [null],
      'no_mae': [null, [Validators.required]],
      'no_acompanhante': [null],
      'acompanhante': [null],
    })
    this.form.get('nu_cep')?.valueChanges.subscribe((value) => {
      if (value && value.length >= 8) {
        this.cepService.fillCep(value, this.form);
      }
    })
    this.form.get('dt_nascimento')?.valueChanges.subscribe((value) => {
      let today = new Date();
      let nascimento: string | Date | null = new Date(
        parseInt(value.substr(4, 4)),
        parseInt(value.substr(2, 2)) - 1,
        parseInt(value.substr(0, 2))
      );
      let age = today.getFullYear() - nascimento?.getFullYear();
      const monthDiff = today.getMonth() - nascimento?.getMonth();

      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < nascimento.getDate())) {
        age--;
      }

      if (age < 18) {
        this.form.get('no_acompanhante')?.addValidators(Validators.required);
        this.form.get('no_acompanhante')?.updateValueAndValidity();
      } else {
        this.form.get('no_acompanhante')?.clearValidators();
        this.form.get('no_acompanhante')?.updateValueAndValidity();
      }
    })
  }

  ngOnInit(): void {
    this.loadEstados();
    this.route.params.subscribe(params => {
      if (Object.keys(params).length > 0) {
        this._id_paciente = params['id'];
      }
    })
  }

  submit() {
    if (this.form.invalid || this.submited) {
      return;
    }
    this.submited = true;
    this.pacienteService.create(this.form.value).pipe(take(1), first()).subscribe((response) => {
      if (response.success) {
        Swal.fire({
          icon: 'success',
          text: response.mensagem,
          color: Constants.success,
          showDenyButton: true,
          denyButtonText: 'Voltar para Início',
          confirmButtonText: 'Continuar',
        }).then((response) => {
          if (response.isConfirmed || response.isDismissed) {
            this.form.reset();
            this.formDirective?.resetForm();
          } else if (response.isDenied) {
            this.router.navigate(['/principal']);
          }
        })
        this.submited = false;
      }
    });
  }

  update() {
    if (this.form.invalid || this.submited) {
      return;
    }
    this.submited = true;
    this.pacienteService.update(this.form.value, this.id_paciente).pipe(first()).subscribe((response) => {
      if (response.success) {
        Swal.fire({
          icon: 'success',
          text: response.mensagem,
          color: Constants.success,
          showDenyButton: true,
          denyButtonText: 'Voltar para Início',
          confirmButtonText: 'Continuar',
        }).then((response) => {
          if (response.isDenied) {
            this.router.navigate(['/principal']);
          }
        })
        this.submited = false;
      }
    })
  }

  loadEstados() {
    this.estadoService.findAll().pipe(first()).subscribe((response) => {
      this.estados = response.data;
    })
  }

  validateCpf() {
    this.validating = true;
    this.pacienteService.validateCpf(this.form.get('nu_cpf')?.value).pipe(first()).subscribe((response) => {
      if (!response.success) {
        this.form.get('nu_cpf')?.setErrors({ 'duplicate': true });
      }
      this.validating = false;
    })
  }

  validateRg() {
    this.validating = true;
    this.pacienteService.validateRg(this.form.get('nu_rg')?.value).pipe(first()).subscribe((response) => {
      if (!response.success) {
        this.form.get('nu_rg')?.setErrors({ 'duplicate': true });
      }
      this.validating = false;
    })
  }

  validateNumero() {
    this.validating = true;
    this.convenioService.validateNumero(this.form.get('nu_convenio')?.value).pipe(first()).subscribe((response) => {
      if (response.success) {
        this.form.get('id_convenio')?.setValue(response.data?.id_convenio);
      } else {
        this.form.get('nu_convenio')?.setErrors({ 'inexistent': true });
      }
      this.validating = false;
    })
  }

  openModalAcompanhante() {
    const acompanhanteModal = this.modal.open(AcompanhanteFormComponent, { 'size': 'md' });
    acompanhanteModal.componentInstance.submitAcompanhante.subscribe(($e: Acompanhante) => {
      this.form.get('acompanhante')?.setValue($e);
      this.form.get('no_acompanhante')?.setValue($e.no_acompanhante);
    })

  }

}
