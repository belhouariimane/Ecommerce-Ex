import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {Stock} from "../model/stock";
import {environment} from "../../environments/environment";
import {HttpUtil} from "../utils/http.util";
import {map} from "rxjs/operators";

@Injectable({
  providedIn: 'root'
})
export class PanierService {

  constructor(private http: HttpClient) { }

  // @ts-ignore
  postVariant(data): Observable<any>{
    return this.http.post<any>(`${environment.url}/ajout`,data);
  }
}
