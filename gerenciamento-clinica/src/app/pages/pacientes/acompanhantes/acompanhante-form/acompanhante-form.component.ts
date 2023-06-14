import { Component, EventEmitter, Output } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Acompanhante } from 'src/app/models/acompanhante.model';
import { Constants } from 'src/app/shared/constants';
import { cpfValidator } from 'src/app/validators/cpf.validator';
@Component({
  selector: 'app-acompanhante-form',
  templateUrl: './acompanhante-form.component.html',
  styleUrls: ['./acompanhante-form.component.scss']
})
export class AcompanhanteFormComponent {

  @Output() submitAcompanhante = new EventEmitter<Acompanhante>();

  public form: FormGroup;

  public genericRequired: string = Constants.genericRequired;

  constructor(private formBuilder: FormBuilder,
    public activeModal: NgbActiveModal) {
    this.form = formBuilder.group({
      'no_acompanhante': [null, Validators.required],
      'nu_cpf': [null, [cpfValidator.isValidCpf(), Validators.required]],
      'nu_telefone': [null, Validators.required],
      'ds_email': [null, Validators.email],
    })
  }

  submit() {
    if (this.form.invalid) {
      return;
    }
    this.submitAcompanhante.emit(this.form.value);
    this.activeModal.close();
  }
}
