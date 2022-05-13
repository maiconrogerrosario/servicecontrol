<?php $v->layout("_theme"); ?>

<section  class="gray-section signup">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line2"><br /></div>
            <h1>Fazer Login</h1>
            <p>Ainda não tem conta? <a title="Cadastre-se!" href="<?= url("/cadastrar"); ?>">Cadastre-se!</a></p>
        </div>
		
		<div class="row m-b-lg cmc-contato-formulario">
            <div class="col-lg-2"><br /></div>
				<div class="col-lg-8">

					<form class="auth_form" action="<?= url("/entrar"); ?>" method="post" enctype="multipart/form-data">
						<div class="ajax_response"><?= flash(); ?></div>
							<?= csrf_input(); ?>
			
							<div class="form-group">
								<label>
									<div><span class="icon-envelope">Email:</span></div>
									<input class="form-control input-lg" type="email" name="email" value="<?= ($cookie ?? null); ?>" placeholder="Informe seu e-mail:"
									required/>
								</label>
							</div>
							<div class="form-group">
								<label>
									<div>
										<span class="icon-unlock-alt">Senha:</span>
										<span><a title="Esqueceu a senha?" href="<?= url("/recuperar"); ?>">Esqueceu a senha?</a></span>
									</div>
									<input class="form-control input-lg" type="password" name="password" placeholder="Informe sua senha:" required/>
								</label>
							</div>
							<div class="form-group">
								<label class="check">
									<input type="checkbox" <?= (!empty($cookie) ? "checked" : ""); ?> name="save"/>
									<span>Lembrar dados?</span>
								</label>
							</div>
							<button  class="auth_form_btn btn btn-sm btn-primary">Entrar</button>
						</div>	
					</form>
				</div>			
			</div>				
		</div>					   
    </div>
</section>



