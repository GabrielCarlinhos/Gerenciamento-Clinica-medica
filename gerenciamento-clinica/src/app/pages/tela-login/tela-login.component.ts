import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { first } from 'rxjs';
import { Usuario } from 'src/app/models/usuario.model';
import { UsuarioService } from 'src/app/services/usuario.service';

@Component({
  selector: 'app-tela-login',
  templateUrl: './tela-login.component.html',
  styleUrls: ['./tela-login.component.scss']
})
export class TelaLoginComponent implements OnInit {

  public form: FormGroup;

  public formErrors: any = {};

  constructor(
    private usuarioService: UsuarioService,
    private formBuilder: FormBuilder,
    private router: Router
  ) {
    this.form = this.formBuilder.group({
      'no_usuario': null,
      'ds_senha': null,
    });
  }

  ngOnInit(): void {

  }

  submit() {
    this.usuarioService.login(this.form?.value).pipe(first()).subscribe(
      response => {
        if (response.success) {
          this.router.navigate(['principal']);
        } else {
          this.formErrors.error = response.mensagem;
        }
      }
    );
  }


}
