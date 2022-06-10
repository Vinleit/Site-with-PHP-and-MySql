<!DOCTYPE html>
<html lang="pt-BR" style="height: 100%;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title>Login</title>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100%;" class="text-bg-dark">
    <?php 
        require_once "./includes/login.php";
        require_once "./includes/banco.php";
        require_once "./includes/funcoes.php";
    ?>


    <div id="body" style="border-radius: 27px 27px 7px 7px; background-color: white; color: black;" class="shadow-lg p-2 mb-5 bg-body">
        <?php 
            $user = $_POST['user'] ?? null;
            $passwd = $_POST['password'] ?? null;

            if(is_null($user) || is_null($passwd)){
                require "./user-login-form.php";
            }         
            else{
                $busca = $banco->query("SELECT usuario, nome, senha, tipo FROM usuarios WHERE usuario = '$user'");
                if($busca->num_rows == 0){
                    msg_error_no_X("Usuário inválido!");
                } else{
                    $reg = $busca->fetch_object();
                    if(VerifyHash($passwd,$reg->senha)){
                        $_SESSION['user'] = $reg->usuario;
                        $_SESSION['username'] = $reg->nome;
                        $_SESSION['type'] = $reg->tipo;

                        header('Location: ./index.php');
                        die();
                    } else{
                        msg_error_no_X("Senha inválida!");
                    }
                }
            }
            btn_back("ms-3 mb-4");
        ?>
    </div>




    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/fa113f9619.js" crossorigin="anonymous"></script>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>