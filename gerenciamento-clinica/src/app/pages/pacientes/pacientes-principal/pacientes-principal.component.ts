import { Component, OnInit } from '@angular/core';
import { first, take } from 'rxjs';
import { Paciente } from 'src/app/models/paciente.model';
import { PacienteService } from 'src/app/services/paciente.service';
import { Constants } from 'src/app/shared/constants';
import { ToastrService } from 'ngx-toastr';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-pacientes-principal',
  templateUrl: './pacientes-principal.component.html',
  styleUrls: ['./pacientes-principal.component.scss']
})
export class PacientesPrincipalComponent implements OnInit {

  public pacientes?: Paciente[] = [];

  constructor(private pacienteService: PacienteService,
    private toastr: ToastrService) {

  }

  ngOnInit(): void {
    this.loadPacientes();
  }

  loadPacientes() {
    this.pacienteService.findAll().pipe(first()).subscribe((response) => {
      if (response.success) {
        this.pacientes = response.data;
      }
    })
  }

  delete(id?: number) {
    Swal.fire({
      'icon': "warning",
      "text": "Deseja Remover Esse Paciente?",
      'showCancelButton': true,
      'cancelButtonColor': Constants.danger,
      'confirmButtonText': 'Remover',
      'cancelButtonText': 'Cancelar',
    }).then((response) => {
      if (response.isConfirmed) {
        this.pacienteService.delete(id).pipe(first(), take(1)).subscribe((response) => {
          if (response.success) {
            this.loadPacientes();
            this.toastr.success(response.mensagem, "Sucesso!", Constants.toastOptions);
          }
        })
      }
    })
  }

  update(paciente: Paciente) {

  }

}
