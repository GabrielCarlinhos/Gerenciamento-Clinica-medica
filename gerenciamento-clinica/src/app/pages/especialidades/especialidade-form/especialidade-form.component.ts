import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators, NgForm } from '@angular/forms';

import { EspecialidadeService } from 'src/app/services/especialidade.service';
import { first } from 'rxjs';
import Swal from 'sweetalert2';
import { Constants } from 'src/app/shared/constants';
import { Router } from '@angular/router';




@Component({
  selector: 'app-especialidade-form',
  templateUrl: './especialidade-form.component.html',
  styleUrls: ['./especialidade-form.component.scss']
})
export class EspecialidadeFormComponent implements OnInit {

  public genericRequired: string = Constants.genericRequired;

  public form: FormGroup;

  public currencyConfig = Constants.currencyMaskConfig;

  @ViewChild('formDirective') private formDirective?: NgForm;

  constructor(
    private formBuilder: FormBuilder,
    private especialiadeService: EspecialidadeService,
    private router: Router,
  ) {
    this.form = formBuilder.group({
      ds_especialidade: [null, Validators.required],
      vl_consulta: [null, Validators.required],
    })
  }

  ngOnInit(): void {

  }

  submit() {
    this.especialiadeService.create(this.form.value).pipe(first()).subscribe((response) => {
      if (response.success) {
        Swal.fire({
          text: response.mensagem,
          color: Constants.success,
          icon: 'success',
          showDenyButton: true,
          denyButtonText: 'Voltar para o início',
          showCancelButton: true,
          cancelButtonText: 'Continuar',
          cancelButtonColor: Constants.info,
          confirmButtonText: 'Ir para Doutores'
        }).then((response) => {
          if (response.isDenied) {
            this.router.navigate(['/principal'])
          } else if (response.isConfirmed) {
            this.router.navigate(['/doutor/form']);
          } else if (response.isDismissed) {
            this.form.reset();
            this.formDirective?.resetForm();
          }
        })
      } else {

      }
    })
  }

}
