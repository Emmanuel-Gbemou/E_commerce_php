<?php
function displayAccueil()
{

  $result = "<h1>Bienvenue sur la page d'Accueil</h1>";
  $result .= '<div class="bg-white shadow-sm rounded p-6">
  <form class="" action="actionInscription" method ="post">
  <div class="mb-4">
    <h2 class="h4">INSCRIPTION</h2>
  </div>

  <div class="mb-3">
    <div class="input-group input-group form">
    <input type="text" name="pseudo" class="form-control"  value="moussa" placeholder="Entrer votre Pseudo" required>
    </div>
  </div>

  <div class="mb-3">
  <div class="input-group input-group form">
  <input type="type"  class="form-control" name="email" value="moussa@gmail.com" placeholder="emma@gmail.com">
  </div>
</div>

<div class="mb-3">
  <div class="input-group input-group form">
  <input type="password" class="form-control" name="password" value="moussa2021" placeholder="Entrer votre mot de passe">
  </div>
</div>

<button type="submit" class="btn w-100 btn-primary">S\'inscrire</button
</form>
  
  </div>';

  return $result;
}



//signature emma
function displayActionInscription()
{

  global $model;
  //print_r($_REQUEST);exit();
  $pseudo = $_REQUEST['pseudo'];
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $data = $model->createCustomers($pseudo, $email, $password);
  if ($data) { //inscription reussie
    $data_customer = $model->authentifier($email, $password);
    if ($data_customer) {
      $_SESSION['customer'] = $data_customer;
      return '<p class="alert alert-success w-100 m-3 btn btn-block" role="alert">
          Inscription reussie ' . $pseudo . ',vous etes bien connecte
      </p>' . displayProduit();
    }
  } else { //inscription echouee
    return '<p class="alert alert-danger w-100 m-3 btn btn-block" role="alert">
          ce compte existe deja
      </p>' . displayProduit();
  }
}

function  displayActionConnexion()
{

  global $model;
  //print_r($_REQUEST);exit();
  $email = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $data_customer = $model->authentifier($email, $password);
  if ($data_customer) {
    $_SESSION['customer'] = $data_customer;
    return '<p class="alert alert-success w-100 m-3 btn btn-block" role="alert">
  Authentification reussie,vous etes bien connecte
</p>' . displayProduit();
  } else { 
    return '<p class="alert alert-danger w-100 m-3 btn btn-block" role="alert">
  Authentification echouee
</p>' . displayProduit();
  }
}



function displayDeconnexion()
{
  unset($_SESSION['customer']);
  return '<p class="alert alert-success w-100 m-3 btn btn-block" role="alert">
    Deconnexion reussie
</p>' . displayProduit();
}



function displayContact()
{

  $result = "<h1>Bienvenue sur la page de Contact</h1>";
  $result .= '
  <h1 class="text-center">Contactez-Nous</h1>
  <form>
  <div class="form-row offset-md-3">
  <div class="form-group col-md-6 ">
  <label for="name" class="form-label">Nom:</label>
  <input type="text" class="form-control" id="name" aria-describedby="emailHelp" required>
</div>

  <div class="form-group col-md-6">
  <label for="prenom" class="form-label">Prenom:</label>
  <input type="text" class="form-control" id="prenom" required>
</div>
<div class="form-group col-md-6">
<label for="pseudo" class="form-label">Pseudo:</label>
<input type="text" class="form-control" id="psudo" required>
</div>


<div class="form-group col-md-6">
<label for="" class="form-label">Email:</label>
<input type="mail" class="form-control" id="email" required>
</div>
<div class="form-group col-md-6">
<label for="password" class="form-label">Password:</label>
<input type="password" class="form-control" id="exampleInputPassword1" required>
</div>
<div class="form-group col-md-6">
<label for="password" class="form-label">Message:</label>
<textarea class="form-control" row="5" col="80" required></textarea>
</div>

<div class="form-group">
<div class="form-check">
<input class="form-check-input" type="checkbox" id="">
<label class="form-check-label" for="">Se rappeler de moi</label>
<div>
</div>
<button type="submit" class="btn btn-success">Submit</button></div>
</form>';
  return $result;
}



function displayProduit()
{

  global $model;
  $dataProduct = $model->getProduct();
  $result = '<h1>Bienvenue sur la page de produits</h1>';

  foreach ($dataProduct  as  $key => $value) {

    $result .= '<div class="card" style="width: 18rem;display:inline-block">
            <img src="' . BASE_URL . SP . "images" . SP . "produit" . SP . $value['image'] . '" class="card-img-top" alt="image produit">
            <div class="card-body">
              <h5 class="card-title">' . $value['name'] . '</h5>  
              <a href="' . BASE_URL . SP . "details" . SP . $value['id'] . '" class="btn btn-primary">Details</a>
              <a href="' . BASE_URL . SP . "panier" . SP . $value['id'] . '" class="btn btn-success">Acheter</a>
            </div>
          </div>';
  }

  return $result;
}



