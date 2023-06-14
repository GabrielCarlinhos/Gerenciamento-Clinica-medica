import { AbstractControl, ValidatorFn, ValidationErrors, FormGroup } from '@angular/forms';

export class PasswordValidator {

  constructor() {

  }

  static passwordMatch(form: FormGroup): ValidatorFn {
    return (control: AbstractControl): ValidationErrors | null => {
      let password = form.get('ds_senha')?.value;
      let confirm = control.value;

      if (password !== confirm) {
        return { 'mismatch': true };
      }
      return null;
    }
  }

  static passwordValidator(): ValidatorFn {
    return (control: AbstractControl): ValidationErrors | null => {
      const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
      if (!passwordRegex.test(control.value)) {
        return { 'invalidPassword': true };
      }
      return null
    }
  }
}
