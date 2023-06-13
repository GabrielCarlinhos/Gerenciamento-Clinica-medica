import { Usuario } from './usuario.model';
import { Especialidade } from './especialidade.model';

export class Doutor {
    nu_crm?: string;
    no_doutor?: string;
    nu_cpf?: string;
    nu_rg?: string;
    nu_telefone?: string;
    nu_cep?: string;
    nu_doutor?: string;
    ds_logradouro?: string;
    ds_bairro?: string;
    ds_cidade?: string;
    co_estado?: string;
    co_especialidade?: number;
    id_usuario?: number;
    usuario?: Usuario;
    especialidade?: Especialidade;
}
