import { Component, OnInit } from '@angular/core';
import { EspecialidadeService } from 'src/app/services/especialidade.service';
import { first, take } from 'rxjs';
import { Especialidade } from 'src/app/models/especialidade.model';
import { ToastrService } from 'ngx-toastr';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { Constants } from 'src/app/shared/constants';
import Swal from 'sweetalert2';
import { EspecialidadeFormComponent } from '../especialidade-form/especialidade-form.component';
import { Sucesso } from 'src/app/shared/sucesso.model';

@Component({
  selector: 'app-especialidades-principal',
  templateUrl: './especialidades-principal.component.html',
  styleUrls: ['./especialidades-principal.component.scss']
})
export class EspecialidadesPrincipalComponent implements OnInit {

  public especialidades: Especialidade[] | undefined = [];

  constructor(private especialidadeService: EspecialidadeService,
    private toastr: ToastrService,
    private modal: NgbModal) {

  }

  ngOnInit(): void {
    this.loadEspecialidades();
  }

  loadEspecialidades() {
    this.especialidadeService.findAll().pipe(first()).subscribe((response) => {
      if (response.success) {
        this.especialidades = response.data;
      }
    })
  }

  update(especialidade: Especialidade) {
    const modalEspecialidade = this.modal.open(EspecialidadeFormComponent, { size: 'md' });
    modalEspecialidade.componentInstance.especialidade = especialidade;
    modalEspecialidade.componentInstance.setEspecialidade.subscribe(() => {
      this.loadEspecialidades();
    })
  }

  delete(id: number) {
    Swal.fire({
      icon: 'warning',
      text: 'Deseja Remover a Especialidade?',
      confirmButtonText: "Remover",
      cancelButtonText: "Cancelar",
      cancelButtonColor: Constants.danger,
      showCancelButton: true,
    }).then((response) => {
      if (response.isConfirmed) {
        this.especialidadeService.delete(id).pipe(first(), take(1)).subscribe((response) => {
          if (response.success) {
            this.toastr.success(response.mensagem, 'Sucesso!', Constants.toastOptions);
            this.loadEspecialidades();
          } else {
            this.toastr.error(response.mensagem, "Erro", Constants.toastOptions);
          }
        })
      }
    });

  }

}
