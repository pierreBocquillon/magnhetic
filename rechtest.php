<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="recherche.php" method="get">
    <input type="text" placeholder="recherche" name="rec">
    <input type="checkbox" name="dispo" value="1">Dispo
    <br>
    <input type="radio" name="filter" value="personne" checked="checked"/>personne<br />
    <input type="radio" name="filter" value="hobbie" />hobbie<br />
    <input type="radio" name="filter" value="competence" />competence<br />
    <input type="submit">
</form>

</body>
</html>
