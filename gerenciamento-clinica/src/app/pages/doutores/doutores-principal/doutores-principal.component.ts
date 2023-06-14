import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { first, take } from 'rxjs';
import { Doutor } from 'src/app/models/doutor.model';
import { DoutorService } from 'src/app/services/doutor.service';
import { Constants } from 'src/app/shared/constants';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-doutores-principal',
  templateUrl: './doutores-principal.component.html',
  styleUrls: ['./doutores-principal.component.scss']
})
export class DoutoresPrincipalComponent implements OnInit {

  public doutores?: Doutor[] = [];

  constructor(private doutorService: DoutorService,
    public router: Router,
    private toastr: ToastrService,
  ) {

  }

  ngOnInit(): void {
    this.loadDoutores();
  }

  loadDoutores() {
    this.doutorService.findAll().pipe(first()).subscribe((response) => {
      if (response.success) {
        this.doutores = response.data;
      }
    })
  }

  delete(crm: string) {
    Swal.fire({
      'icon': "warning",
      "text": "Deseja Remover Esse Doutor?",
      'showCancelButton': true,
      'cancelButtonColor': Constants.danger,
      'confirmButtonText': 'Remover',
      'cancelButtonText': 'Cancelar',
    }).then((response) => {
      if (response.isConfirmed) {
        this.doutorService.delete(crm).pipe(first(), take(1)).subscribe((response) => {
          if (response.success) {
            this.loadDoutores();
            this.toastr.success(response.mensagem, "Sucesso!", Constants.toastOptions);
          }
        })
      }
    })
  }
}
