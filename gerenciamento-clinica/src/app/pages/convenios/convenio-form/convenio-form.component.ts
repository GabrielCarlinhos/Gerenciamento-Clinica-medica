import { Component, ViewChild } from '@angular/core';
import { FormGroup, FormBuilder, Validators, NgForm } from '@angular/forms';
import { Router } from '@angular/router';
import { first } from 'rxjs';
import { ConvenioService } from 'src/app/services/convenio.service';
import { Constants } from 'src/app/shared/constants';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-convenio-form',
  templateUrl: './convenio-form.component.html',
  styleUrls: ['./convenio-form.component.scss']
})
export class ConvenioFormComponent {

  public form: FormGroup;

  public genericRequired: string = Constants.genericRequired;

  public validating: boolean = false;

  private submited: boolean = false;

  @ViewChild('formDirective') private formDirective?: NgForm;

  constructor(private formBuilder: FormBuilder,
    private convenioService: ConvenioService,
    private router: Router,
  ) {
    this.form = formBuilder.group({
      'no_convenio': [null, Validators.required],
      'nu_convenio': [null, Validators.required],
    })
    this.form.get('nu_convenio')?.valueChanges.subscribe((value) => {
      this.validating = true;
      this.convenioService.validateNumero(this.form.get('nu_convenio')?.value).pipe(first()).subscribe((response) => {
        if (!response.success) {
          this.form.get('nu_convenio')?.setErrors({ 'duplicate': true });
        }
        this.validating = false;
      })
    })
  }

  submit() {
    if (this.form.invalid || this.submited) {
      return;
    }
    this.submited = true;
    this.convenioService.create(this.form.value).pipe(first()).subscribe((response) => {
      if (response.success) {
        Swal.fire({
          text: response.mensagem,
          color: Constants.success,
          icon: 'success',
          showDenyButton: true,
          denyButtonText: 'Voltar para o início',
          confirmButtonText: 'Continuar',
        }).then((response) => {
          if (response.isDenied) {
            this.router.navigate(['/principal']);
          } else if (response.isConfirmed || response.isDismissed) {
            this.form.reset();
            this.formDirective?.resetForm();
          }
        })
        this.submited = false;
      }
    })
  }

}
