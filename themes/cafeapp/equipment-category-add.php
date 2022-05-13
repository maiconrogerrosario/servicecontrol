<?php $v->layout("_theme"); ?>

 <!-- begin .app-main -->
<div class="app-main">
    <!-- begin .main-heading 
     <header class="main-heading shadow-2dp">
         begin dashhead 
		<div class="dashhead bg-white">
			<div class="dashhead-titles">
				<h3 class="dashhead-title">Novas Categorias de Fornecedores</h3>
				<h6 class="dashhead-subtitle p-t-15">
				<a href="index.html">chaldene</a>
					/ forms
					/ Form Wizard
				</h6>
			</div>
			<div class="dashhead-toolbar ">
				<div class="dashhead-toolbar-item p-t-30">
					<a href="index.html">chaldene</a>
						/ forms
						/ Form Wizard
				</div>
			</div>
		</div>
            END: dashhead 
  </header>-->
    <!-- END: .main-heading -->
	<!-- begin .main-content -->
		<div class="main-content bg-clouds">
			<!-- begin .container-fluid -->
			<div class="container-fluid p-t-15">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<header>
								<h4>Categoria de Equipamentos<small></small></h4>
								<!-- begin box-tools -->
								<!--<div class="box-tools">
								<a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
								<a class="fa fa-fw fa-times" href="#" data-box="close"></a>
								</div>-->
								<!-- END: box-tools -->
							</header>
							<div class="box-body">
								<form class="form-horizontal" action="<?= url("/app/equipment-category-add"); ?>" method="post">
									<div>
										<section>
											<div class="form-group">
												<div class="col-md-12">
													<label for="name" class="control-label">Nome da Categoria:</label>
													<input type="hidden" name="action" value="create"/>
													<input type="text" name="name" required class="form-control" id="name" placeholder="Nome da Categoria:">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-12">
													<label for="type">Tipo:</label>
													<select class="form-control" name="type">
														<option value="income">Receita</option>
														<option value="expense">Despesa</option>
													</select>				
												</div>
											</div>					
											<div class="form-group">
												<div class="col-lg-12">
													<button class="btn btn-primary">Cadastrar</button>
												</div>
											</div>			
										</section>
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
        <footer class="main-footer bg-white p-a-5">
          
        </footer>
         <!-- END: .main-footer -->
</div>









