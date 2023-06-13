import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TelaLoginComponent } from './pages/tela-login/tela-login.component';
import { TelaPrincipalComponent } from './pages/tela-principal/tela-principal.component';
import { AuthGuard } from './guards/auth.guard';
import { DoutoresFormComponent } from './pages/doutores/doutores-form/doutores-form.component';
import { EspecialidadeFormComponent } from './pages/especialidades/especialidade-form/especialidade-form.component';
import { PacienteFormComponent } from './pages/pacientes/paciente-form/paciente-form.component';

const routes: Routes = [
  { path: '', redirectTo: 'login', pathMatch: 'full' },
  { path: 'login', component: TelaLoginComponent },
  { path: 'principal', component: TelaPrincipalComponent, canActivate: [AuthGuard] },
  { path: 'doutor/form', component: DoutoresFormComponent, canActivate: [AuthGuard] },
  { path: 'especialidade/form', component: EspecialidadeFormComponent, canActivate: [AuthGuard] },
  { path: 'paciente/form', component: PacienteFormComponent, canActivate: [AuthGuard] },
  { path: '**', redirectTo: 'login' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
