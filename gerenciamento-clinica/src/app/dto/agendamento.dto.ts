export class AgendamentoDto {
  co_especialidade!: number;
  ds_especialidade!: string;
  vl_consulta!: number;
  no_doutor!: string;
  co_agendamento!: number;
  dt_agendamento!: Date;
  agendamento_id_paciente!: number;
  in_cancelado!: boolean;
  ds_motivo_cancelamento!: string;
  id_paciente!: number;
  no_paciente!: string;
  id_convenio!: number;
}
