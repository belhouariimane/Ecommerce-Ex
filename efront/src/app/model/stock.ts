import {Variant} from "./variant";

export class Stock {

  quantiteDisponible :any ;
  taille : any;
  variant! : Variant[];

  constructor(inputs: any) {
    Object.assign(this, inputs);
  }
}
