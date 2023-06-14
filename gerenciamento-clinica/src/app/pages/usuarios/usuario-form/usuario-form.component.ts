import { Component, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators, NgForm } from '@angular/forms';
import { Router } from '@angular/router';
import { first } from 'rxjs';
import { UsuarioService } from 'src/app/services/usuario.service';
import { Constants } from 'src/app/shared/constants';
import { PasswordValidator } from 'src/app/validators/password.validator';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-usuario-form',
  templateUrl: './usuario-form.component.html',
  styleUrls: ['./usuario-form.component.scss']
})
export class UsuarioFormComponent {

  public form: FormGroup;

  public genericRequired: string = Constants.genericRequired;

  public types: string[] = ['doutor', 'admin'];

  public submited: boolean = false;

  @ViewChild('formDirective') private formDirective?: NgForm;

  constructor(private formBuilder: FormBuilder,
    private usuarioService: UsuarioService,
    private router: Router
  ) {
    this.form = this.formBuilder.group({
      'no_usuario': [null, Validators.required],
      'ds_senha': [null, [Validators.required, PasswordValidator.passwordValidator()]],
      'ds_confirma_senha': [null],
      'ds_email': [null, [Validators.required, Validators.email]],
      'ds_tipo_usuario': [this.types[0], [Validators.required]],
    })
    this.form.get('ds_confirma_senha')?.addValidators(PasswordValidator.passwordMatch(this.form));
  }

  submit() {
    if (this.form.invalid || this.submited) {
      return;
    }
    this.submited = true;
    this.usuarioService.create(this.form.value).pipe(first()).subscribe((response) => {
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
      } else {
        console.log(response.mensagem);
      }
      this.submited = false;
    })
  }

}
