import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { TelaLoginComponent } from './pages/tela-login/tela-login.component';
import { IconComponent } from './components/icon/icon.component';
import { UsuarioService } from './services/usuario.service';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { TelaPrincipalComponent } from './pages/tela-principal/tela-principal.component';
import { AuthGuard } from './guards/auth.guard';
import { HeaderComponent } from './components/header/header.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { DoutoresFormComponent } from './pages/doutores/doutores-form/doutores-form.component';
import { MatInputModule } from '@angular/material/input';
import { MatSelectModule } from '@angular/material/select';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';
import { MatDatepickerModule } from '@angular/material/datepicker';
import { MatNativeDateModule } from '@angular/material/core';
import { MatRadioModule } from '@angular/material/radio';
import { MAT_RADIO_DEFAULT_OPTIONS } from '@angular/material/radio';
import { MAT_DATE_LOCALE } from '@angular/material/core';
import { EspecialidadeFormComponent } from './pages/especialidades/especialidade-form/especialidade-form.component';
import { CurrencyMaskModule } from 'ng2-currency-mask';
import { IConfig, NgxMaskModule } from 'ngx-mask';
import { PacienteFormComponent } from './pages/pacientes/paciente-form/paciente-form.component';
import { ConvenioFormComponent } from './pages/convenios/convenio-form/convenio-form.component';
import { NgbModalModule } from '@ng-bootstrap/ng-bootstrap';
import { AcompanhanteFormComponent } from './pages/pacientes/acompanhantes/acompanhante-form/acompanhante-form.component';
import { UsuarioFormComponent } from './pages/usuarios/usuario-form/usuario-form.component';
import { EspecialidadesPrincipalComponent } from './pages/especialidades/especialidades-principal/especialidades-principal.component';
import { PacientesPrincipalComponent } from './pages/pacientes/pacientes-principal/pacientes-principal.component';
import { DoutoresPrincipalComponent } from './pages/doutores/doutores-principal/doutores-principal.component';
import { ConveniosPrincipalComponent } from './pages/convenios/convenios-principal/convenios-principal.component';
import { ToastrModule } from 'ngx-toastr';

export const options: Partial<null | IConfig> | (() => Partial<IConfig>) = null;


@NgModule({
  declarations: [
    AppComponent,
    TelaLoginComponent,
    IconComponent,
    TelaPrincipalComponent,
    HeaderComponent,
    DoutoresFormComponent,
    EspecialidadeFormComponent,
    PacienteFormComponent,
    ConvenioFormComponent,
    AcompanhanteFormComponent,
    UsuarioFormComponent,
    EspecialidadesPrincipalComponent,
    PacientesPrincipalComponent,
    DoutoresPrincipalComponent,
    ConveniosPrincipalComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    NgbModule,
    BrowserAnimationsModule,
    MatInputModule,
    MatSelectModule,
    MatFormFieldModule,
    MatButtonModule,
    MatIconModule,
    CurrencyMaskModule,
    MatDatepickerModule,
    MatNativeDateModule,
    MatRadioModule,
    NgbModalModule,
    NgxMaskModule.forRoot(),
    ToastrModule.forRoot(),
  ],
  exports: [
    IconComponent,
  ],
  providers: [
    { provide: MAT_RADIO_DEFAULT_OPTIONS, useValue: { color: 'accent' } },
    UsuarioService,
    AuthGuard,
    { provide: MAT_DATE_LOCALE, useValue: 'pt-BR' }
  ],
  bootstrap: [AppComponent],
})
export class AppModule { }
