export class Couleur {

  libelle!: string;
  code!: number;

  constructor(inputs: any) {
    Object.assign(this, inputs);
  }
}
