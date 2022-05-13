<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
        <meta name="mit" content="2020-12-29T11:38:21-03:00+169293">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?= $head; ?>
	
	<!-- Bootstrap core CSS -->
        <link href="shared/css/bootstrap.min.css" rel="stylesheet">

        <!-- Animation CSS -->
        <link href="shared/css/animate.min.css" rel="stylesheet">

        <link href="shared/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="shared/fonts/flaticon/font/flaticon.css" rel="stylesheet">
		



        <!-- Custom styles for this template -->
        <link href="shared/css/style.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="<?= theme("/assets/images/favicon.png"); ?>"/>
    <link rel="stylesheet" href="<?= theme("/assets/style.css"); ?>"/>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>


<header class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="" href="index.html">
                        <img src="shared/img/3wlogo3.png" /></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="active" title="Home" href="<?= url(); ?>">Home</a></li>
						<!-- <li><a class="" title="Como Funciona" href="<?= url("/sobre"); ?>">Como Funciona</a></li>-->
                        <!--<li><a class="" title="Preços" href="<?= url("/preços"); ?>">Preços</a></li>-->
                        <!--<li><a class="" title="Suporte" href="<?= url("/suporte"); ?>">Suporte</a></li>-->
						<li><a class="" title="WorkControl" href="<?= url("/work-entrar"); ?>">Login</a></li>
                        <li><a class="" title="Contato" href="<?= url("/contato"); ?>">Contato</a></li>
						<!--<li><a class="" title="Entrar" href="<?= url("/entrar"); ?>">Entrar</a></li>-->
			
                        <!--<li><a class="page-scroll" href="/contato">SOLICITE SEU SITE</a></li>-->
                        <li><a class="" href="https://bit.ly/395I680" target="_blank"><span class="navy"><img src="shared/img/whatsapp.png"/> Chame no whatsapp</span></a></li>
                    </ul>
                </div>
            </div>
        </nav>
</header>



<!--CONTENT-->
<main class="main_content">
    <?= $v->section("content"); ?>
</main>


<!--FOOTER-->
<footer class="main_footer">
    <div class="container content">
        <section class="main_footer_content">
            <article class="main_footer_content_item">
                <h2>Sobre:</h2>
                <p>Somos uma empresa voltada ao desenvolvimento de sistemas de alta tecnologia, apresentando soluções que reduzem custos e trazem retorno..</p>
                <a title="Termos de uso" href="<?= url("/termos"); ?>">Termos de uso</a>
            </article>

            <article class="main_footer_content_item">
                <h2>Mais:</h2>
                <a class="link transition radius" title="Home" href="<?= url(); ?>">Home</a>
                <a class="link transition radius" title="Login" href="<?= url("/work-entrar"); ?>">Login</a>
				<a class="link transition radius" title="Registar" href="<?= url("/work-cadastrar"); ?>">Registrar</a>
                <a class="link transition radius" title="Contato" href="<?= url("/contato"); ?>">Contato</a>
				
            </article>

            <article class="main_footer_content_item">
                <h2>Contato:</h2>
                <p class="icon-phone"><b>Telefone:</b><br> (43) 99163-3050</p>
                <p class="icon-envelope"><b>Email:</b><br> contato@3wstecnologia.com.br</p>
                <p class="icon-map-marker"><b>Endereço:</b><br>  Londrina/PR</p>
            </article>

            <article class="main_footer_content_item social">
                <h2>Social:</h2>
                <a target="_blank" class="icon-instagram"
                   href="https://www.instagram.com/<?= CONF_SOCIAL_INSTAGRAM_PAGE; ?>" title="3WSTECNOLOGIA no Instagram">3wstecnologia.com.br</a>
                <a target="_blank" class="icon-whatsapp" href="https://api.whatsapp.com/send?phone=5543991633050&text=Ol%C3%A1%20Gostaria%20de%20receber%20mais%20informa%C3%A7%C3%B5es%20sobre%20suas%20solu%C3%A7%C3%B5es."
                   title="3WSTECNOLOGIA no Whatsapp">Entrar em Contato Pelo Whatsapp</a>
            </article>
        </section>
    </div>
</footer>



<script async src="https://www.googletagmanager.com/gtag/js?id=UA-53658515-18"></script>
<script src="<?= theme("/assets/scripts.js"); ?>">
</script><?= $v->section("scripts"); ?>
<script src="shared/js/pace.min.js"></script>
<script src="shared/js/bootstrap.min.js"></script>
<script src="shared/js/classie.js"></script>
<script src="shared/js/cbpAnimatedHeader.js"></script>
<script src="shared/js/wow.min.js"></script>
<script src="shared/js/inspinia.js"></script>
<script src="shared/js/bootstrap.min.js"></script>


           
</body>
</html>

