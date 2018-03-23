<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8"/>
        <title>Grajaú Xadrez Club</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/estilo1.css") ?>" />
    </head>

    <body>
        <div class="interface">
            <header class="cabecalho">
                <hgroup>
                    <h1>Torneio Aberto de Xadrez de Grajaú!</h1>
                    <h2>2ª edição</h2>
                </hgroup>

                <img class="icone" src = "<?php echo base_url("imagens/icone2.png") ?>" />
                <nav class="menu">
                    <h1>Menu Principal</h1>
                    <ul>
                        <li ><a href="<?php echo site_url("usuario/index") ?>">Home</a></li>
                        <li ><a href="<?php echo site_url("torneio/torneio/index") ?>">Torneio</a></li>
                        <li ><a href="<?php echo site_url("classificacao/index") ?>">Classificação</a></li>
                        <li ><a href="<?php echo site_url("historico/index") ?>">Histórico</a></li>
                        <li ><a href="<?php echo site_url("sorteio/index") ?>">Sorteio</a></li>
                    </ul>
                </nav>	
            </header>

<!--          conteudo da página-->
            <div class="conteudo">
                <?= $contents ?>
            </div> 



            <footer class="footer">
                <p>Copyright 2018 - by Emerson Lopes <br/>
                    <a href="http://facebook.com//emerson.lopes.169" target="_blank">Facebook</a>
                    <a href="http://twitter.com/cursosemvideo" target="_blank">Twitter</a></p>
            </footer>	
</div>
        
    </body>
</html>