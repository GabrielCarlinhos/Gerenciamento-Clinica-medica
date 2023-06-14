import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TelaLoginComponent } from './pages/tela-login/tela-login.component';
import { TelaPrincipalComponent } from './pages/tela-principal/tela-principal.component';
import { AuthGuard } from './guards/auth.guard';
import { DoutoresFormComponent } from './pages/doutores/doutores-form/doutores-form.component';
import { EspecialidadeFormComponent } from './pages/especialidades/especialidade-form/especialidade-form.component';
import { PacienteFormComponent } from './pages/pacientes/paciente-form/paciente-form.component';
import { ConvenioFormComponent } from './pages/convenios/convenio-form/convenio-form.component';
import { UsuarioFormComponent } from './pages/usuarios/usuario-form/usuario-form.component';
import { EspecialidadesPrincipalComponent } from './pages/especialidades/especialidades-principal/especialidades-principal.component';
import { DoutoresPrincipalComponent } from './pages/doutores/doutores-principal/doutores-principal.component';
import { ConveniosPrincipalComponent } from './pages/convenios/convenios-principal/convenios-principal.component';
import { PacientesPrincipalComponent } from './pages/pacientes/pacientes-principal/pacientes-principal.component';

const routes: Routes = [
  { path: '', redirectTo: 'login', pathMatch: 'full' },
  { path: 'login', component: TelaLoginComponent },
  { path: 'principal', component: TelaPrincipalComponent, canActivate: [AuthGuard] },
  { path: 'especialidade', component: EspecialidadesPrincipalComponent, canActivate: [AuthGuard] },
  { path: 'doutor', component: DoutoresPrincipalComponent, canActivate: [AuthGuard] },
  { path: 'convenio', component: ConveniosPrincipalComponent, canActivate: [AuthGuard] },
  { path: 'paciente', component: PacientesPrincipalComponent, canActivate: [AuthGuard] },
  { path: 'doutor/form', component: DoutoresFormComponent, canActivate: [AuthGuard] },
  { path: 'paciente/form/:id', component: PacienteFormComponent, canActivate: [AuthGuard] },
  { path: 'usuario/form', component: UsuarioFormComponent, canActivate: [AuthGuard] },
  { path: 'convenio/form', component: ConvenioFormComponent, canActivate: [AuthGuard] },
  { path: '**', redirectTo: 'login' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
