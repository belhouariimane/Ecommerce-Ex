import {Component, ViewChild} from '@angular/core';
import {MatTable, MatTableDataSource} from '@angular/material/table';
import {ProduitService} from "./service/produit.service";
import {MatDialog} from "@angular/material/dialog";
import {DetailProduitComponent} from "./detail-produit/detail-produit.component";
import {PanierComponent} from "./panier/panier.component";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'efront';

  newPanier = [];

  constructor(public dialog: MatDialog) {
  }
  openDialog(obj:any) {
    const dialogRef = this.dialog.open(PanierComponent, {
      width: '350px',
      data:obj
    });

    dialogRef.afterClosed().subscribe(result => {
      if(result.data){
        console.log('after close');
      }
    });
  }
  updatePanier(event:any){
    console.log('app');
    this.newPanier = event;
    console.log(event);
  }
}
