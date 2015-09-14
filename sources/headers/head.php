<!DOCTYPE html>
<html>
<head>

	<title>%site_name% - %page_name%</title>

	%func::Tpl::addMeta(charset, utf-8)%

	<!-- System resources -->

	%func::Tpl::includeSystem()%

	<!-- Styles -->

	%func::Tpl::addStyle(style.css, players.css)%

	<!-- Scripts -->

	%func::Tpl::addScript(script.js, require.js, ace.js)%
</head>
<body>