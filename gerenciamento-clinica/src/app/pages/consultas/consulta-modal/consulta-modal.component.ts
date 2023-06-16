import { Component, Input } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Agendamento } from 'src/app/models/agendamento.model';
import { Especialidade } from 'src/app/models/especialidade.model';
import { ConsultaService } from 'src/app/services/consulta.service';
import { first } from 'rxjs';
import { ToastrService } from 'ngx-toastr';
import { Constants } from 'src/app/shared/constants';

@Component({
  selector: 'app-consulta-modal',
  templateUrl: './consulta-modal.component.html',
  styleUrls: ['./consulta-modal.component.scss']
})


export class ConsultaModalComponent {

  public form: FormGroup;

  @Input() set agenda(value: Agendamento) {
    if (value.paciente.id_convenio != null) {
      this.convenios.push('convênio');
    }
    this.form.patchValue(value);
  }

  private defaultValue!: number;

  @Input() set especialidade(value: Especialidade) {
    this.form.patchValue(value);
    this.defaultValue = value.vl_consulta;
  }

  public convenios: string[] = ['social', 'particular'];

  private submited: boolean = false;

  constructor(
    private formBuilder: FormBuilder,
    public activeModal: NgbActiveModal,
    private consultaService: ConsultaService,
    private toastr: ToastrService,
  ) {
    this.form = this.formBuilder.group({
      'dt_consulta': [new Date()],
      'vl_consulta': [null],
      'ds_convenio': ['particular'],
      'id_paciente': [null],
      'nu_crm_doutor': [null],
    })
  }

  submit() {
    if (this.form.invalid || this.submited) {
      return;
    }
    this.submited = true;
    this.consultaService.create(this.form.value).pipe(first()).subscribe((response) => {
      if (response.success) {
        this.activeModal.close();
        this.toastr.success(response.mensagem, "Sucesso!", Constants.toastOptions);
      }
    })
  }

  validateConvenio() {
    switch (this.form.get('ds_convenio')?.value) {
      case 'social' || 'convênio':
        this.form.get('vl_consulta')?.setValue(0);
        break;
      case 'particular':
        this.form.get('vl_consulta')?.setValue(this.defaultValue);
        break;
    }
  }
}
