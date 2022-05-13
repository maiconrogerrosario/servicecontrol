<?php $v->layout("_theme"); ?>

<section class="features">
    <div class="container">
        <br /><br />
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line2"></div>
                <h1>Suporte técnico ao cliente</h1>
                <p>Tenha um atendimento 24hs para qualquer problema com o seu website</p>
            </div>
        </div>
        <div class="row features-block" style="padding-top: 0px;">
            <div class="col-lg-12 features-text wow fadeInLeft-" style="padding-top: 0px; margin-top: 0px;">



<small><b style="font-size: 2em;">POR EMAIL</b></small>
<br /><br />
<p>
Mande um email para <a href="mailto:contato@3wsoftware.com.br" title="Email para o suporte técnica da Tempbox">contato@3wsoftware.com.br</a>
</p>
<br />

<small><b style="font-size: 2em;">POR FAQ</b></small>
<br /><br />
<p>
Talvez a sua dúvida tenha resposta em nosso <a href="faq.html" title="Tempbox FAQ">FAQ</a>
</p>
<br />

<small><b style="font-size: 2em;">POR WHATSAPP <img src="shared/img/whatsapp.png"/></b></small>
<br /><br />
<p>
Chame no <a href="https://api.whatsapp.com/send?554399480907&text=Olá, gostaria de saber mais sobre a solução de vocês" target="_blank"><span class="navy">Whatsapp</span>
</a>
</p>
<br />

<small><b style="font-size: 2em;">POR CHAMADO</b></small>
<br /><br />
<p>
    Envie uma mensagem pelo formulário abaixo
</p>
<section id="signup" class="section signup">
    <div class="container">
        <div class="row m-b-lg cmc-contato-formulario">
            <div class="col-lg-2"><br /></div>
            <div class="col-lg-8">
                <p><br /><br /></p>
                <form action="<?= url("/suporte"); ?>"  method="post">
                    <div class="form-group cmc-form-group-contato-nome">
                        <label>Qual é o seu SITE?</label>
                        <input type="hidden" name="action" value="create"/>
                        <input type="text" placeholder="www.seusite.com.br" name="subject"/>

                        <p class="alert alert-danger cmc-contato-nome-feedback-required cmc-oculto">Informe o seu site!</p>
                    </div>
                    <div class="form-group cmc-form-group-cliente-projeto">
                        <label>Como podemos ajudar?</label>
                        <textarea class="form-control input-lg cmc-required cmc-contato-mensagem" name="message" rows="5"></textarea>

                        <p class="alert alert-danger cmc-contato-mensagem-feedback-required cmc-oculto">Informe como podemos ajudá-lo!</p>
                    </div>
                    <div><br />

                        <button class="btn btn-sm btn-primary btn-lg float-left m-t-n-xs " ><strong>Enviar solicitação de suporte</strong></button>

                    </div>
                </form>
            </div>
            <div class="col-lg-2"><br /></div>
        </div>

    </div>
</section>



<br /><br />
<small><b style="font-size: 2em;">PRAZOS</b></small>
<br /><br />
<p>
   Nosso suporte técnico é 24hs! A todo momento um dos nossos atendentes está analisando como podemos ajudá-lo. Reclamações referente a sites fora do ar são sempre urgente! Quanto a problemas nas funcionalidades nós temos o prazo de solução entre 24 e 48hs, dependendo da complexidade. Já melhorias e sugestões serão analisadas pelo nosso time de projetos para futura implementação na plataforma.
</p>





<br /><br /><br /><br />


            </div>
        </div>
    </div>
</section>