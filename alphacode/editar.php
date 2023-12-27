<?php
include "db_conn.php";
$id = $_GET['id'];

if(isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $profissao = $_POST['profissao'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];

    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
    $profissao = filter_input(INPUT_POST, "profissao", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    do {
        if(empty($nome) || empty($data_nascimento) || empty($email) || empty($profissao) || empty($telefone) || empty($celular)){
            $errorMessage = "Por favor preencha todos os campos!";
             break;
    
        } else {
            $sql = "UPDATE `contatos` SET `nome`='$nome',`data_nascimento`='$data_nascimento',`email`='$email',`profissao`='$profissao',`telefone`='$telefone',`celular`='$celular' WHERE id = $id";

            $result = mysqli_query($conn, $sql);
    
            if($result) {
                header("Location: index.php?msg=Dados Atualizados com sucesso");
            }
            else {
                echo "Failed: " . mysqli_error($conn);
            }
        }
    } while (false);


        
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar contatos</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <header class="header">
        <img src="./assets/logo_alphacode.png" alt="Logo Alphacode">
        <h1 class="header__title">Editar contatos</h1>
    </header>
    <main>
        <?php
        $sql = "SELECT * FROM `contatos` WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);


        if (!empty($errorMessage) ) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
            ";
        }

        ?>

        
        <form action="" class="form" method="post">
            <fieldset>
                <div class="container text-center">
                    <div class="row row-cols-2">
                      <div class="col">
                          <div class="form__margin">
                              <label>Nome completo</label><br>
                              <input type="text" name="nome" value="<?php echo $row['nome']?>" <br>
                          </div>
                      </div> 
                          <div class="col">
                          <div class="form__margin">
                              <label>Data de nascimento</label><br>
                              <input type="text" name="data_nascimento" value="<?php echo $row['data_nascimento']?>"<br>
                          </div>
                      </div>
                          <div class="col">
                          <div class="form__margin">
                              <label>E-mail</label><br>
                              <input type="email" name="email" value="<?php echo $row['email']?>"<br>
                          </div>
                      </div>
                          <div class="col">
                          <div class="form__margin">
                              <label>Profissão</label><br>
                              <input type="text" name="profissao" value="<?php echo $row['profissao']?>"<br>
                          </div>
                      </div>
                          <div class="col">
                          <div class="form__margin">
                              <label>Telefone para contato</label><br>
                              <input type="text" name="telefone" value="<?php echo $row['telefone']?>"<br>
                          </div>
                      </div>
                          <div class="col">
                          <div class="form__margin">
                              <label>Celular para contato</label><br>
                              <input type="text" name="celular" value="<?php echo $row['celular']?>"<br>
                          </div>
                      </div>
                    </div>
                </div>
                <div class="container text-center">
                <div class="row row-cols-2">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                            Número de celular possui WhatsApp
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                            Enviar notificações por e-mail
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                            Enviar notificações por SMS
                            </label>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="button-margin">
                    <button class="btn btn-primary" type="submit" name="submit">Salvar</button>
                    <div style="margin-left: 10px;">
                        <a href="./index.php" class="btn btn-primary">Cancelar</a>
                    </div>
                </div>
            </fieldset>  
         </form>
    </main>

  

    <footer>
        <p class="footer__text">Termos | Políticas</p>
        <div class="footer__midle">
            <p>© Copyright 2022 | Desenvolvido por</p> <img class="imgfooter" src="./assets/logo_rodape_alphacode.png" alt="Logo Alphacode">
        </div>
        <p class="footer__text">©Alphacode IT Solutions 2022</p>
    </footer>
</body>

</html>