<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=8; IE=9" />
		<title>OOPS!  Something broke!</title>
		<meta name="robots" content="index,follow" />
		<style>
			/* This is the default error handler, hence the inline styles.  Might be good to externalize this at some point. */
			blockquote, body, h1, h2, h3, h4, h5, p, dl, form {
				margin: 0;
				padding: 0;
			}

			body {
				font-family: Helvetica, sans-serif;
				font-size: 9pt;
				color: #000000;
				background-color: #FFF;
			}

			div#page {
				margin:  10px;
			}
		</style>

	</head>
	<body>
		<div id="page">
			<h1><?=$arrParams['title']?></h1>
			<?=$arrParams['message']?>
			<pre>
<?
print_r($arrParams['exception']);
?>
			</pre>
		</div>
	</body>
</html>