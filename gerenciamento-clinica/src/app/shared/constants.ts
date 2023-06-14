import { CurrencyMaskConfig } from "ng2-currency-mask/public-api";

export class Constants {
  static genericRequired = "* Campo obrigatório";
  static api: string = 'http://localhost/gerenciamento-clinica-medica/Api/Controllers';
  static options = { withCredentials: true };
  static success = '#198754';
  static info = '#0dcaf0';
  static primary = '#0d6efd';
  static danger = '#dc3545';
  static currencyMaskConfig: CurrencyMaskConfig = {
    align: "left",
    allowNegative: false,
    decimal: ",",
    precision: 2,
    prefix: "R$ ",
    suffix: "",
    thousands: "."
  };
  static toastOptions = { positionClass: 'toast-top-center', closeButton: true };
  static onlyNumbers(value: string): string {
    return value.replace(/\D/g, '');
  }
}
