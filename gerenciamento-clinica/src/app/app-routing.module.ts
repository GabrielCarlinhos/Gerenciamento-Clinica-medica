import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TelaLoginComponent } from './pages/tela-login/tela-login.component';
import { TelaPrincipalComponent } from './pages/tela-principal/tela-principal.component';
import { AuthGuard } from './guards/auth.guard';

const routes: Routes = [
  { path: '', redirectTo: 'login', pathMatch: 'full' },
  { path: 'login', component: TelaLoginComponent },
  { path: 'principal', component: TelaPrincipalComponent, canActivate: [AuthGuard] },
  { path: '**', redirectTo: 'login' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
