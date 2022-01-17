<?php /** @var Array $data */ ?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponúkam</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link rel="stylesheet" href="public/css.css">


    <!-- Dropdown menu -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <!-- profil recenzie -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>


</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top dark_bg fixed-top navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="?c=home">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0a/Paw_%28Animal_Rights_symbol%29.png/1200px-Paw_%28Animal_Rights_symbol%29.png"
                 width="30" height="30" alt="paw">
        </a>
        <button class="navbar-toggler justify-content-end" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-start" id="collapsibleNavbar">
            <ul class="navbar-nav ms-start">
                <li class="nav-item">
                    <a class="nav-link" href="?c=home">Domov</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?c=home&a=users">Ponúkam</a>
                </li>
                <li class="nav-item dropdown pointer">
                    <a class="nav-link"  href="?c=home&a=questions" aria-haspopup="true">Fórum</a>
                </li>
                <?php if(\App\Auth::isLogged()){ ?>
                <li class="nav-item dropdown pointer">
                            <a class="nav-link" href="?c=home&a=addQuestionForm">Pridať otázku</a>
                </li>
                <?php } else {?>
                    <li class="nav-item pointer">
                        <a class="nav-link" href="?c=home&a=questions">Fórum</a>
                    </li>
                <?php }?>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if (\App\Auth::isLogged()) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?c=auth&a=logout">Odhlásiť sa</a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="?c=home&a=getProfile">Profil</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?c=auth&a=loginForm">Login</a>
                    </li>
                <?php } ?>

            </ul>

        </div>
    </div>
</nav>


<?= $contentHTML ?>

<footer class="page-footer font-small dark_bg">
    <div class="footer-copyright text-center py-3">
        <p>Kontakt<br>
            email: sinalova4@stud.uniza.sk<br>
            tel.cislo: +4219254763
        </p>
        <a href="https://www.facebook.com/groups/825206431383484" target="_blank">
            <i class="fab fa-facebook-square"></i>
        </a>
    </div>
</footer>
</body>
</html>



