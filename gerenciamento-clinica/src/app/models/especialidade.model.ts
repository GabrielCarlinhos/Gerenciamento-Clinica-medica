import { Doutor } from "./doutor.model";

export class Especialidade {
  co_especialidade!: number;
  ds_especialidade!: string;
  vl_consulta!: number;
  doutores!: Doutor[];
}
