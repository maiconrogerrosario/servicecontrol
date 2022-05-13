<?php $v->layout("_theme"); ?>

<section id="timeline" class="timeline gray-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line2"><br /></div>
                <h1>Como funciona</h1>
                <p>Nós criamos o website, baseado em nossa plataforma, e você foca totalmente em criar apenas o conteúdo</p>
            </div>
        </div>
        <div class="row features-block">

            <div class="col-lg-12">
                <div id="vertical-timeline" class="vertical-container light-timeline center-orientation">

                    <div class="">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-exclamation-circle"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Ideia</h2>
                            <p>Você decide ter um website!
                            </p>

                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-mail-forward"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Solicitação do Projeto</h2>
                            <p>Você preenche o formulário com seus dados! Envie e aí deixe conosco.<br />
                            </p>
                            <a href="<?= url("/contato"); ?>" class="btn btn-xs btn-primary">Entrar em Contato</a>
                            <span class="vertical-date"> Hoje <br /> <small><!--Dec 24--></small> </span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-comments-o"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Briefing</h2>
                            <p>Após aceite da proposta e pagamento da 1a mensalidade, fazemos o briefing com você para definir todos os detalhes (troca de cores, mudanças no layout, editar algum texto ou seção, etc).
                                <br />
                            </p>
                            <!--<a href="#" class="btn btn-xs btn-primary"> More info</a>-->
                            <span class="vertical-date"> em até 10 dias <br /> <small><!--Dec 26--></small> </span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-legal"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Confirmação</h2>
                            <p>Você aprova o projeto.</p>
                            <!--<a href="#" class="btn btn-xs btn-primary"> More info</a>-->
                            <span class="vertical-date"> seu prazo <br /> <small><!--Jan 02--></small> </span>
                        </div>
                    </div>

                    <div class="vertical-timeline-block">
                        <div class="vertical-timeline-icon navy-bg">
                            <i class="fa fa-thumbs-o-up"></i>
                        </div>

                        <div class="vertical-timeline-content">
                            <h2>Publicação</h2>
                            <p>Criamos o seu site, configuramos tudo e publicamos. E liberamos seu acesso ao sistema para gestão do conteúdo
                                <br />
                            </p>
                            <!--<a href="#" class="btn btn-xs btn-primary"> More info</a>-->
                            <span class="vertical-date"> 30 dias úteis depois <br /> <small><!--Dec 26--></small> </span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-12 text-center">
                <a href="<?= url("/faq"); ?>" class="btn btn-xs btn-primary"> Dúvidas? Veja as perguntas frequentes!</a>
            </div>

        </div>
    </div>

</section>

