<?php 
	session_start();
	if (isset($_REQUEST['login'])) {
		header("Location: /auth/?t=g&r=/");
		exit();
	}
	$user=false;
	if (isset($_SESSION['user'])) $user=$_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="ATHUGA"/>
<meta name="athuga" content="athuga"/>
<meta name="google-translate-customization" content="363ac06abcff6af8-0edf9227c7edd524-g4dfa32834b5b82fa-a"></meta>
<title>ATHUGA</title>
<link href='http://fonts.googleapis.com/css?family=Orbitron:400,500,700' rel='stylesheet' type='text/css'>
<style type="text/css">



<?$bc=$c=explode(' ','#001122 #0055aa #114499 #3399cc #bbddee');?>

.color1 { color: <?=array_pop($c); ?>; }
.color2 { color: <?=array_pop($c); ?>; }
.color3 { color: <?=array_pop($c); ?>; }
.color4 { color: <?=array_pop($c); ?>; }
.color5 { color: <?=array_pop($c); ?>; }

.bgColor1 { background-color: <?=array_pop($bc);?>; }
.bgColor2 { background-color: <?=array_pop($bc);?>; }
.bgColor3 { background-color: <?=array_pop($bc);?>; }
.bgColor4 { background-color: <?=array_pop($bc);?>; }
.bgColor5 { background-color: <?=array_pop($bc);?>; }

@import url(animate.min.css) screen;
body { 
	font-family: 'Orbitron';
background: #fefefe; color: #333; }
.div {
	background: #002200;
	margin:1em; padding:1em;
	-webkit-box-shadow: inset 1px 1px 2px 1px rgba(11, 255, 11, .5);
	box-shadow: inset 1px 1px 2px 1px rgba(11, 255, 11, .5);
}

aside { position: absolute; right: 0; }

blockquote {
	margin: 0.9em;
	padding: 0.9em;
	line-height: 2em;
	-webkit-animation-duration: 1s;
	-webkit-animation-delay: 0s;
	-webkit-animation-iteration-count: 1;
}
h1 {
	margin: auto;
	border-bottom: 1px dashed #333;
	font-family: 'Orbitron';
	font-size: 4em;
	text-align:center;
	width: 920px;
}
p {
	font-size: 1.5em;
}

.pad { padding: 1em; }
.mar { margin: 1em; }

</style>
</head>
<body class='bgColor1 color4'>
<aside>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</aside>

<div class="bgColor2 pad mar round">
<h1 class="color5">ᓇ(: ATHUGA :)ᓄ</h1>
<div class="bgColor1 color3 pad mar">
<p>A drop in comment widget.</p>
</div>
<div class="pad bgColor5 color1 mar round">
<details class="pad">
<summary class="pad">
<i>ˈaːthʏːɣa:</i>
</summary>
1. (Icelandic) To look, to check; to consider; to notice, observe; to investigate 
2. A kick ass drop in comment system.
</details>
</div>


<blockquote cite="http://en.wiktionary.org/wiki/athuga" class="bounchInLeft bgColor1 color3">
All of our social networking system are comment driven.</br>
Think about comments.   Athuga: To look, check and consider.<br/>Then comment.<br/>
Get comments.   Get Athuga.
</blockquote>
<div class="mar pad bgColor1 color3">
	<h3>Coming in 2013, add comments to your site.   Simple.   Free.  Better.</h3>
	<h3>Take control.</h3>
	<? echo $user?"<h3>Logged in as: {$user['displayName']}</h3>":""; ?>
	<p>Your comment?<p>
	<script src="zepto.min.js"></script>
	<script src="athuga.js.php?<?=time()?>"></script>
</div>
</div>
</body>
</html>
