<?php
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./css/style.css">
        <title>Petzone</title>
        <link rel="shortcut icon" href="./icon/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <section class="home-page">
            <div class="div-wrapper-home">
                <div class="container">
                <div class="pagina-inicial">
            <?php
                require_once('./modulo/menu.php');
            ?>
            <div class="help">
                <img src="./icon/question.png" alt="ask">
                <div class="devContato">
                    <div>
                        <p>Dúvidas? Entre em contato com o Dev.</p>
                        <br>
                        <p>555-123</p>
                    </div>
                </div>       
            </div>
            <div class="container-home">
                <div class="main">
                    <?php
                        require_once('modulo/header.php');
                    ?>
                    <div class="conteudo-home">
                        <div class="texto-home-titulo">
                            <h1 class="titulo">
                                PetZone
                            </h1>
                        </div>
                        <p class="texto-instrucao">
                            Utilize o menu à esquerda para navegar no sistema.
                        </p>

                        <div class="aniversario-title">
                            <h1 class="titulo" style="border:none; width:100%; margin-bottom: 0;">
                                Confira abaixo os aniversáriantes do mês!
                            </h1>
                        </div>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Contato</th>
                                <th scope="col">Instagram</th>
                                <th scope="col">Aniversário</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    //Gera o mês atual
                                    $data_ordem = date('m');
                                    
                                    // Seleciona todos os clientes filtrando apenas pelo mês
                                    $sql = "SELECT * FROM clientes WHERE data_nascimento LIKE '%".$data_ordem."%' ORDER BY data_nascimento DESC";                                  

                                    $select = mysqli_query($conexao, $sql);

                                    $i = 0;

                                    while($rsConsulta = mysqli_fetch_array($select)){
                                        $i++;

                                        $data_nascimento = explode('-',$rsConsulta['data_nascimento']);
                                        $data_nascimento = $data_nascimento[2]."/".$data_nascimento[1];

                                ?>
                                    <tr>
                                    <th scope="row"><?=$i?></th>
                                        <td><?=$rsConsulta['nome']?></td>
                                        <td><?=$rsConsulta['celular']?></td>
                                        <td><?=$rsConsulta['email']?></td>
                                        <td><?=$data_nascimento?></td>
                                    </tr>

                                <?php
                                    }
                                ?>
                                
                                
                            </tbody>
                        </table>
                        


                        
                    </div>
                    
                </div>
            </div>
        </div>
                </div>
            </div>
        </section>
    </body>
</html>