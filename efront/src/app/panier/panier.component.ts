import {Component, Inject, Input, OnInit, Optional} from '@angular/core';
import {MAT_DIALOG_DATA, MatDialogRef} from "@angular/material/dialog";
import {Produit} from "../model/produit";
import {PanierService} from "../service/panier.service";

@Component({
  selector: 'app-panier',
  templateUrl: './panier.component.html',
  styleUrls: ['./panier.component.scss']
})
export class PanierComponent implements OnInit {

  displayedColumns: string[] = ['taille','prix'];
  dataSource = [];
  constructor(public dialogRef: MatDialogRef<PanierComponent>,
              //@Optional() is used to prevent error if no data is passed
              @Optional() @Inject(MAT_DIALOG_DATA) public data: any,
              public panierService:PanierService) { }

  ngOnInit(): void {
    this.dataSource = this.data;
    console.log('this.panier');
    console.log(this.data);
  }
  closeDialog(){
    this.dialogRef.close({event:'Cancel'});
  }
  acheter(){
    console.log('acheter');
    console.log(this.data);
    this.panierService.postVariant(this.data).subscribe();
  }
}
