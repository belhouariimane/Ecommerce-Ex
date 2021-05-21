import {Component, OnInit, Output, EventEmitter} from '@angular/core';
import {ProduitService} from "../service/produit.service";
import {DetailProduitComponent} from "../detail-produit/detail-produit.component";
import {MatDialog} from "@angular/material/dialog";

@Component({
  selector: 'app-liste-produit',
  templateUrl: './liste-produit.component.html',
  styleUrls: ['./liste-produit.component.scss']
})
export class ListeProduitComponent implements OnInit {
  displayedColumns: string[] = ['name', 'marque', 'categorie', 'type','genre','action'];
  dataSource :any;
  prePanier = [];
  @Output("change") panierChange = new EventEmitter<any>();
  constructor(private produitService:ProduitService,public dialog: MatDialog) { }

  ngOnInit(): void {
    this.produitService.getAll().subscribe(data=>{
      this.dataSource = data
    });
  }
  changePanier(){
    this.panierChange.emit(this.prePanier);
  }
  openDialog(obj:any) {
    const dialogRef = this.dialog.open(DetailProduitComponent, {
      width: '350px',
      data:obj
    });

    dialogRef.afterClosed().subscribe(result => {
      if(result.data){
        this.prePanier.push(result.data);
      }
     this.changePanier();
    });
  }
}
