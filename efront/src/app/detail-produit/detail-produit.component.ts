import {Component, ElementRef, Inject, OnInit, Optional, ViewChild} from '@angular/core';
import {MAT_DIALOG_DATA, MatDialogRef} from "@angular/material/dialog";
import {Produit} from "../model/produit";
import {ProduitService} from "../service/produit.service";
import {VariantService} from "../service/variant.service";
import {Variant} from "../model/variant";
import {CouleurService} from "../service/couleur.service";
import {Couleur} from "../model/couleur";
import {fromEvent} from "rxjs";
import {debounceTime, distinctUntilChanged, filter, tap} from "rxjs/operators";
import {StockService} from "../service/stock.service";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {PanierService} from "../service/panier.service";
import {MatSnackBar} from "@angular/material/snack-bar";

@Component({
  selector: 'app-detail-produit',
  templateUrl: './detail-produit.component.html',
  styleUrls: ['./detail-produit.component.scss']
})
export class DetailProduitComponent implements OnInit {

  public formPanier: FormGroup;

  public variant : Variant ;

  public couleur : Couleur ;
  public produit;

  public prePanierObject;
  constructor(
    public dialogRef: MatDialogRef<DetailProduitComponent>,
    //@Optional() is used to prevent error if no data is passed
    @Optional() @Inject(MAT_DIALOG_DATA) public data: Produit,
    private variantService:VariantService ,
    private couleurService:CouleurService,
    private stockService: StockService,
    private panierService: PanierService,
    private snackBar: MatSnackBar,
    private fb:FormBuilder)
  {
    this.produit = data;
    this.variantService.getVariantById(data['id']).subscribe(
      (rsp)=> {
        this.variant=rsp;
      },
      (error => {}),
      ()=> this.couleurService.getCouleurById(this.variant.couleur)
        .subscribe((rslt)=> this.couleur=rslt)
    );

  }
  openSnackBar(message: string): void {
    this.snackBar.open(message, 'Fermer', {
      duration: 2000,
    });
  }

  doAction(){
    if(this.formPanier.valid){
      const params= {
        taille : this.formPanier.get('taille').value ?? null ,
        variant : this.variant['@id'] ?? null
      };
      this.stockService.getDisponibilite(params).subscribe(
        stock=>{
            if(stock['hydra:totalItems']!== 0 && stock['hydra:member'][0]['quantiteDisponible'] > 0){
              this.prePanierObject = {'variant':this.variant,'stock':stock['hydra:member'][0]};
              this.dialogRef.close({event:'ajouter',data:this.prePanierObject});
            //this.panierService.postVariant(this.variant,stock).subscribe();
            }
            else{
              this.openSnackBar('Cet article est en repture de stock');
              // @ts-ignore
              this.formPanier.get('taille').setValidators(Validators.required);
              // @ts-ignore
              this.formPanier.get('taille').updateValueAndValidity();
            }},
          error => (console.log(error)));
    }


  }

  closeDialog(){
    this.dialogRef.close({event:'Cancel'});
  }

  ngOnInit(): void {
    this.formPanier = this.fb.group({
      taille : ['',Validators.required]
    });
  }


}
