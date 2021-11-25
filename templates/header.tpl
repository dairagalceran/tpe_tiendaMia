<!DOCTYPE html>
<html lang="en">

    <head>
        <base href="{BASE_URL}">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>tiendaMIA</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet" type="text">
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="">tiendaMIA</a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarText">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div id="navbarText" class="collapse navbar-collapse">
                        <ul class="navbar-nav  ms-5 ">
                            {if isset($smarty.session.IS_ADMIN) && ($smarty.session.IS_ADMIN) }
                                <li class="nav-item"><a class="nav-link active"
                                        href="{BASE_URL}/adminProducts">AdminProductos</a> </li>
                                <li class="nav-item"><a class="nav-link active"
                                        href="{BASE_URL}/adminCategories">AdminCategorias</a> </li>
                                <li class="nav-item"><a class="nav-link active"
                                        href="{BASE_URL}/adminUsers">AdminUsuarios</a> </li>
                            {else}
                                <li class="nav-item"><a class="nav-link active" href="">Catálogo</a> </li>
                                <li class="nav-item"><a class="nav-link active" href="{BASE_URL}/category">Categorías</a>
                                </li>
                            {/if}
                        </ul>
                    </div>

                    <div>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                {if isset($smarty.session.USER_ID)}
                                    <a class="nav-link active" aria-current="page" href="{BASE_URL}/logout"><small>Logout de
                                            {$smarty.session.USER_NAME}<small></a>
                                {else}
                                    <a class="nav-link active" aria-current="page" href="{BASE_URL}/login">
                                        <samll>Iniciar sesión</small>
                                    </a>
                                {/if}
                            </li>
                        </ul>

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{BASE_URL}/registerForm"><small>Registrarse</small></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>

        </header>

<div class="container">