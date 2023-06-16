import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ConsultaService } from 'src/app/services/consulta.service';
import { first } from 'rxjs';
import { Consulta } from 'src/app/models/consulta.model';
import { ProntuarioModalComponent } from '../prontuario-modal/prontuario-modal.component';

@Component({
  selector: 'app-consultas-principal',
  templateUrl: './consultas-principal.component.html',
  styleUrls: ['./consultas-principal.component.scss']
})
export class ConsultasPrincipalComponent implements OnInit {

  public consultas?: Consulta[];

  constructor(private consultaService: ConsultaService,
    private modal: NgbModal) { }
  ngOnInit(): void {
    this.loadConsultas();

  }

  loadConsultas() {
    this.consultaService.findAll().pipe(first()).subscribe((response) => {
      if (response.success) {
        this.consultas = response.data;
      }
    })
  }

  openModalProntuario(co_consulta?: number, no_paciente?: string) {
    const modalProntuario = this.modal.open(ProntuarioModalComponent, { size: 'xl' });
    modalProntuario.componentInstance.co_consulta = co_consulta;
    modalProntuario.componentInstance.no_paciente = no_paciente;
  }

}
