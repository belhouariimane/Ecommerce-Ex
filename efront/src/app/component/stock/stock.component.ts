import { Component, OnInit } from '@angular/core';
import {StockService} from "../../service/stock.service";

@Component({
  selector: 'app-stock',
  templateUrl: './stock.component.html',
  styleUrls: ['./stock.component.scss']
})
export class StockComponent implements OnInit {
  displayedColumns: string[] = ['name', 'marque', 'categorie', 'type','genre','taille','qte','prix','couleur'];
  dataSource :any;
  constructor(private stockService:StockService) { }

  ngOnInit(): void {
    this.stockService.getStock().subscribe(data=>{
      this.dataSource = data
    });
  }

}
