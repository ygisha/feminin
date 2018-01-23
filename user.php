
<?php include('connection.php');
	$msg="";
	if (isset($_POST['btnValider'])){
		$sql= "INSERT INTO user (email,mdp,nom,prenom) VALUES ('".$_POST['email']."','".$_POST['password']."','".$_POST['nom']."','".$_POST['prenom']."')";
		$result=mysqli_query($link,$sql);
		if ($result) {
			$msg='Insertion reussie';
		}else{
			$msg=mysqli_error($link);
		}
	}

	if (isset($_GET['id'])){
	$update="SELECT * FROM user WHERE id=".$_GET['id'];
	$res=mysqli_query($link,$update);
		$dataU=mysqli_fetch_array($res);
	}

	if (isset($_GET['sup'])){
		$delete="DELETE FROM user WHERE id=".$_GET['sup'];
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

					<form action="" method="POST" role="form">
						<legend>Formulaire d'inscription</legend>
						<span> <?php echo $msg; ?> </span>
					
						<div class="form-group">
							<label for="">Email</label>
							<input name="email" type="text" class="form-control" id="" placeholder="Entrer votre email" value="<?php if (isset($_GET['id'])) echo $dataU['email']; ?>">
						</div>

						<div class="form-group">
							<label for="">Mot de passe</label>
							<input name="password" type="password" class="form-control" id="" placeholder="Entrer un mot de passe" value="<?php if (isset($_GET['id'])) echo $dataU['password']; ?>">
						</div> 

						<div class="form-group">
							<label for="">Nom</label>
							<input name="nom" type="text" class="form-control" id="" placeholder="Entrer votre nom" value="<?php if (isset($_GET['id'])) echo $dataU['nom']; ?>">
						</div>
						<div class="form-group">
							<label for="">Prenom</label>
							<input name="prenom" type="text" class="form-control" id="" placeholder="Entrer votre prenom" value="<?php if (isset($_GET['id'])) echo $dataU['prenom']; ?>">
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
							<th>Email </th>
							<th>Nom</th>
							<th>Prenom</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$n=1;
							$list=" SELECT * FROM user";
							$res= mysqli_query($link,$list);
	while ($data = mysqli_fetch_array($res)){
								
							
						 ?>
						<tr>
							<td> <?php echo $n; ?> </td>
							<td><?php echo $data['email']; ?></td>
							<td><?php echo $data['nom']; ?></td>
							<td><?php echo $data['prenom']; ?></td>
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