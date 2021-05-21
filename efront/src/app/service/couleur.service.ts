import { Injectable } from '@angular/core';
import {Observable} from "rxjs";
import {Variant} from "../model/variant";
import {environment} from "../../environments/environment";
import {map} from "rxjs/operators";
import {HttpClient} from "@angular/common/http";
import {Couleur} from "../model/couleur";

@Injectable({
  providedIn: 'root'
})
export class CouleurService {

  constructor(private http: HttpClient) { }

  getCouleurById(id:any): Observable<Couleur >{
    return this.http.get<Couleur>(`${environment.url}${id}`)
      .pipe(map((data: Couleur) =>{
        return new Couleur(data);
      }));
  }
}
