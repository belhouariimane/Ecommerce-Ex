import {Variant} from "./variant";

export class Panier {

  dateCreation :any ;
  dateLivraison : any;
  variant: Variant[];

  constructor(inputs: any) {
    Object.assign(this, inputs);
  }
}
