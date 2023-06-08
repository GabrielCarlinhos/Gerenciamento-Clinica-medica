import { Paciente } from './paciente.model';
import { Doutor } from './doutor.model';

export class Consulta {
    co_consulta?: number;
    dt_consulta?: Date;
    vl_consulta?: number;
    ds_convenio?: string;
    id_paciente?: number;
    nu_crm_doutor?: number;
    paciente?: Paciente;
    doutor?: Doutor;
}
