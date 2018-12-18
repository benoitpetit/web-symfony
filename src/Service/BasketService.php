<?php

namespace App\Service;

class BasketService {

// /*********************
//  * 
//  * voici une class php permettant de gérer un panier (ou caddi) en variables de session. 
// // - Le fichier index.php ne sert que d'exemple d'utilisation. 
// // - La gestion du panier se fait via la class cart (fichier cart.class.php) 

// // la class "cart" contient les fonctions permettant de : 
// // - Initialiser un panier 
// // - Ajouter des produits au panier 
// // - Retirer des produits du panier 
// // - Modifier la quantité d'un produit dans le panier 
// // - Avoir le nombre de produit total dans le panier 
// // - Avoir le montant total du panier 
//  * 
//  */


//   /**
//   * Constructeur de la class
//   */
//   function __construct(){
//     // Démarrage des sessions si pas déjà démarrées
//     if (session_status() == PHP_SESSION_NONE) {
//         session_start();
//     }
//     $this->initCart();
//   }
  
//   /**
//   *Initialisation du panier
//   */
//   public function initCart(){
//     $_SESSION['panier'] = array(); 
//   }
  
//   /**
//   * Retourne le contenu du panier
//   */
//   public function getList(){
//     return !empty($_SESSION['panier']) ? $_SESSION['panier'] : NULL;
//   }
  
//   /**
//   * Ajout d'un produit au panier
//   */
//   public function addProduct($id_produit,$libelle_produit,$qte=1,$prix_unitaire_produit=0){
//     if($qte > 0 ){
//       $_SESSION['panier'][$id_produit] = array('id_produit'=>$id_produit
//                                                 ,'produit'=>$libelle_produit
//                                                 ,'qte'=>$qte
//                                                 ,'prix_unitaire'=>$prix_unitaire_produit
//                                                 ); 
//       $this->updateTotalPriceProduct($id_produit);
//     }else{
//       return "ERREUR : Vous ne pouvez pas ajouter un produit sans quantité..."; 
//     }
//   }
  
//   private function updateTotalPriceProduct($id_produit){
//     if(isset($_SESSION['panier'][$id_produit])){
//       $_SESSION['panier'][$id_produit]['prix_Total'] = $_SESSION['panier'][$id_produit]['qte'] * $_SESSION['panier'][$id_produit]['prix_unitaire'];
//     }
//   }
  
//   /**
//   * Modifie la quantité d'une produit dans le panier
//   */
//   public function updateQteProduct($id_produit,$qte=0){
//     if(isset($_SESSION['panier'][$id_produit])){
//       $_SESSION['panier'][$id_produit]['qte'] = $qte;
//       $this->updateTotalPriceProduct($id_produit);
//     }else{
//       return "ERREUR : produit non présent dans le panier"; 
//     }
//   }
  
//   /**
//   * Supprime une produit du panier
//   */
//   public function removeProduct($id_produit){
//     if(isset($_SESSION['panier'][$id_produit])){
//       unset($_SESSION['panier'][$id_produit]);
//     }
//   }
  
//   /**
//   * Retourne le nombre de produits dans le panier
//   */
//   public function getNbProductsInCart(){
//     $panier = !empty( $_SESSION['panier'] ) ? $_SESSION['panier'] : NULL;
//     $nb = 0;
//     $panier = !empty( $_SESSION['panier'] ) ? $_SESSION['panier'] : NULL;
//     if(!empty($panier)){
//       foreach($panier as $P){ 
//         $nb += $P['qte'];
//       }
//     }
//     return $nb;
//   }
  
//   public function getTotalPriceCart(){
//     $total = 0;
//     $panier = !empty( $_SESSION['panier'] ) ? $_SESSION['panier'] : NULL;
//     if(!empty($panier)){
//       foreach($panier as $P){ 
//         $total += $P['prix_Total'];
//       }
//     }
//     return $total;
//   }
  
}
 
 


// ///////////////////////////////////////////////////////////////////////////////////////////////////
// // index.php (exemples d'utilisation ) 

// // <?php
// //Affichage des erreurs PHP ( A mettre au début de tes scripts PHP )
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);

// // Démarrage des sessions si pas déjà démarrées
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

// //on inclus la class qui permet de gérer le panier
// // require_once "chemin/vers/le/fichier/cart.class.php";
// require_once "cart.class.php";

// //on initialise l'objet panier :
// $oPanier = new cart();


// //maintenant on peut ajouter des produits au panier
// echo "<br><hr><br> On ajoute deux produits au panier";
// $oPanier->addProduct(1,'produit 1',1,10);
// $oPanier->addProduct(654,'produit xx',1,99.5);


// //on affiche le nombre de produits dans le pannier
// $nbProducts = $oPanier->getNbProductsInCart();
// echo "<br>Nombre de produits : ". $nbProducts;

// //on affiche le contenu du panier 
// $contenu_panier = $oPanier->getList();
// echo "<pre> Contenu du panier :<br>";
// print_r($contenu_panier );
// echo "</pre>";

// //on affiche le montant total du panier
// $total = $oPanier->getTotalPriceCart();
// echo "<br>Total panier : ". $total ;


// // on modifie la quantité du premier produit
// echo "<br><hr><br> On modifie la quantité du premier produit : nouvelle quantité = 35 ";
// $oPanier->updateQteProduct(1,35);

// //on re-affiche le nombre de produits dans le pannier
// $nbProducts = $oPanier->getNbProductsInCart();
// echo "<br>Nombre de produits : ". $nbProducts;

// //on re-affiche le contenu du panier 
// $contenu_panier = $oPanier->getList();
// echo "<pre> Contenu du panier :<br>";
// print_r($contenu_panier );
// echo "</pre>";

// //on re-affiche le montant total du panier
// $total = $oPanier->getTotalPriceCart();
// echo "<br>Total panier : ". $total ;


// // On retire le produit dont l'id est : 654
// echo "<br><hr><br>On retire le produit dont l'id est : 654" ;
// $oPanier->removeProduct(654);
// //on re-affiche le contenu du panier 
// $contenu_panier = $oPanier->getList();
// echo "<pre> Contenu du panier :<br>";
// print_r($contenu_panier );
// echo "</pre>";

