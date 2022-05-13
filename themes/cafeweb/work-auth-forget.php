<?php $v->layout("_theme"); ?>


<section  class="gray-section signup">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line2"><br /></div>
            <h1>Recuperar senha</h1>
            <p>Informe seu e-mail para receber um link de recuperação.</p>
        </div>
		<div class="row m-b-lg">
            <div class="col-lg-2"><br /></div>
				<div class="col-lg-8">
					<form class="auth_form" action="<?= url("/work-recuperar"); ?>" method="post"
						enctype="multipart/form-data">

						<div class="ajax_response"><?= flash(); ?></div>
						<?= csrf_input(); ?>

							<label>
								<div>
									<span class="icon-envelope">Email:</span>
									<span><a title="Voltar e entrar!" href="<?= url("/work-entrar"); ?>">Voltar e entrar!</a></span>
								</div>
								<input class="form-control input-lg" type="email" name="email" placeholder="Informe seu e-mail:" required/>
							</label>

            <button  class="auth_form_btn btn btn-sm btn-primary">Recuperar</button>
        </form>
    </div>
</section>