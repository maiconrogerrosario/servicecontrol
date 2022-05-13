<?php $v->layout("_theme"); ?>

<section  class="gray-section signup">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line2"><br /></div>
                <h1>Deixe sua mensagem sobre o seu projeto</h1>
                <p>Informe seus dados iniciais, iremos entrar em contato para publicar o seu site</p>
            </div>
        </div>
        <div class="row m-b-lg cmc-contato-formulario">
            <div class="col-lg-2"><br /></div>
            <div class="col-lg-8">
                <p>Preencha seus dados e clique em enviar</p>
                <form action="<?= url("/solitação"); ?>"  method="post">

                    <div class="form-group cmc-form-group-contato-nome">

                        <label>Nome</label>

                        <input type="hidden" name="action" value="create"/>
                        <input type="text" name="subject" placeholder="Seu nome" class="form-control input-lg cmc-contato-nome cmc-required"/>
                        
                    </div>
                    <div class="form-group cmc-form-group-cliente-email">
                        <label>Email</label> 
                        <input type="text" name="email" placeholder="Seu email" class="form-control input-lg cmc-contato-email cmc-required cmc-email"/>
                      
                    </div>
                    <div class="form-group cmc-form-group-cliente-projeto">
                        <label>Fale um pouco sobre seu projeto ou necessidade:</label> 
                        <textarea  name="message" class="form-control input-lg cmc-required cmc-contato-mensagem" rows="5"></textarea>
                    </div>
                    <div><br />
                        <button class="btn btn-sm btn-primary btn-lg float-left m-t-n-xs cmc-contato-botao-enviar"><strong>Solicitar um projeto</strong></button>
                        <img src="Anexos/5e7c4fcf-5953-4b10-a4a4-135d6ce174eb/pages.core.template/9dd44d98-fda7-4dc1-bb49-2585c530a892/IdVirtualArquivos/img/progress.gif" class="cmc-loader-enviar-cadastro-contato cmc-oculto"/>
                    </div>
                </form>
            </div>
            <div class="col-lg-2"><br /></div>
        </div>
        <div class="row cmc-contato-mensagem-resultado">
        </div>
    </div>
</section>