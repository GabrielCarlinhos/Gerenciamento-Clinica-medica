import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { first } from 'rxjs';
import { AgendamentoDto } from 'src/app/dto/agendamento.dto';
import { AgendamentoService } from 'src/app/services/agendamento.service';
import { AgendamentoModalComponent } from '../agendamento-modal/agendamento-modal.component';
import { Agendamento } from 'src/app/models/agendamento.model';
import Swal from 'sweetalert2';
import { Constants } from 'src/app/shared/constants';
import { ToastrService } from 'ngx-toastr';
import { ConsultaModalComponent } from '../../consultas/consulta-modal/consulta-modal.component';
import { Especialidade } from 'src/app/models/especialidade.model';

@Component({
  selector: 'app-agendamento-principal',
  templateUrl: './agendamento-principal.component.html',
  styleUrls: ['./agendamento-principal.component.scss']
})
export class AgendamentoPrincipalComponent implements OnInit {

  panelOpenState = false;

  public agendas?: AgendamentoDto[] = [];

  constructor(private agendamentoService: AgendamentoService,
    private modal: NgbModal,
    private toastr: ToastrService,
  ) {

  }

  ngOnInit(): void {
    this.loadAgendas();
  }

  loadAgendas() {
    this.agendamentoService.agendamento().pipe(first()).subscribe((response) => {
      if (response.success) {
        this.agendas = response.data;
        console.log(this.agendas);
      }
    })
  }

  openModalAgendamento(crm: string) {
    const modalAgendamento = this.modal.open(AgendamentoModalComponent, { size: 'md' });
    modalAgendamento.componentInstance.nu_crm_doutor = crm;
    modalAgendamento.componentInstance.setAgenda.subscribe((value: any) => {
      this.loadAgendas();
    })
  }

  openModalAgendamentoUpdate(agenda: Agendamento) {
    const modalAgendamento = this.modal.open(AgendamentoModalComponent, { size: 'md' });
    modalAgendamento.componentInstance.agendamento = agenda;
    modalAgendamento.componentInstance.setAgenda.subscribe((value: any) => {
      this.loadAgendas();
    })
  }

  delete(id: number, agendas: Agendamento[]) {
    Swal.fire({
      icon: 'warning',
      title: 'Deseja cancelar a consulta?',
      text: 'Motivo do Cancelamento',
      input: 'textarea',
      confirmButtonText: 'Cancelar',
      showCancelButton: true,
      cancelButtonText: 'Voltar',
      cancelButtonColor: Constants.danger,
    }).then((response) => {
      if (response.isConfirmed) {
        this.agendamentoService.delete(id, response.value).pipe(first()).subscribe((response) => {
          let index = this.agendas?.findIndex((value: AgendamentoDto) => {
            return value.co_agendamento == id;
          })
          agendas.splice(index!, 1);
        })
      }
    })
  }

  openModalConsulta(agenda: Agendamento, especialidade: Especialidade) {
    const modalConsulta = this.modal.open(ConsultaModalComponent, { size: 'lg', container: 'body' });
    modalConsulta.componentInstance.agenda = agenda;
    modalConsulta.componentInstance.especialidade = especialidade;
  }

}
