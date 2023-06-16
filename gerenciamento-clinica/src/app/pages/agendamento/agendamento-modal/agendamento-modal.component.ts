import { Component, Input, Output, EventEmitter } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { first } from 'rxjs';
import { Agendamento } from 'src/app/models/agendamento.model';
import { AgendamentoService } from 'src/app/services/agendamento.service';
import { PacienteService } from 'src/app/services/paciente.service';
import { Constants } from 'src/app/shared/constants';
import { cpfValidator } from 'src/app/validators/cpf.validator';
import { timeValidator } from 'src/app/validators/time.validator';

@Component({
  selector: 'app-agendamento-modal',
  templateUrl: './agendamento-modal.component.html',
  styleUrls: ['./agendamento-modal.component.scss']
})
export class AgendamentoModalComponent {
  public form: FormGroup;

  public genericRequired: string = Constants.genericRequired;

  private submited: boolean = false;

  public reagendar: boolean = false;

  public no_paciente!: string;

  public idAgenda!: number;

  @Output() setAgenda = new EventEmitter<any>();

  @Input() set agendamento(value: Agendamento) {
    this.form.patchValue(value);
    this.no_paciente = value.paciente.no_paciente;
    this.form.patchValue(value.paciente);
    this.submit = this.update;
    this.reagendar = true;
    this.idAgenda = value.co_agendamento;
  }

  @Input() set nu_crm_doutor(value: string) {
    this.form.get('nu_crm_doutor')?.setValue(value);
  }

  constructor(
    private formBuilder: FormBuilder,
    private agendamentoService: AgendamentoService,
    public activeModal: NgbActiveModal,
    private pacienteService: PacienteService,
    private toastr: ToastrService,
  ) {
    this.form = this.formBuilder.group({
      dt_agendamento: [null, [Validators.required, timeValidator.date(), timeValidator.invertValidator(timeValidator.lessThanToday())]],
      hr_agendamento: [null, [Validators.required, timeValidator.hourMinute()]],
      nu_cpf: [null, [Validators.required, cpfValidator.isValidCpf()]],
      id_paciente: [null, [Validators.required]],
      nu_crm_doutor: [null, Validators.required],
    });
  }

  checkCpfPaciente() {
    this.pacienteService.validateCpf(this.form.get('nu_cpf')?.value).pipe(first()).subscribe((response) => {
      if (!response.success) {
        this.form.patchValue(response.data);
      } else {
        this.form.get('nu_cpf')?.setErrors({ 'cpfNotFound': true });
      }
    })
  }

  submit() {
    if (this.form.invalid || this.submited) {
      return;
    }
    this.submited = true;
    this.agendamentoService.create(this.form.value).pipe(first()).subscribe((response) => {
      if (response.success) {
        this.toastr.success(response.mensagem, "Sucesso!", Constants.toastOptions);
        this.setAgenda.emit();
        this.activeModal.close();
      }
      this.submited = false;
    })
  }

  update() {
    if (this.form.invalid || this.submited) {
      return;
    }
    this.submited = true;
    this.agendamentoService.update(this.form.value, this.idAgenda).pipe(first()).subscribe((response) => {
      if (response.success) {
        this.toastr.success(response.mensagem, "Sucesso!", Constants.toastOptions);
        this.setAgenda.emit();
        this.activeModal.close();
      }
      this.submited = false;
    })
  }

}
