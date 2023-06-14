import { Convenio } from './convenio.model';
import { Acompanhante } from './acompanhante.model';
import { Prontuario } from './prontuario.model';

export class Paciente {
    id_paciente!: number;
    no_paciente?: string;
    nu_cpf?: string;
    nu_telefone?: string;
    ds_email?: string;
    ds_genero?: string;
    ds_logradouro?: string;
    nu_paciente?: string;
    ds_bairro?: string;
    ds_cidade?: string;
    co_estado?: string;
    nu_cep?: string;
    dt_nascimento?: Date;
    in_ativo?: boolean;
    no_mae?: string;
    nu_rg?: string;
    id_convenio?: number;
    convenio!: Convenio;
    acompanhante?: Acompanhante;
    prontuario?: Prontuario;
}
