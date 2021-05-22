import {Component, Inject, Input, OnInit, Optional} from '@angular/core';
import {MAT_DIALOG_DATA, MatDialogRef} from "@angular/material/dialog";
import {Produit} from "../../model/produit";
import {PanierService} from "../../service/panier.service";
import {ActivatedRoute, Router} from "@angular/router";

@Component({
  selector: 'app-panier',
  templateUrl: './panier.component.html',
  styleUrls: ['./panier.component.scss']
})
export class PanierComponent implements OnInit {

  displayedColumns: string[] = ['nom','categorie','couleur','taille','prix','quantite'];
  dataSource = [];
  constructor(public dialogRef: MatDialogRef<PanierComponent>,
              //@Optional() is used to prevent error if no data is passed
              @Optional() @Inject(MAT_DIALOG_DATA) public data: any,
              public panierService:PanierService,
              private router: Router) { }

  ngOnInit(): void {
    this.dataSource = this.data;

  }
  closeDialog(){
    this.dialogRef.close({event:'Cancel'});
  }
  acheter(){
    const objToPost = [];
    this.data.forEach( obj =>
      objToPost.push({'variant':obj['variant'],'stock':obj['stock'],'qte':obj['qte']})
    );
    this.panierService.postVariant(objToPost).subscribe(
      ()=>{
      },
        error => {
          console.log('on error');
          console.log(error);
        },
      ()=> {
        this.closeDialog();
        this.router.navigate(['**']);

      });
  }
}
