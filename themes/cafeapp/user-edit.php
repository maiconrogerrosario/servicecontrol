<?php $v->layout("_theme"); ?>

 <!-- begin .app-main -->
<div class="app-main">
          <!-- begin .main-heading -->
    <header class="main-heading shadow-2dp">
            <!-- begin dashhead -->
			   <!--	<div class="dashhead bg-white">
					<div class="dashhead-titles">

						<h3 class="dashhead-title">Serviços</h3>
						<h6 class="dashhead-subtitle p-t-15">
							<a href="index.html">chaldene</a>
							/ forms
							T
						</h6>
					</div>

					<div class="dashhead-toolbar ">
						<div class="dashhead-toolbar-item p-t-30">
							<a href="index.html">chaldene</a>
							/ forms
							/ Form Wizard
						</div>
					</div>
				</div>-->
            <!-- END: dashhead -->
    </header>
          <!-- END: .main-heading -->

          <!-- begin .main-content -->
    <div class="main-content bg-clouds">
            <!-- begin .container-fluid -->
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-xs-12">
					<div class="box">
						<header>
							<h4>Editar Usuários<small></small> </h4>
							<!-- begin box-tools -->
							<!--<div class="box-tools">
								<a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
								<a class="fa fa-fw fa-times" href="#" data-box="close"></a>
							</div>-->
							<!-- END: box-tools -->
						</header>
						<div class="box-body">
							<form class="form-horizontal" action="<?= url("/app/user-edit/{$user->id}"); ?>" method="post">
								<input type="hidden" name="action" value="update"/>
								<div class="form-row">
									<div class="form-group">
										<div class="col-md-6">
											<label for="first_name">Nome:</label>
											<input type="text" class="form-control" id="first_name" name="first_name" value="<?= $user->first_name; ?>" placeholder="Nome:" required/>
										</div>
										<div class="col-md-6">
											<label for="last_name">Sobrenome:</label>
											<input type="text" class="form-control" id="last_name" placeholder="Sobrenome:" name="last_name" value="<?= $user->last_name; ?>" required/>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group">
										<div class="col-md-12">
											<label for="genre">Genero:</label>
											<select class="form-control" name="genre">
												<?php
													$genre = $user->genre;
													$select = function ($value) use ($genre) {
														return ($genre == $value ? "selected" : "");
													};
												?>
												<option <?= $select("male"); ?> value="male">Masculino</option>
												<option <?= $select("female"); ?> value="female">Feminino</option>
												<option <?= $select("other"); ?> value="other">Outros</option>	
											</select>				
										</div>
									</div>					
								</div>
								<div class="form-row">
									<div class="form-group">
										<div class="col-md-12">
											<label for="photo">Foto: (600x600px)</label>
											<input class="form-control" type="file" name="photo"/>
										</div>	
									</div>
								</div>
								<div class="form-row">
									<div class="form-group">			
										<div class="col-md-6">
											<label for="datebirth">Nascimento:</label>
											<input type="text" class="form-control mask-date" name="datebirth" placeholder="dd/mm/yyyy" value="<?= ($user->datebirth ? date_fmt($user->datebirth, "d/m/Y") : null); ?>"/>
										</div>
										<div class="col-md-6">
											<label for="document">CPF:</label>
											<input class="form-control mask-doc" type="text" name="document" placeholder="CPF:" value="<?= $user->document; ?>"/>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group">
										<div class="col-md-10">
											<label for="email">Email:</label>
											<input class="form-control" type="email" name="email" placeholder="Email:" value="<?= $user->email; ?>" required/>
										</div>
										<div class="col-md-2">
											<label for="password">Senha:</label>
											<input class="form-control" type="password" name="password" placeholder="Senha" value="<?= $user->password; ?>" required/>
										</div>
									</div>
								</div>		
								<div class="form-row">
									<div class="form-group">
										<div class="col-md-12">
											<label for="level">Bairro:</label>
											<select class="form-control" class="form-control"  name="level" required>
												<?php
													$level = $user->level;
													$select = function ($value) use ($level) {
														return ($level == $value ? "selected" : "");
													};
												?>
												<option <?= $select(1); ?> value="1">Usuário</option>
												<option <?= $select(5); ?> value="5">Admin</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group">
										<div class="col-md-12">
											<label for="status">Complemento:</label>
											<select class="form-control" name="status" required>
												<?php
													$status = $user->status;
													$select = function ($value) use ($status) {
														return ($status == $value ? "selected" : "");
													};
												?>
												<option <?= $select("registered"); ?> value="registered">Registrado</option>
												<option <?= $select("confirmed"); ?> value="confirmed">Confirmado</option> 
											</select>
										</div>
									</div>
								</div>	
								<div class="form-row">
									<div class="form-group">
										<div class="col-md-4">
											<button type="submit" class="btn btn-primary">Alterar</button>
										</div>	
									</div>
								</div>
					
							</form>	
					
                      
						</div>
					</div>
                </div>
            </div>
        </div>
            <!-- END: .container-fluid -->
   </div>
          <!-- END: .main-content -->

          <!-- begin .main-footer -->
           <!--<footer class="main-footer bg-white p-a-5">
		  
				<div class="col-md-6">
					<label for="date_final">Data de Entrega da Obra</label>
					<input id="autocomplete" title="type &quot;a&quot;">
				</div>	
			

			
           
          </footer>-->
          <!-- END: .main-footer -->

 </div>
        <!-- END: .app-main -->	



<?php $v->start("scripts"); ?>
<script>
   $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});




</script>


 




<?php $v->end(); ?>



