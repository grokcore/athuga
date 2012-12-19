<?php header("Content-type: text/css"); ?>
<?php $id=$_GET['id']; function __(){echo '#athuga_'.$_GET['id'];} ?>
<?=__();?> { display: block; }
<?=__();?> textarea { width: 640px; height: 50px; display: block; }
<?=__();?> a,

<?=__();?> .r { 
	font-family: arial;
	padding: 0.4em; width: 50px; 
	cursor: pointer;
	-webkit-box-shadow:  2px 2px 2px 2px #000000;
        box-shadow:  2px 2px 2px 2px #000000;

background: #f2f6f8; /* Old browsers */
background: -moz-linear-gradient(top,  #f2f6f8 0%, #d8e1e7 50%, #b5c6d0 51%, #e0eff9 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f2f6f8), color-stop(50%,#d8e1e7), color-stop(51%,#b5c6d0), color-stop(100%,#e0eff9)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #f2f6f8 0%,#d8e1e7 50%,#b5c6d0 51%,#e0eff9 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #f2f6f8 0%,#d8e1e7 50%,#b5c6d0 51%,#e0eff9 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #f2f6f8 0%,#d8e1e7 50%,#b5c6d0 51%,#e0eff9 100%); /* IE10+ */
background: linear-gradient(to bottom,  #f2f6f8 0%,#d8e1e7 50%,#b5c6d0 51%,#e0eff9 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9',GradientType=0 ); /* IE6-9 */


}
<?=__();?> .r:hover { 
	-webkit-box-shadow:  2px 2px 2px 2px #000000;
        box-shadow:  2px 2px 2px 2px #000000;


background: #cfe7fa; /* Old browsers */
background: -moz-linear-gradient(top,  #cfe7fa 0%, #6393c1 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#cfe7fa), color-stop(100%,#6393c1)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #cfe7fa 0%,#6393c1 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #cfe7fa 0%,#6393c1 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #cfe7fa 0%,#6393c1 100%); /* IE10+ */
background: linear-gradient(to bottom,  #cfe7fa 0%,#6393c1 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cfe7fa', endColorstr='#6393c1',GradientType=0 ); /* IE6-9 */


}

#a<?=$id?>close { 
	font-weight: bold;
	font-family: sans-serif;
	background: #fff;
	color: #000;
	position: absolute;
	right: 0;
	cursor: pointer;
}
.a<?=$id?>modal { 
margin:0;padding:0;
background: #11e000; 
color: #111; 
width: 512px; 
top: 250px;
box-shadow:inset 0px 0px 9px rgba(0,255,0,.5);
-webkit-box-shadow:inset 0px 0px 9px rgba(0,255,0,.5);
-moz-box-shadow:inset 0px 0px 9px rgba(0,255,0,.5);
}
.a<?=$id?>inner {
	margin: 20px;
	padding: 20px;
}
.a<?=$id?>inner a {
	padding: 10px;
	margin: 10px;
}


<?=__();?> .c { padding: 0.4em; display: list-item; list-style: none; }

