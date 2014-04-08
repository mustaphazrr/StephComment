<meta charset="utf-8" />
<style >
	div{
		border:2px solid #a1a1a1;
		padding:10px 20px;
		background:#dddddd;
		width:760px;
		border-radius:8px 8px 8px 8px;
	}
	h2{
		border:2px dashed #a1a1a1;
		border:2px dashed #a1a1a1;
		padding:10px 20px;
		width:760px;
	}
</style>
<?php
			class Commentaire{
			
				public function __construct(){
					mysql_connect("localhost","root","") or die ("Erreur de la cnx avec le serveur !");
					mysql_select_db("commentaires") or die ("Erreur de la selection de la BDD !");
				}
				
				public function Creer(){
					if (isset($_POST["submit"])){
						$test=false;
						if (empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["commentaire"])){
							$msg="<font color='red'>Tous les champs sont obligatoires</font>";
							$test=true;
						}
						if($test==false){
							mysql_query("INSERT INTO commentaire VALUES (NULL, '".$_POST["commentaire"]."', '".date("Y:m:d")."', '".$_POST["nom"]."', '".$_POST["prenom"]."', '".$_SERVER["PHP_SELF"]."')") or die ("Erreur d'insertion !");
							$_POST["nom"]="";$_POST["prenom"]="";$_POST["commentaire"]="";
						}
					}
					?>
					<h2>Commentaires</h2>
					<form method="POST">
						<table>
							<tr>
								<td>Nom</td>
								<td>Prénom</td>
							</tr>
							<tr>
								<td><input type="text" name="nom" size="60" value="<?php if (isset($_POST["nom"])) echo $_POST["nom"]; ?>" /></td>
								<td><input type="text" name="prenom" size="60" value="<?php if(isset($_POST["prenom"])) echo $_POST["prenom"]; ?>" /></td>
							</tr>
							<tr>
								<td>Commentaire</td>
							</tr>
							<tr>
								<td colspan="2"><textarea name="commentaire" cols="97" rows="4"><?php if(isset($_POST["commentaire"])) echo $_POST["commentaire"]; ?></textarea></td>
							</tr>
							<tr>
								<td align="left"><?php   if(isset($msg)) echo "<br />".$msg; ?></td>
								<td align="right"><input type="submit" name="submit" value="Envoyer" /></td>
							</tr>
						</table>
					</form>
					<?php
				}
				
				public function Afficher(){
					$resultats=mysql_query("SELECT contenu_cmt,date_cmt, nom_user,prenom_user FROM commentaire WHERE url_page='".$_SERVER["PHP_SELF"]."'") or die ("Erreur de la selection des donnees !");
					while($valeur=mysql_fetch_array($resultats)){
						echo "<b>".$valeur["nom_user"]." ".$valeur["prenom_user"]."</b> : <i>".$valeur["date_cmt"]."</i><br />";
						echo "<div>".$valeur["contenu_cmt"]."</div><br />";
					}
				}
			}
?>