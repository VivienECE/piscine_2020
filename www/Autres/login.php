<!DOCTYPE html>
<html>
	<head>
		<title>ECEebay</title>
		<meta charset="utf-8">
	</head>
	<body>
		<form method="post">  <!-- Conserver les <inputs..> -->
			<table>
				<tr>
					<td>Nom d'utilisateur ou Email:</td>
					<td><input type="text" name="pseudo" pattern=".{4,50}" maxlength='50' required></td>
				</tr>
				<tr>
					<td>Mot de passe:</td>
					<td><input type="password" name="motdepasse" pattern=".{10,30}" title="10 à 30 caractères" maxlength='30' required></td>
				</tr>
			</table>
		</form>
	</body>
</html>