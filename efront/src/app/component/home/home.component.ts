import { Component, OnInit } from '@angular/core';
import {MatDialog} from "@angular/material/dialog";
import {PanierComponent} from "../panier/panier.component";

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

  newPanier = [];

  constructor(public dialog: MatDialog) {
  }

  ngOnInit(): void {
  }
  // show panier dialog
  openDialog(obj:any) {
    const dialogRef = this.dialog.open(PanierComponent, {
      width: '350px',
      data:obj
    });
    dialogRef.afterClosed().subscribe();
  }
  updatePanier(event:any){
    this.newPanier = event;
  }


}
