<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<style>
	html{
		font-family: "Century Schoolbook L";
	}

	form{
		display: table;
	}

	form div {
		display: table-row;
	}

	form label , form input {
		display: table-cell;

	}

</style>


<form action="">
	<div>
			<label for="name">name</label>
			<input type="text" name="name">
	</div>
	
	<div>
		<label for="surname">surname</label>
		<input type="text" name="surname">
	</div>
	
	<div>
		<label for="age">age</label>
		<input type="text" name="age">
	</div>
</form>



</body>
</html>