import { Component, Input } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { first } from 'rxjs';
import { ProntuarioService } from 'src/app/services/prontuario.service';
import { Constants } from 'src/app/shared/constants';

@Component({
  selector: 'app-prontuario-modal',
  templateUrl: './prontuario-modal.component.html',
  styleUrls: ['./prontuario-modal.component.scss']
})
export class ProntuarioModalComponent {

  public bloodTypes: string[] = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];


  public form: FormGroup;

  private submited: boolean = false;

  private id_prontuario?: number;

  @Input() set co_consulta(value: number) {
    this.prontuarioService.get(value).pipe(first()).subscribe((response) => {
      if (response.success) {
        this.form.patchValue(response.data);
        this.submit = this.update;
        this.id_prontuario = response.data.id_prontuario;
      }

    })
    this.form.get('co_consulta')?.setValue(value);
  }

  @Input() no_paciente?: string;

  constructor(private prontuarioService: ProntuarioService,
    public activeModal: NgbActiveModal,
    private formBuilder: FormBuilder,
    private toastr: ToastrService) {
    this.form = this.formBuilder.group({
      'nu_peso': null,
      'nu_altura': null,
      'nu_imc': null,
      'ds_exame_fisico': null,
      'ds_solicitacao_exame': null,
      'tp_sanguineo': null,
      'ds_alergias': null,
      'co_consulta': null,
    })
  }

  submit() {
    if (this.form.invalid || this.submited) {
      return
    }
    this.submited = true;
    this.prontuarioService.create(this.form.value).pipe(first()).subscribe((response) => {
      if (response.success) {
        this.toastr.success(response.mensagem, "Sucesso!", Constants.toastOptions);
        this.activeModal.close();
      }
    })
  }

  update() {
    if (this.form.invalid || this.submited) {
      return
    }
    this.submited = true;
    this.prontuarioService.update(this.form.value, this.id_prontuario!).pipe(first()).subscribe((response) => {
      if (response.success) {
        this.toastr.success(response.mensagem, "Sucesso!", Constants.toastOptions);
        this.activeModal.close();
      }
    })
  }

  calculateBmi() {

    let peso = this.form.get('nu_peso')?.value;
    let altura = this.form.get('nu_altura')?.value;
    if (peso == null || altura == null) {
      return;
    }
    this.form.get('nu_imc')?.setValue((peso / ((altura / 100) * (altura / 100))).toFixed(2));
  }

}
