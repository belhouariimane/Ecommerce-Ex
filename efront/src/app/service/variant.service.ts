import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {Variant} from "../model/variant";
import {environment} from "../../environments/environment";
import {map} from "rxjs/operators";
import {Produit} from "../model/produit";
import {variable} from "@angular/compiler/src/output/output_ast";

@Injectable({
  providedIn: 'root'
})
export class VariantService {

  constructor(private http: HttpClient) { }

  getVariantById(id:number): Observable<Variant >{
    return this.http.get<Variant>(`${environment.apiUrl}/variants/${id}`)
      .pipe(map((data: Variant) =>{
        return new Variant(data);
      }));
  }
  getAllVariant(): Observable<Variant []>{
    return this.http.get<Variant []>(`${environment.apiUrl}/variants`)
      .pipe(map((data: Variant[]) =>{
        // @ts-ignore
        return data['hydra:member'].map( (v: Variant) => {
          if (v){
            return new Variant(v);
          }});
      }));
  }
}
