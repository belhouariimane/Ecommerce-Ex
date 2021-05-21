import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {Produit} from "../model/produit";
import {environment} from "../../environments/environment";
import {map} from "rxjs/operators";

@Injectable({
  providedIn: 'root'
})
export class ProduitService {

  constructor(private http: HttpClient) { }

  getAll(): Observable<Produit []>{
    return this.http.get<Produit []>(`${environment.apiUrl}/produits`)
      .pipe(map((data: Produit[]) =>{
        // @ts-ignore
        return data['hydra:member'].map( (produit: Produit) => {
        if (produit){
          return new Produit(produit);
        }});
  }));
  }
}
