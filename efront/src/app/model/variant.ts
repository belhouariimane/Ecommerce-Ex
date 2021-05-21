import {Couleur} from "./couleur";
import {Produit} from "./produit";

export class Variant {

  prixVente : number;
  tailles: number[];
  couleur: Couleur;
  produit: Produit;
  constructor(inputs: any) {
    Object.assign(this, inputs);
  }
}
