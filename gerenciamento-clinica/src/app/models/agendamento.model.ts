import { Paciente } from './paciente.model';
import { Doutor } from './doutor.model';

export class Agendamento {
    co_agendamento?: number;
    dt_agendamento?: Date;
    id_paciente?: number;
    nu_crm_doutor?: number;
    in_cancelado?: boolean;
    ds_motivo_cancelamento?: string;
    paciente?: Paciente;
    doutor?: Doutor;
}
