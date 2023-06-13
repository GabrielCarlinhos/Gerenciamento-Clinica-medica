import { CurrencyMaskConfig } from "ng2-currency-mask/public-api";

export class Constants {
  static genericRequired = "* Campo obrigatório";
  static api: string = 'http://localhost/gerenciamento-clinica-medica/Api/Controllers';
  static options = { withCredentials: true };
  static success = '#198754';
  static info = '#0dcaf0';
  static currencyMaskConfig: CurrencyMaskConfig = {
    align: "left",
    allowNegative: false,
    decimal: ",",
    precision: 2,
    prefix: "R$ ",
    suffix: "",
    thousands: "."
  };
  static onlyNumbers(value: string): string {
    return value.replace(/\D/g, '');
  }
}
