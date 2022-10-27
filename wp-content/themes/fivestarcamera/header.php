<?php
/**
 * @package fivestarcamera
 */

?><!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width">
<meta name="format-detection" content="telephone=no">

<title>Five Star Camera | 中古カメラ・フィルムカメラを中心に取り揃えるファイブスターカメラ</title>

<link href="<?php echo esc_url(home_url()); ?>/common/css/layout.css?ver=20200420" rel="stylesheet" media="screen and (min-width:768px),print">
<link href="<?php echo esc_url(home_url()); ?>/common/css/contents.css?ver=20200420" rel="stylesheet" media="screen and (min-width:768px),print">
<link href="<?php echo esc_url(home_url()); ?>/common/css/layout_sp.css?ver=20200420" rel="stylesheet" media="screen and (max-width:767px)">
<link href="<?php echo esc_url(home_url()); ?>/common/css/contents_sp.css?ver=20200420" rel="stylesheet" media="screen and (max-width:767px)">
<link href="<?php echo esc_url(home_url()); ?>/common/css/prettyPhoto.css" rel="stylesheet" media="screen,print">
<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet'>
<link rel="dns-prefetch" href="https://fivestarcamera.net">
<link rel="preconnect" href="https://fivestarcamera.net">

<!--[if lt IE 9]>
	<script src="<?php echo esc_url(home_url()); ?>/common/js/html5.js"></script>
<![endif]-->


<meta name="copyright" content="Copyright &copy; Five Star Camera All Rights Reserved.">
<meta name="keywords" content="">
<meta name="description" content="">

<?php wp_head(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-67299774-1', 'auto');
  ga('send', 'pageview');

</script>

</head>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.7&appId=536686003030531";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="container" class="<?php if (function_exists('get_my_container_class_name')) {echo get_my_container_class_name();} ?>">
	<header id="header">
		<div class="box">
			<div class="logo"><h1><a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url(home_url()); ?>/common/images/logo_five-star-camera.png" alt="Five Star Camera（ファイブスターカメラ）"></a></h1></div>
			<div id="uppernav">
				<p class="catch">中古カメラ・フィルムカメラを中心に取り揃えるファイブスターカメラ</p>
				<ul>
					<li class="newm"><a href="<?php echo esc_url(home_url()); ?>/myaccount">新規会員登録</a></li>
					<li class="memb"><a href="<?php echo esc_url(home_url()); ?>/myaccount">マイページ・ログイン</a></li>
				</ul>
			</div>
			<div id="subnav">
				<div class="freedial"><img src="<?php echo esc_url(home_url()); ?>/common/images/freedial.gif" width="170" height="19" alt="フリーダイヤル 0120-027-740"><span>営業時間 10:00~20:00</span></div>
				<div class="btn-contact"><a href="<?php echo esc_url(home_url()); ?>/contact">メールでの<br>お問い合わせ</a></div>
				<ul>
					<li class="refi"><a href="<?php echo esc_url(home_url()); ?>/refine"><span>絞り込み</span></a></li>
					<li class="favo"><a href="<?php echo esc_url(home_url()); ?>/favorite"><span>お気に入り</span></a></li>
					<li class="cart"><a href="<?php echo esc_url(home_url()); ?>/cart"><span>カート</span></a></li>
				</ul>
			</div>
			<div class="sptel">
				<img src="<?php echo esc_url(home_url()); ?>/common/images/sptel.gif" alt="0120-027-740 営業時間 10:00~20:00">
			</div>
		</div>
		<nav id="gnav">
			<div class="box">
				<ul>
					<li class="home"><a href="<?php echo esc_url(home_url()); ?>">TOP</a></li>
					<li class="abou"><a href="<?php echo esc_url(home_url()); ?>/about">当店について</a></li>
					<li class="guid"><a href="<?php echo esc_url(home_url()); ?>/guide">ショッピングガイド</a></li>
					<li class="purc"><a href="<?php echo esc_url(home_url()); ?>/purchase">買取サービス</a></li>
					<li class="voic"><a href="<?php echo esc_url(home_url()); ?>/voice">お客様の声</a></li>
					<!-- <li class="spcl"><a href="<?php echo esc_url(home_url()); ?>/special">特集・コラム</a></li> -->
					<li class="spcl"><a href="https://fivestarcamera.net/column">特集・コラム</a></li>
				</ul>
			</div>
		</nav>
		<div id="spnav"><span></span></div>
	</header>
