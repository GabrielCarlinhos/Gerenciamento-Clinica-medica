import { Paciente } from './paciente.model';

export class Acompanhante {
    id_acompanhante?: number;
    no_acompanhante?: string;
    nu_cpf?: string;
    nu_rg?: string;
    nu_telefone?: string;
    id_paciente?: number;
    ds_email?: string;
    paciente?: Paciente;
}
