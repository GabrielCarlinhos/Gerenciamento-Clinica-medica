import { HttpClient } from "@angular/common/http";
import { Injectable } from "@angular/core";
import { Constants } from "../shared/constants";

@Injectable({
    providedIn: 'root'
})
export class AuthService {



    constructor(private http: HttpClient){

    }

    guard(){
        return this.http.post<any>(`${Constants.api}/checkLogin.php`,{}, Constants.options);
    }

}