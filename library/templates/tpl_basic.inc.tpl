<!DOCTYPE html>
<html>
<head>
<base href="<?=BASE_URL?>" />
<title><?=$title;?></title>
<meta name="copyright" content="Copyright (c) 2017-<?=date("Y")?> by ONAFT">
<meta name="author" content="Dets Dmitry">
<meta name="generator" content="DeCo IT">
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="<?=$keywords;?>">
<meta name="description" content="<?=$description;?>">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<?foreach($styles as $style):?>
<link rel="stylesheet" type="text/css" media="screen" href="/<?=DIR_CSS.$style?>.css" />
<?endforeach;?>
</head>
<body>
<div class="wrapper">
<div class="header">
<img src="/images/logo.png" border="0" width="150" height="150" align="left" alt="">
<h1 style="font-family: georgia;font-size:35px;color:#FFDAB9;font-weight:bold;text-shadow:#aaa 3px 3px 3px;text-align:center;line-height:150px"><strong>"Горбушка"-пекарня для всіх</strong></h1>
</div>
<?if(isset($nav)):?>
<?=$nav?>
<?endif;?>
<?foreach($scripts as $script):?>
<script type="text/javascript" src="/<?=DIR_JS.$script?>.js"></script>
<?endforeach;?>
<div class="container">
<?=$content?>
</div>
<div class="footer">Web-master</a></div>
</div>
</body>
</html>
