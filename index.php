<?php
    session_start();
    if(isset($_SESSION['usuario'])){
        if($_SESSION['usuario'] == null){
            header("Location: login.php");
        }
    }else{
        header("Location: login.php");
    }
  
?>


<!DOCTYPE html>
<html style="font-size: 16px;" lang="pt"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">

    <title>Biblioteca Educa</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
  <link rel="stylesheet" href="Pagina-Inicial.css" media="screen">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  
    
    
    
    
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "images/default-logo.png"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Página Inicial">
    <meta property="og:type" content="website">
  </head>
  <body data-home-page="Página-Inicial.html" data-home-page-title="Página Inicial" class="u-body u-xl-mode" data-lang="pt">
    
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><div style="width:200px"><img src="images/default-logo.png" style="width: 100%;"></div></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse menu" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="sobre.php">Sobre nós</a>
                </li>
                <li class="nav-item dropdown conta">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img src="images/account.png" style="width: 20px"><?php
                        echo $_SESSION['usuario']['username'];
                     ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="https://centroeducaead.com.br">Ir para o AVA</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="login.php">Sair</a>
                    </div>
                </li>
                
                
            </div>
      </div>
    </nav>



    <section class="u-align-center u-clearfix u-image u-section-1" id="carousel_0227" data-image-width="1980" data-image-height="1134">
      <div class="u-clearfix u-sheet u-valign-middle banner colorWhite">
            <div class='tittle'>
                <div class='flextittle1'>
                    <h1 class='tittleBiblioteca1'>BIBLIOTECA</h1>
                    <h1 class='tittleBiblioteca2'>EDUCA</h1>
                </div>
                <div class='flextittle2'>
                    <div>
                        <p>Acesso para os alunos do </p>
                        <p class='bold'>Centro Educacional Educa e Fadece</p>
                    </div>
                </div>
            </div>
      </div>
    </section>
    <section class="tittle">
      <div class="linha flexspacearound">
        <div class="coluna">
          <span>ACESSE NOSSA BIBLIOTECA DE LIVROS ONLINE</span>
          <h2>Acervo de livros</h2>
        </div>
        <div class="coluna col5 search">
          <form class="searchForm" method="get" action="index.php">
            <input type="text" name="pesquisa">
            <button type="submit"><img src="images/searchIcone.png" width="60%"></button>
          </form>

        </div>
      
      </div>
    </section>
    <section>
      <div class="linha flex">
            <div class="coluna">
                    <?php
                    if (isset($_GET['pesquisa'])) {
                      $pesquisa = $_GET['pesquisa'];
                    }else{
                      $pesquisa = '';
                    }
                    
                    setlocale(LC_ALL,'pt_BR.UTF8');
                        mb_internal_encoding('UTF8'); 
                        mb_regex_encoding('UTF8');
                      include 'conectbd.php';
                        if (empty($_GET['pag'])) {
                          $pagina = 1;
                        }else{
                          $pagina = $_GET['pag'];
                        }
                        
                        $exibir = 16;
                      $query = "select * from livros where nome like'%".$pesquisa."%'";
                      $exec = mysqli_query($conexao, $query);
                      $numerolivros = mysqli_num_rows($exec);
                      echo "Exibindo pagina ".$pagina." de ".ceil($numerolivros/$exibir);
                      
                    ?>
            </div>
          </div>
          <div class="linha flexspacearound navLivros">
            <div class="coluna col6" >
                    <?php


                      $anterior = $pagina -1;
                      $proximo = $pagina +1;
                      echo "<p>";
                      if ($pagina>1) {
                        echo " <a href='?pag=$anterior'>Anterior</a> ";
                      }
                    ?>  
            </div>
            <div class="coluna col6" style="text-align: right;">
                    <?php
                    echo "<p>";
                      if ($pagina<mysqli_num_rows($exec)/$exibir) {
                        echo " <a href='?pag=$proximo'>Próxima</a>";
                      }
                    
                      
                    ?>
            </div>
          </div>
    </section>
    <section class="u-align-center u-clearfix u-white u-section-2" id="carousel_ab0c">
      <div class="linha flex">
      
          
          
          
       
                      <?php
                        
                        //Carrega os livros
                        $pc = $pagina-1;

                        $query = "select * from livros where nome like'%".$pesquisa."%'";
                        $exec = mysqli_query($conexao, $query);
                        $linha = "";
                        if(mysqli_num_rows($exec) > $pc*$exibir && $pagina>0){
                          mysqli_data_seek($exec, $pc*$exibir);
                          $indice = 0;


                          while ($row_livro = mysqli_fetch_array($exec)) {
                            if ($indice < $exibir) {
                              $linha .= "<div class='itemLivro' onclick=\"livroMore('".$row_livro['id']."')\">
                            <img src='files/capas/".$row_livro['capa']."' />
                            <p>".$row_livro['nome']."</p>
                          
                            </div>";
                            $indice ++;
                            }
                          
                          }
                          echo $linha;

                        }else{
                          echo "pagina nao existe";
                        }
                        ?>  
                      

      </div>  
    </section>
   <section>
      <div class="linha flexspacearound navLivros">
              <div class="coluna col6">
                    <?php


                      $anterior = $pagina -1;
                      $proximo = $pagina +1;
                      echo "<p>";
                      if ($pagina>1) {
                        echo " <a href='?pag=$anterior'>Anterior</a> ";
                      }
                    ?>  
              </div>
              <div class="coluna col6" style="text-align: right;">
                    <?php
                    echo "<p>";
                      if ($pagina<mysqli_num_rows($exec)/$exibir) {
                        echo " <a href='?pag=$proximo'>Próxima</a>";
                      }
                    
                      
                    ?>
              </div>       
            </div>
          </div>

   </section>
    
    
    <section class="sectionAbout">
      <div class="linha flexspacearound">
        <div>
          <div>
            <span>MELHORES</span>
            <h2>Frases</h2>
          </div>  
          <div class="transiction col7">
            <div class="linha transictionline enable">    
                  <p>“Só se vê bem com o coração, o essencial é invisível aos olhos.”</p><label class="psub">O Pequeno Príncipe, Antoine de Saint-Exupéry</label>
            </div>

            <div class="linha transictionline">
                <p>“Quando acordei hoje de manhã, eu sabia quem eu era, mas acho que já mudei muitas vezes desde então.”</p><label class="psub">Alice no País das maravilhas, Lewis Carroll</label> </div>
            <div class="linha transictionline">
              
                <p>“Quando os pés estão corretos, todo o resto nos acompanha.”</p><p class="psub">As Crônicas de Nárnia: O leão, a feiticeira e o guarda-roupa, C. S. Lewis</p>
            
            </div>
            <div class="linha transictionline">
           
                <p>“Cada qual sabe amar a seu modo; o modo pouco importa; o essencial é que saiba amar.”</p><p class="psub">Machado de Assis, Ressurreição</p>
             
            </div>
            <div class="linha transictionline">
             
                <p>“Às vezes, se apaixonar é a atitude mais corajosa que alguém pode ter.”</p><p class="psub">A Coroa, Kiera Cass</p>
             
            </div>
          </div>
        </div>
      


      <div class="transictimg col5">
        <div class="flex transictionimg enable">
          <img class="filosofos" src="images/opp.jpg">
        </div>
        <div class="flex transictionimg">  
          <img class="filosofos" src="images/anpdm.jpg">
        </div>
        <div class="flex transictionimg">
          <img class="filosofos" src="images/acdn.jpg">
        </div>
        <div class="flex transictionimg">
          <img class="filosofos" src="images/r.jpg">
        </div>
        <div class="flex transictionimg">
          <img class="filosofos" src="images/ac.jpg">
        </div>
      </div>
    </section>
    
    
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-99ad">
      <div>
        Copyright © Centro Educa. Todos os direitos reservados.
      </div>
    </footer>
    
    
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>