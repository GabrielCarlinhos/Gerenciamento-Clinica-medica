import { Paciente } from './paciente.model';
import { Doutor } from './doutor.model';

export class Prontuario {
    id_prontuario?: number;
    nu_peso?: number;
    nu_altura?: number;
    nu_imc?: number;
    ds_exame_fisico?: string;
    ds_solicitacao_exame?: string;
    tp_sanguineo?: string;
    ds_alergias?: string;
    id_paciente?: number;
    nu_crm_doutor?: number;
    paciente?: Paciente;
    doutor?: Doutor;
}
