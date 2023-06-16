import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'dateFormat'
})
export class DateFormatPipe implements PipeTransform {
  transform(value: string): string {
    if (!value || value.length !== 8) {
      return value;
    }

    const day = value.substr(0, 2);
    const month = value.substr(2, 2);
    const year = value.substr(4, 4);

    return `${day}/${month}/${year}`;
  }
}
