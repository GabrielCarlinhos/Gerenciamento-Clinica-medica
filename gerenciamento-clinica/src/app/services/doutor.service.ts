import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Sucesso } from '../shared/sucesso.model';
import { Doutor } from '../models/doutor.model';
import { Constants } from '../shared/constants';

@Injectable({
    providedIn: 'root'
})
export class DoutorService {
    constructor(private http: HttpClient) { }

    create(doutor: Doutor) {
        return this.http.post<Sucesso<Doutor>>(`${Constants.api}/doutorCreate.php`, doutor);
    }
}