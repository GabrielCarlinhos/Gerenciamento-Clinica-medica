import { AbstractControl, ValidationErrors, ValidatorFn } from "@angular/forms";

export class timeValidator {
  isLeapYear(year: number): boolean {
    return (year % 4 === 0 && year % 100 !== 0) || year % 400 === 0;
  }

  isValidDate(day: number, month: number, year: number): boolean {
    if (month < 1 || month > 12 || year < 0) {
      return false;
    }

    const maxDays = [31, this.isLeapYear(year) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
    return day >= 1 && day <= maxDays[month - 1];
  }

  static hourMinute(): ValidatorFn {
    return (control: AbstractControl): ValidationErrors | null => {
      const value = control.value;
      if (value == null) {
        return null;
      }

      const char1 = value.substr(0, 1);
      const char2 = value.substr(1, 1);
      const char3 = value.substr(2, 1);

      if (char1 > '2') {
        return { 'invalidTime': true };
      }
      if (char1 === '2' && char2 > '3') {
        return { 'invalidTime': true };
      }
      if (char3 > '5') {
        return { 'invalidTime': true };
      }
      return null;
    };
  }

  static date(): ValidatorFn {
    const validator = new timeValidator();

    return (control: AbstractControl): ValidationErrors | null => {
      const value = control.value;
      if (value == null) {
        return null;
      }

      if (value.length !== 8) {
        return { invalidDate: true };
      }

      const day = Number(value.substr(0, 2));
      const month = Number(value.substr(2, 2));
      const year = Number(value.substr(4, 4));

      if (!validator.isValidDate(day, month, year)) {
        return { invalidDate: true };
      }

      return null;
    };
  }

  static lessThanToday(): ValidatorFn {
    const validator = new timeValidator();

    return (control: AbstractControl): ValidationErrors | null => {

      const value = control.value;

      if (value == null) {
        return null;
      }

      if (value.length !== 8) {
        return { invalidFormat: true };
      }

      const day = Number(value.substr(0, 2));
      const month = Number(value.substr(2, 2));
      const year = Number(value.substr(4, 4));

      if (!validator.isValidDate(day, month, year)) {
        return { invalidDate: true };
      }

      const today = new Date();
      const inputDate = new Date(year, month - 1, day);

      if (inputDate > today) {
        return { futureDate: true };
      }

      return null;
    };
  }

  static invertValidator(validator: ValidatorFn): ValidatorFn {
    return (control: AbstractControl): ValidationErrors | null => {
      const validationResult = validator(control);

      if (validationResult === null) {
        return { inverted: true };
      }

      return null;
    };
  }
}
