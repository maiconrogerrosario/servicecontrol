<?php $v->layout("_theme"); ?>

<section  class="gray-section signup">
    <div class="container">
        <div class="row m-b-lg">
            <div class=" col-lg-12 text-center">
                <div class="navy-line2"><br /></div>
                <h1>Deixe sua mensagem sobre o seu projeto</h1>
                <p>Informe seus dados iniciais, iremos entrar em contato para publicar o seu site</p>
            </div>
        </div>
		
		
		<div class="row m-b-lg">
		
            <div class="col-lg-12 text-center">
			
				<input type="hidden" name="action" value="aviso"/>

				<a href="<?= url("/aviso"); ?>" style="width: 300px;" type="button" class="btn btn-primary">Abrir Chamado de Manutenção</a>

            </div>
        </div>
		
		
			<div class="row m-b-lg">
			
            <div class=" col-lg-12 text-center">
			
				<a href="<?= url("/aviso"); ?>"  style="width: 300px;"type="button" class="btn btn-primary">Histórico de Manutenção</a>

            </div>
        </div>
		
		
			<div class="row m-b-lg">
			
            <div class=" col-lg-12 text-center">
			
				<a href="<?= url("/aviso"); ?>" style="width: 300px;" type="button" class="btn btn-primary">Manual de operação e Elétricos Máquina</a>

            </div>
        </div>
			<div class="row m-b-lg">
			
            <div class=" col-lg-12 text-center">
			
				<a href="<?= url("/aviso"); ?>" style="width: 300px;" type="button" class="btn btn-primary">Informaçãoes Sobre a Máquina</a>

            </div>
        </div>

        <div class="row cmc-contato-mensagem-resultado">
        </div>
    </div>
</section>