//Signature:Emma
function displayCategory()
{
  global $model;
  global $url;
  global $category;
  if (isset($url[1]) && is_numeric($url[1]) && $url[1] > 0 &&  $url[1] < sizeof($category) + 1) {

    $result = '<h1>Produits de la categories ' . $category[$url[1] - 1]["name"] . '</h1>';
    $dataProduct = $model->getProduct(null, $url[1]);

    foreach ($dataProduct  as  $key => $value) {
      $result .= '<div class="card" style="width: 18rem;display:inline-block">
            <img src="' . BASE_URL . SP . "images" . SP . "produit" . SP . $value['image'] . '" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">' . $value['name'] . '</h5>  
              <a href="' . BASE_URL . SP . "details" . SP . $value['id'] . '"class="btn btn-primary">Details</a>
              <a href="' . BASE_URL . SP . "panier" . SP . $value['id'] . '" class="btn btn-success">Acheter</a>
            </div>
          </div>';
    }
  } else {
    $result  = '<h1>ERROR 404</h1>';
  }

  return $result;
}



function displayDetails()
{
  global $model;
  global $url;
  global $category;
  $result = '<h1>Bienvenue sur la page de details  produits</h1>';
  $dataProduct = $model->getProduct(null, null, $url[1]);
  $result .= ' <div class="row details">
                  <div class="col-md-5 col-12">
                        <img src="' . BASE_URL . SP . "images" . SP . "produit" . SP . $dataProduct[0]['image'] . '" class="card-img-top" alt="...">
                  </div>
                  <div class="col-md-7 col-12">
                      <h3>' . $dataProduct[0]['name'] . '</h3>
                      <p>' . $dataProduct[0]['description'] . '</p>
                      <p> Category :  ' . $category[$dataProduct[0]['category'] - 1]['name'] . '</p>
                      <div class="d-grid gap-2">
                      <a href ="' . BASE_URL . SP . "panier" . SP . $dataProduct[0]['id'] . '" class="btn btn-success" type="button">Ajouter au panier</a>
                      <a href="' . BASE_URL . SP . "produit" . '" class="btn btn-primary" type="button">Retour Page Produit</a>
                    </div>
                  </div>
        </div>';

  return $result;
}



function displayPanier()
{

  global $model;
  global $url;
  if (isset($url[1])) {
    $idProduit = $url[1];
    $dataProduct = $model->getProduct(null, null, $url[1]);
    $_SESSION['panier'][] = $dataProduct[0];
  }
  // $_SESSION['panier'][] = $dataProduct [0];
  // print_r($_SESSION);exit();
  if (!isset($_SESSION["panier"]) || sizeof($_SESSION['panier']) == 0) {
    return '<p class="alert alert-danger w-100 m-3" role="alert">
     Votre panier est vide
      </p>' . displayProduit();
  }
  $result = '<table class="table caption-top border">
     <caption>List of users</caption>
     <thead>
       <tr>
         <th scope="col">#</th>
         <th scope="col">Nom</th>
         <th scope="col">Description</th>
         <th scope="col">Images</th>
         <th scope="col">Prix</th>
         <th scope="col">Quantite</th>
           <th scope="col">Action</th>
       </tr>
       </thead>
          <tbody>';

  //signature:Emma
  $total_price = 0;
  foreach ($_SESSION["panier"] as  $key => $value) {
    $total_price += $value['price'];
    $result .= ' <tr>
        <th scope="row">' . $value['id'] . '</th>
        <td>' . $value['name'] . '</td>
        <td>' . $value['description'] . '</td>
        <td><img src="' . BASE_URL . SP . "images" . SP . "produit" . SP . $value['image'] . '" alt="..."/></td>
        <td>' . $value['price'] . '$<td>
        <td>1</td>
        <td><a>     <a href="' . BASE_URL . SP . "supprimer" . SP . $key . '" class="btn btn-primary">Supprimer</a> </a></td>
      </tr>';
  }
  $total_tva = $total_price * TVA / 100;
  $total_ttc = $total_tva + $total_price;

  $result .= '<tr><td></td><td></td><td></td><td>Prix total (HT)</td><td>' . number_format($total_price, 2) . '$</td><td></td></tr>
  <tr><td></td><td></td><td></td><td>TVA(' . TVA . '%)</td><td>' . number_format($total_tva, 2) . '$</td><td></td></tr>
  <tr><td></td><td></td><td></td><td>Total(TTC)</td><td>' . number_format($total_ttc, 2) . '$</td><td></td></tr>';


  $result .= ' </tbody>
     </table>';

  return $result;
}



function displaySupprimer()
{

  global $url;

  //print_r($_SESSION['panier']);exit();
  $param = $url[1];
  if (isset($url[1]) && is_numeric($url[1])) {
    unset($_SESSION['panier'][$url[1]]);
    header("Location: " . BASE_URL . SP . "panier");
  }
}
