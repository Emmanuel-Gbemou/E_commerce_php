<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LIEN CSS DE BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title> <?php echo $title ?> </title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="#">EMMA_PRASS</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" aria-current="page" href=<?php echo BASE_URL . SP . "accueil" ?>>Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?php echo BASE_URL . SP . "produit" ?>">Produit</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" href="#">Categories</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <!-- <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                            <?php
                            foreach ($category as $key => $value) {
                                echo '<a class="dropdown-item" href="' . BASE_URL . SP . "category" . SP . $value['id'] . '">' . $value['name'] . '</a>';
                            }

                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="<?php echo BASE_URL . SP . "contact" ?>">Contact</a>
                    </li>
                </ul>
                <a href="<?php echo BASE_URL . SP . "panier" ?>" class="btn btn-outline-success me-2" type="submit">panier</a>
                <?php if(!isset($_SESSION['customer'])): ?>
                    <form class="d-flex mr-2" action="actionConnexion" method="post">
                        <input class="form-control me-2" name="email" type="email" placeholder="Votre email" aria-label="Search" required>
                        <input class="form-control me-2" name="password" type="password" placeholder="Votre password" aria-label="Search" required>
                        <button class="btn btn-outline-success me-2" type="submit">connexion</button>

                    </form>
                    <a href="<?php echo BASE_URL . SP . "accueil" ?>" class="btn btn-outline-success" type="submit">Inscription</a>
                <?php endif; ?>
                <?php if(isset($_SESSION['customer'])): ?>
                    <a href="<?php echo BASE_URL . SP . "profil" ?>" class="btn btn-outline-success" type="submit">Profil</a>
                    <a href="<?php echo BASE_URL . SP . "deconnexion" ?>" class="btn btn-outline-success" type="submit">Deconnexion</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php echo $content ?>
    </div>
    <!-- LIEN JS DE BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>