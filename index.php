<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Listagem de JOGOS</title>
</head>

<body style="display: flex; justify-content: center;" class="bg-secondary bg-opacity-50">

    <?php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    require_once "./includes/login.php";
    $order = $_GET['order'] ?? "name"; //Vai ser passado na linha 33 em diante
    $search = $_GET['search'] ?? ""; //Vai ser passado na linha 40 em um form
    ?>


    <div class="pt-5 w-75">

        <nav style='border-radius: 5px;' class='navbar bg-dark mb-4'>

                <?php 
                    if(empty($_SESSION['user'])){
                        echo "<div style='display: flex; justify-content: end; gap: 1.7rem;' class='container-fluid bg-dark bg-gradient mb-1 pt-2'>";
                        echo "<a href='#'><p style='color: white;' class='btn btn-outline-primary'>Cadastrar-se</p></a>";
                        echo "<a href='./user-login.php'><p style='color: white;' class='btn btn-outline-primary me-5'>Entrar</p></a>";
                    } else{
                        if(is_logged()){
                            echo "<div style='display: flex; justify-content: space-between; align-items: baseline;' class='container-fluid  bg-dark bg-gradient'>";
                            echo "<div class='dropdown ms-5'>
                            <button class='btn btn-primary dropdown-toggle' type='button'  data-bs-toggle='dropdown'>Painel</button>
                            <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                              <li><a class='dropdown-item' href='./user-edit.php'>Meus Dados</a></li>";
                          if(is_admin()){
                              echo "<li><a class='dropdown-item' href='user-new.php'>Novo usuário</a></li>";
                              echo "<li><a class='dropdown-item' href='#'>Novo Jogo</a></li>";
                          }

                        echo "</ul>";
                        echo "</div>";

                        echo "<p style='color: white;'>Bem Vindo, <strong>".$_SESSION['username']. "</strong>!</p>";
                          echo "<a href='user-logout.php' class='me-5 pt-2'><p style='color: white;' class='btn btn-outline-danger'>Sair</p></a>";
                        }
                        ;
                    }
                ?> 
            </div>

            <div style='display: flex; justify-content: space-between; align-items: baseline;' class='container-fluid ms-4 me-3'>
                <a style='font-size: 30px; font-family: Courier New' class='navbar-brand text-white'>Listagem de Jogos</a>
                <div>
                    <p style="color: white; font-size: 13px; text-align: center;">Ordernar por: </p> 
                    <p style="color: white; font-size: 13px; text-align: center;"> 
                        <a href="./index.php?order=name<?php if(!empty($search)){echo "&&search=$search";}?>" style="text-decoration: underline; color: white;">Nome</a> | 
                        <a href="./index.php?order=producer<?php if(!empty($search)){echo "&&search=$search";}?>" style="text-decoration: underline; color: white;">Produtora</a> | 
                        <a href="./index.php?order=high_score<?php if(!empty($search)){echo "&&search=$search";}?>" style="text-decoration: underline; color: white;">Nota Alta</a> | 
                        <a href="./index.php?order=low_score<?php if(!empty($search)){echo "&&search=$search";}?>" style="text-decoration: underline; color: white;">Nota Baixa</a> |
                        <a href="./index.php?" style="text-decoration: underline; color: white;">Mostrar Todos</a></p>
                        
                </div>
                <form method="GET" action="./index.php" class='d-flex' role='search'>
                    <input name="search" class='form-control me-2' size="20" maxlength="40" type='search' placeholder='Search' aria-label='Search'>
                    <button class='btn btn-outline-success' type='submit'>Search</button>
                </form>
            </div>
        </nav>

        <table style="background-color: white; overflow: hidden; border-radius: 5px; box-shadow: 10px 15px 10px gray;" class="table table-hover mb-3">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 100px;">FOTO</th>
                    <th scope="col">NOME</th>
                    <?php 
                    if(is_editor() || is_admin()){
                        echo "<th scope='col' style='width: 90px;'>ADM</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                $q = "SELECT j.cod,j.capa, j.nome, g.genero, p.produtora FROM jogos j JOIN generos g on j.genero = g.cod JOIN produtoras p on j.produtora = p.cod ";

                if(!empty($search)){
                    $q .= "WHERE j.nome like '%$search%' OR p.produtora like '%$search%' OR g.genero like '%$search%' ";
                 }

                switch($order){
                    case "name":
                        $q .= "ORDER BY nome";
                        break;
                    case "producer":
                        $q .= "ORDER BY produtora";
                        break;
                    case "high_score":
                        $q .= "ORDER BY nota DESC";
                        break;
                    case "low_score":
                        $q .= "ORDER BY nota ASC";
                        break;
                };


                

                $busca = $banco->query($q);

                if (!$busca) {
                    echo "<tr><td>Ocorreu um erro: $banco->error</tr></td>";
                } else {
                    if ($busca->num_rows == 0) {
                        echo "<tr><td>Nenhum registro encontrado!</tr></td>";
                    } else {
                        while ($reg = $busca->fetch_object()) {
                            $foto = thumb($reg->capa);

                            echo "<tr class='align-middle'>";
                            echo "<td><img style='width: 50px;' src='$foto'></td>";
                            echo "<td><a href='./detalhes.php?cod=$reg->cod'>$reg->nome</a>";
                            echo " [$reg->genero] <br> $reg->produtora</td>";
                            if(is_admin()){
                                echo "<td> <i class='fa-solid fa-pen'></i> | <i class='fa-solid fa-trash'></i> </td>";
                            } else if(is_editor()){
                                echo "<td><i class='fa-solid fa-pen'></i></td>";
                            }
                            echo "</tr>";

                            

                        
                        }
                    }
                }
                ?>

            </tbody>
        </table>
        <?php include_once "rodape.php" ?>
    </div>






    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/fa113f9619.js" crossorigin="anonymous"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>