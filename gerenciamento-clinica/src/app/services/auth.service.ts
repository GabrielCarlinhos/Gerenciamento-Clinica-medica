import { HttpClient } from "@angular/common/http";
import { Injectable } from "@angular/core";
import { Constants } from "../shared/constants";

@Injectable({
    providedIn: 'root'
})
export class AuthService {

    private path:string = Constants.api;
    private options = { withCredentials: true };

    constructor(private http: HttpClient){

    }

    guard(){
        return this.http.post<any>(`${this.path}/check-login.php`,{}, this.options);
    }

}