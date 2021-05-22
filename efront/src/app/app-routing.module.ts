import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {ListeProduitComponent} from "./component/liste-produit/liste-produit.component";
import {StockComponent} from "./component/stock/stock.component";
import {MenuComponent} from "./component/menu/menu.component";
import {HomeComponent} from "./component/home/home.component";

const routes: Routes = [
  { path: 'stock', component: StockComponent },
  { path: 'produits', component: HomeComponent },
  { path: '', component: HomeComponent },

  // otherwise redirect to home
  { path: '**', redirectTo: '' }
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
