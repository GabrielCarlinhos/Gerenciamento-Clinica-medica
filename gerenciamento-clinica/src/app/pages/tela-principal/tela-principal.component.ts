import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';
import { first } from 'rxjs';
import { Router } from '@angular/router';

@Component({
  selector: 'app-tela-principal',
  templateUrl: './tela-principal.component.html',
  styleUrls: ['./tela-principal.component.scss']
})
export class TelaPrincipalComponent implements OnInit {

  constructor(private authService: AuthService,
    private router: Router) { }

  ngOnInit(): void {
  }
  logout() {
    this.authService.logout().pipe(first()).subscribe((response) => {
      this.router.navigate(['/login']);
    })
  }

}
