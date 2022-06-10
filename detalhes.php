<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title>Detalhes do Jogo</title>
</head>
<body style="display: flex; justify-content: center; flex-direction: column;" class="bg-secondary bg-opacity-50">

  <?php 
    require_once "./includes/banco.php";
    require_once "./includes/funcoes.php";
    require_once "./includes/login.php";
  ?>
    
    <div style="border-radius: 10px; box-shadow: 10px 15px 10px gray; margin: auto;" class="mt-5 p-4 w-75 mb-3 bg-white">
        <?php 
            $cod = $_GET['cod'] ?? 0;
            $busca = $banco->query("SELECT * FROM jogos WHERE cod = '$cod'")
        ?>

        <table style="background-color: white; overflow: hidden; border-radius: 5px;">
            <?php 
                if(!$busca){
                    echo "Ocorreu um erro: $banco->error";
                }else{
                    if($busca->num_rows == 1){
                        $reg = $busca->fetch_object();
                        $foto = thumb($reg->capa);
                        echo "<tr> <td class='p-2' rowspan=3'><img style='width: 350px' src='$foto'></td>";
                        echo "<td class='ps-5'><h1>$reg->nome</h1>";
                        echo " Nota: ". number_format($reg->nota, 1) . " / 10 <i class='fa-solid fa-star fa-bounce' style='--fa-animation-duration: 2.5s; color:  #ffc746'></i></td></tr>";
                        echo "<tr><td style='text-align: justify' class='p-4'>$reg->descricao</td></tr>";
                        echo "<tr>"; 
                        if(is_admin()){
                            echo "<td class='ps-4'> <i class='fa-solid fa-pen'></i> | <i class='fa-solid fa-trash'></i> </td>";
                        } else if(is_editor()){
                            echo "<td class='ps-4'><i class='fa-solid fa-pen'></i></td>";
                        }
                        echo "</tr>";
                    } else{
                        echo "<p>Nenhum registro encontrado!";
                    }
                }
            ?>


        </table>
        
        <?php btn_back("pt-5") ?>
    </div>
    <?php include_once "rodape.php" ?>






    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/fa113f9619.js" crossorigin="anonymous"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>