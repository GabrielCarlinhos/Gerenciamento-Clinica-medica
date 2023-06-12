import { Component } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';
import { first } from 'rxjs';
import { Router } from '@angular/router';


@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent {

  constructor(private authService: AuthService,
    private router: Router) { }

  logout() {
    this.authService.logout().pipe(first()).subscribe((response) => {
      this.router.navigate(['/login']);
    })
  }

}

