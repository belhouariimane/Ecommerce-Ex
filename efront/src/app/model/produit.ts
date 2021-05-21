import {Variant} from "./variant";

export class Produit {
  id: number;
  name: string | undefined;
  type : string | undefined ;
  reference: string | undefined;
  marque: string | undefined ;
  genre: string | undefined;
  categorie: string| undefined;
  variants: Variant[] | undefined;
  constructor(inputs: any) {
    Object.assign(this, inputs);
  }
}
