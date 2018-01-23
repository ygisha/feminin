<?php include('connection.php');
	$msg="";
	if (isset($_POST['btnValider'])){
		/*echo '<pre>';
		print_r ($_FILES['image']);die();*/
		if (move_uploaded_file($_FILES['image']['tmp_name'], 'upload/'.$_FILES['image']['name'])) {
			$sql= "INSERT INTO articles
			 (titre,resume,image,description,id_categories,id_user)
			 VALUES ('".$_POST['titre']."',
					 '".$_POST['resume']."',
			 		  '".$_FILES['image']['name']."',
			 		  '".$_POST['description']."',
			 		  '".$_POST['categories']."',
			 		  '".$_POST['user']."')";
			$result=mysqli_query($link	,$sql);
			if ($result) {
				$msg='Insertion reussie';
			}else{
				$msg=mysqli_error($link);
			}
		}

	}
	if (isset($_GET['id'])){
	$update="SELECT * FROM articles WHERE id=".$_GET['id'];
	$res=mysqli_query($link,$update);
		$dataU=mysqli_fetch_array($res);
	}

	if (isset($_GET['sup'])){
		$delete="DELETE FROM articles WHERE id=".$_GET['sup'];
		$res=mysqli_query($link,$delete);
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
		<div class="container">

			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">

					<form action="" method="POST" role="form" enctype="multipart/form-data">
						<legend>Formulaire Des Articles </legend>
						<span> <?php echo $msg; ?> </span>
					
						<div class="form-group">
							<label for="">Titre</label>
							<input name="titre" type="text" class="form-control" id="" placeholder="Entrer le titre" value="<?php if (isset($_GET['id'])) echo $dataU['titre']; ?>">
						</div>

						<div class="form-group">
							<label for="">resume de l'article</label>
							<input type="text" name="resume" class="form-control" value="<?php if (isset($_GET['id'])) echo $dataU['resume']; ?>">
						</div>
								
						<div class="form-group">
							<label for="">description</label>
							<textarea name="description" class="form-control" placeholder="description" rows="10" value="<?php if (isset($_GET['id'])) echo $dataU['description']; ?>"> </textarea>
						</div>
					
						<div class="form-group">
							<label for="">image</label>
							<input name="image" type="file" class="form-control" id="" placeholder="image" value="<?php if (isset($_GET['id'])) echo $dataU['image']; ?>">
						</div>
						<div class="form-group">
							<label for="">categories</label>
							<select name="categories" type="text" class="form-control" id="" placeholder="iEntrez la categorie" value="<?php if (isset($_GET['id'])) echo $dataU['categories']; ?>">
						
					<?php
					//recupere toutes les categories dans la bd
					$sqlcategorie="SELECT * FROM categories";
					//execute la requete et on la stock dans $repcategorie
					$repcategorie=mysqli_query($link,$sqlcategorie);
					//mysqli_fetch_array = permet de tran sformer le resultat $repcategorie en variable de type tableau $datacat
					// la boucle while nous permet de parcourir le tableau $datacat et de recuperer les valeurs de chaques elements du tableau $datacat
					while ($datacat=mysqli_fetch_array($repcategorie)) {
						?>
						<option value="<?php echo $datacat['id'];?>">
						<?php echo $datacat['libelle'];?>
							
						</option>

						<?php
					}
					?>
								
							</select>
						</div>

						<div class="form-group">
							<label for="">user</label>
							<select name="user" type="text" class="form-control" id="" placeholder="iEntrez la categorie">
						
					<?php
					//recupere toutes les categories dans la bd
					$sqlcategorie="SELECT * FROM user";
					//execute la requete et on la stock dans $repcategorie
					$repcategorie=mysqli_query($link,$sqlcategorie);
					//mysqli_fetch_array = permet de tran sformer le resultat $repcategorie en variable de type tableau $datacat
					// la boucle while nous permet de parcourir le tableau $datacat et de recuperer les valeurs de chaques elements du tableau $datacat
					while ($datacat=mysqli_fetch_array($repcategorie)) {
						?>
						<option value="<?php echo $datacat['id'];?>">
						<?php echo $datacat['nom'].'-'.$datacat['prenom'];?>
							
						</option>

						<?php
					}
					?>
								
							</select>
						</div>

						<button name="btnValider" type="submit" class="btn btn-primary btn-lg btn-block">Valider</button>
					</form>
				</div>
				<div class="col-md-2"></div>
			</div>
<br>
			<div class="row">
				<table class="table">
					<thead>
						<tr>
							<th>Numero</th>
							<th>Titre</th>
							<th>Resumé de l'article</th>
							<th>Image</th>
							<th>categorie</th>
							<th>user</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
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
						<tr>
							<td> <?php echo $n; ?> </td>
							<td><?php echo $data['titre']; ?></td>
							<td><?php echo $data['resume']; ?></td>
							<td><img src="upload/<?php echo $data['image'];  ?>" width="30px" height="30px" alt=""></td>
							<td><?php echo $data['libelle']; ?></td>
							<td><?php echo $data['nom']." ".$data['prenom']; ?></td>
							<td>
							<a href="?id=<?php echo $data['id']; ?>"><button type="button" class="btn btn-primary">Modifier</button></a>

							<a href="?sup=<?php echo $data['id']; ?>"><button type="button" class="btn btn-danger">Supprimer</button></a>
							</td>
						</tr>
						<?php $n++;
						 } ?>
					</tbody>
				</table>

			</div>
			

		</div>
		

		<!-- jQuery -->
		<script src=""></script>
		<!-- Bootstrap JavaScript -->
		<script src=""></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
	</body>
</html>



