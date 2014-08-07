<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/html">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-language" content="en" />
	<meta http-equiv="X-UA-Compatible" content="IE=8; IE=9" />
	<title><?=(isset($arrParams['title']) ? "{$arrParams['title']} | " : "")?><?=$arrParams['siteTitle']?></title>
	<meta name="author" content="Richard Hoppes" />
	<meta name="copyright" content="Richard Hoppes" />
	<meta name="robots" content="index,follow" />
	<link  href="<?=\yarbles\framework\helper\PathHelper::createCssPath('reset.css', true)?>" rel="stylesheet" type="text/css" />
	<link  href="<?=\yarbles\framework\helper\PathHelper::createCssPath('screen.css', true)?>" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="main">

	<div id="header">
		<h1><?=$arrParams['siteName']?></h1>
	</div>

