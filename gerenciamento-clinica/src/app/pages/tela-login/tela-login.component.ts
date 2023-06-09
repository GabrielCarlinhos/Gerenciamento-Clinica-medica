import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
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

  constructor(
    private usuarioService: UsuarioService,
    private formBuilder: FormBuilder
  ) {
    this.form = this.formBuilder.group({
      'no_usuario': null,
      'ds_senha': null,
    });
  }

  ngOnInit(): void {

  }

  submit() {
    this.usuarioService.login(this.form?.value).pipe(first()).subscribe({
      next: response => {
        alert('aaa');
      },
      error: () => {
        alert('vasco');
      }
    })
  }

}
