<?php $v->layout("_theme"); ?>

<section  class="gray-section signup">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line2"><br /></div>
            <h1>Cadastre-se</h1>
            <p>Já tem uma conta? <a title="Fazer login!" href="<?= url("/work-entrar"); ?>">Fazer login!</a></p>
        </div>
		<div class="row m-b-lg">
            <div class="col-lg-2"><br /></div>
				<div class="col-lg-12">
					<form class="auth_form" action="<?= url("/work-cadastrar"); ?>" method="post" enctype="multipart/form-data">
						<div class="ajax_response"><?= flash(); ?></div>
							<?= csrf_input(); ?>
			
							<div class="form-group">
								<label>
									<div><span><i class="fa fa-fw fa-user"></i>Nome:</span></div>
									<input type="text" name="first_name" placeholder="Primeiro nome:" class="form-control input-lg" required/>
								</label>
							</div>
							<div class="form-group">
								<label>
									<div><span><i class="fa fa-fw fa-user"></i>Sobrenome:</span></div>
									<input type="text" name="last_name" placeholder="Último nome:" class="form-control input-lg" required/>
								</label>	
							</div>
							<div class="form-group">
								<label>
									 <div><span><i class="fa fa-fw fa-envelope"></i>Email:</span></div>
									<input type="email" name="email" placeholder="Informe seu e-mail:" class="form-control input-lg" required/>
								</label>
							</div>
							<div class="form-group">
								<label>
									<div><span><i class="fa fa-fw fa-unlock-alt"></i>Senha:</span></div>
									<input type="password" name="password" placeholder="Informe sua senha:" class="form-control input-lg" required/>
								</label>
							</div>
							<button  class="auth_form_btn btn btn-sm btn-primary"> Criar conta</button>
						</div>	
					</form>
				</div>			
			</div>				
		</div>					   
    </div>
</section>







