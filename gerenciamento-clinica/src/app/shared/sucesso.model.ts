export class Sucesso<T> {
  success?: boolean;
  mensagem?: string;
  data!: T;
}
export class SucessoLista<T> {
  success?: boolean;
  mensagem?: string;
  data?: T[];
}
