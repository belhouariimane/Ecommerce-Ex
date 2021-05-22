import {Component, ElementRef, Inject, OnInit, Optional, ViewChild} from '@angular/core';
import {MAT_DIALOG_DATA, MatDialogRef} from "@angular/material/dialog";
import {Produit} from "../../model/produit";
import {ProduitService} from "../../service/produit.service";
import {VariantService} from "../../service/variant.service";
import {Variant} from "../../model/variant";
import {CouleurService} from "../../service/couleur.service";
import {Couleur} from "../../model/couleur";
import {fromEvent} from "rxjs";
import {debounceTime, distinctUntilChanged, filter, tap} from "rxjs/operators";
import {StockService} from "../../service/stock.service";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {PanierService} from "../../service/panier.service";
import {MatSnackBar} from "@angular/material/snack-bar";
import { SwiperOptions } from 'swiper';
import {SwiperComponent, SwiperConfigInterface, SwiperDirective} from "ngx-swiper-wrapper";

@Component({
  selector: 'app-detail-produit',
  templateUrl: './detail-produit.component.html',
  styleUrls: ['./detail-produit.component.scss']
})
export class DetailProduitComponent implements OnInit {

  public formPanier: FormGroup;
  public produit;
  public prePanierObject;
  public show: boolean = true;
  public disabled: boolean = false;
  public config: SwiperConfigInterface = {
    slidesPerView: 'auto',
    keyboard: true,
    mousewheel: true,
    scrollbar: false,
    navigation: true,
    pagination: false
  };

  @ViewChild(SwiperComponent, { static: false }) componentRef?: SwiperComponent;
  @ViewChild(SwiperDirective, { static: false }) directiveRef?: SwiperDirective;
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
  }
  openSnackBar(message: string): void {
    this.snackBar.open(message, 'Fermer', {
      duration: 2000,
    });
  }
  // Check if is available and add it to shop card
  doAction(variant:Variant,produit:Produit){
    if(this.formPanier.valid){
      const params= {
        taille : this.formPanier.get('taille').value ?? null ,
        variant : variant['@id'] ?? null
      };
      const qte = this.formPanier.get('qte').value;
      // check
      this.stockService.getDisponibilite(params).subscribe(
        stock=>{
            if(stock['hydra:totalItems']!== 0 &&
              (stock['hydra:member'][0]['quantiteDisponible'] > qte)){
              //prepare the object to add shop card
              this.prePanierObject = {
                'variant':variant,
                'stock':stock['hydra:member'][0],
                'qte':qte,
                'produit':this.produit
              };
              //send it to card shop
              this.dialogRef.close({event:'ajouter',data:this.prePanierObject});
            }
            else{
              // show message error
              this.openSnackBar('Cet article est en repture de stock');
              // clear control validation
              // @ts-ignore
              this.formPanier.get('taille').setValidators(Validators.required);
              // @ts-ignore
              this.formPanier.get('taille').updateValueAndValidity();
              // @ts-ignore
              this.formPanier.get('qte').setValidators(Validators.required);
              // @ts-ignore
              this.formPanier.get('qte').updateValueAndValidity();
            }},
          error => (console.log(error)));
    }


  }

  closeDialog(){
    this.dialogRef.close({event:'Cancel'});
  }

  ngOnInit(): void {
    this.formPanier = this.fb.group({
      taille : ['',Validators.required],
      qte: ['',Validators.required]
    });
  }

  // swiper
  public toggleSlidesPerView(): void {
    if (this.config.slidesPerView !== 1) {
      this.config.slidesPerView = 1;
    } else {
      this.config.slidesPerView = 2;
    }
  }

  public onIndexChange(index: number): void {
    //console.log('Swiper index: ', index);
  }

  public onSwiperEvent(event: string): void {
   // console.log('Swiper event: ', event);
  }

}
