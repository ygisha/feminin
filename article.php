<?php include('connection.php');
if (isset($_GET['id'])){
   $update="SELECT 
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
                           ON user.id = articles.id_user
                           WHERE articles.id=".$_GET['id'];
   $res=mysqli_query($link,$update);
      $dataU=mysqli_fetch_array($res);

      if (isset($_POST['btnValider'])){
      $sql= "INSERT INTO commentaires (description,id_articles) VALUES ('".$_POST['commentaire']."', '".$dataU['id']."')";
      $result=mysqli_query($link ,$sql);
      if ($result) {
         $msg='Insertion reussie';
      }else{
         $msg=mysqli_error($link);
      }
   }

   }
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
         
         <div class="container-fluid">
               <div class="row">
                  <?php echo $dataU['description'];  ?>
               </div>
            </div>

            <div class="well well-lg"> 
               <div class="row">   
                  <div class = col-sm-6 offset>
                     <form action="" method="POST" role="form">
                        <div class="form-group">
                           <label for="">Commentaire</label>                   
                           <textarea name="commentaire" class="form-control"  placeholder="Entrer votre Commentaire" rows="10" cols=""> </textarea>
                        </div>
                        
                        <button name="btnValider" type="submit" class="btn btn-primary btn-lg btn-block">Valider</button>
                     </form>
                  </div>
               </div>
            </div>

            <div class="row">
            <table class="table">
               <thead>
                  <tr>
                     <th>description</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $n=1;
                     $list=" SELECT 
                              description
                           FROM commentaires
                           WHERE id_articles = ".$_GET['id'];
                     $res= mysqli_query($link,$list);
                while ($data = mysqli_fetch_array($res)){
                        
                     
                   ?>
                  <tr>
                     <td> <?php echo $n; ?> </td>
                     <td><?php echo $data['description']; ?></td>
                  </tr>
                  <?php $n++;
                   } ?>
               </tbody>
            </table>

         </div>

         </div>

      </body>
   </html>
