<?php include('connection.php');
 ?>
<!DOCTYPE HTML>
   <HTML lang="en">    
      <head>  
         <meta charset="utf-8"> <!-- definit l'encodage des charactères de la page -->
         <meta name="description" content="The best website for the new independant african women leaders "> <!-- définit la description de la page -->
         <meta name="keywords" content="woman feminina blog independant african femme leaders entrepreneurs"> <!-- definit les mots clés pour les moteurs de recherche -->
         <meta name="author" content="Feminina"> <!-- definit l'auteur de la page -->
         <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Interdire le mode de compatibilité sur IE -->
         <meta name="viewport" content="width=device=width, initial-scale=1.0"> <!-- Donne les instructions au navigateur sur comment controler l'échelle et les dimensions de la page "doit apparaître dans toutes les pages "-->
         <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
         <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
         <link rel="stylesheet" type="text/css" href="css/styles.css">
         <title> The best reference for african women leaders  | Feminina </title>  <!-- definit le titre de la page -->
         <!-- logo dans la barre de titre de la page -->
            <link rel="shortcut icon" href="img/logos/beauty-icon.ico" type="img/icp">
      </head>    

      <body>  
  
      <?php include('menu.php');
      ?>
         
         <div class="container">
            <?php 
                     $n=1;
                     $list=" SELECT 
                              articles.id,
                              titre,
                              resume,
                              description,
                              image,
                              categories.libelle,
                              user.nom,
                              user.prenom
                           FROM articles
                           INNER JOIN categories
                           ON categories.id = articles.id_categories 
                           INNER JOIN user 
                           ON user.id = articles.id_user";
                     $res= mysqli_query($link,$list);
   while ($data = mysqli_fetch_array($res)){
                        
                   ?>
            <div class="row">
            <div class="col-sm-3">
               <img src="upload/<?php echo $data['image'];  ?>" width="100px" height="100px" alt="">
            </div>
            <div class="col-sm-7">
               <?php echo $data['resume']; ?>
            </div>
            <div class="col-sm-2">
               <button> <a href="article.php?id=<?php echo $data['id']; ?>"> Lire la suite...</a></button>
            </div>
            </div>
            <?php
                   } ?>
         </div>

      </body>
   </html>
