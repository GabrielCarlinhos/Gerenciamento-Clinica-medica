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

@NgModule({
  declarations: [
    AppComponent,
    TelaLoginComponent,
    IconComponent,
    TelaPrincipalComponent,
    HeaderComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    NgbModule,
  ],
  exports: [
    IconComponent,
  ],
  providers: [
    UsuarioService,
    AuthGuard,
  ],
  bootstrap: [AppComponent],
})
export class AppModule { }
