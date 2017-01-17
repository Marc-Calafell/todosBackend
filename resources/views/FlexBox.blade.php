<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>

<style>

	header , footer{
		background-color: indianred;
		padding: 5px;
		margin: 5px;
		display: block;
		min-height: 100px;
		border: 1px solid #eebb55;
		border-radius: 7pt;

		text-align: center;
	}

	/*header{*/
	/*background-color: indianred;*/
	/*padding: 10px;*/
	/*margin: 10px;*/
	/*}*/

	.article{
		margin: 4px;
		padding: 5px;
		border: 1px solid #cccc33;
		border-radius: 7pt;
		background: #dddd88;
		-webkit-flex: 3 1 60%;
		flex: 3 1 60%;
		-webkit-order: 2;
		order: 2;
	}

	.container{
		min-height: 800px;
		margin: 0px;
		padding: 0px;
		display: -webkit-flex;
		display:         flex;
		-webkit-flex-flow: row;
		flex-flow: row;

	}

	.container > nav{
		margin: 4px;
		padding: 5px;
		border: 1px solid #8888bb;
		border-radius: 7pt;
		background: #ccccff;
		-webkit-flex: 1 6 20%;
		flex: 1 6 20%;
		-webkit-order: 1;
		order: 1;
	}



</style>
<body>

<header>
	<h1>Semple Flexbox example</h1>
</header>

<div class="container">

	<nav>
		<ul>
			<li>Link1</li>
			<li>Link2</li>
			<li>Link3</li>
			<li>Link4</li>
			<li>Link5</li>

		</ul>
	</nav>

	<div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A amet debitis deserunt ea modi natus nihil nostrum obcaecati porro totam! Ab assumenda ea esse in minus natus odit officiis quos?</div>
	<div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A amet debitis deserunt ea modi natus nihil nostrum obcaecati porro totam! Ab assumenda ea esse in minus natus odit officiis quos?</div>
	<div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A amet debitis deserunt ea modi natus nihil nostrum obcaecati porro totam! Ab assumenda ea esse in minus natus odit officiis quos?</div>
	<div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci amet aut expedita impedit iure laboriosam magnam molestias quasi voluptatibus?</div>
	<div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci amet aut expedita impedit iure laboriosam magnam molestias quasi voluptatibus?</div>
	<div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci amet aut expedita impedit iure laboriosam magnam molestias quasi voluptatibus?</div>
	<div class="article">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci amet aut expedita impedit iure laboriosam magnam molestias quasi voluptatibus?</div>


</div>

<footer>
	Footer
</footer>

</body>
</html>