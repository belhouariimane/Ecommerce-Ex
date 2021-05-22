import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {Stock} from "../model/stock";
import {environment} from "../../environments/environment";
import {map} from "rxjs/operators";
import {Variant} from "../model/variant";
import {HttpUtil} from "../utils/http.util";

@Injectable({
  providedIn: 'root'
})
export class StockService {

  constructor(private http: HttpClient) { }

  getDisponibilite(params: { taille: any; variant: any; }): Observable<any>{
    // @ts-ignore
    return this.http.get<any>(`${environment.apiUrl}/stocks`, {params: HttpUtil.convertObjectToHttpParams(params)})
      .pipe(map((data: any) => {
        return data;
      }));
  }
  getStock(): Observable<Stock []>{
    return this.http.get<Stock []>(`${environment.apiUrl}/stocks`)
      .pipe(map((data: Stock[]) =>{
        // @ts-ignore
        return data['hydra:member'].map( (s: Stock) => {
          if (s){
            return new Stock(s);
          }});
      }));
  }
}
