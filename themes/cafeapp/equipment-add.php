



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
							<h4>Cadastro de Equipamentos</small> </h4>
							<!-- begin box-tools -->
							<!--<div class="box-tools">
							<a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
							<a class="fa fa-fw fa-times" href="#" data-box="close"></a>
							</div>-->
							<!-- END: box-tools -->
						</header>
						<div class="box-body">
							<form class="form-horizontal" action="<?= url("/app/equipment-add"); ?>" method="post">
								<input type="hidden" name="action" value="create"/>
								<div>
									<section>
										<div class="form-group">
											
											<div class="col-md-12">
												<label for="name">Equipamento</label>
												<input type="text" name="name" class="form-control" id="name" placeholder="Equipamento (Indentificação Descrição)">
											</div>

											
										</div>
										<div class="form-group">
											<div class="col-md-6">
												<label for="category_id">Tipo de Equipamento</label>
												<input type="hidden" name="action" value="create"/>
												<select name="category_id" class="form-control">
													<?php foreach ($categories as $category): ?>
														<option value="<?php echo $category->id; ?>"> <?php echo $category->name; ?></option>      
													<?php endforeach;?>
												</select>
											</div>

											
											<div class="col-md-6">
												<label for="localization">Localização</label>
												<input type="text" name="localization" class="form-control" id="localization" placeholder="Localização">
											</div>
										
											
										</div>
										

										<div class="form-group">
											<div class="col-md-6">
												<label for="tag" >Tagueamento</label>
												<input type="text" name="tag" required class="form-control" id="tag" placeholder="Tagueamento">
											</div>
										
											<div class="col-md-6">
												<label for="supplier_id" >Fornecedor</label>
												<select name="supplier_id" class="form-control">
													<?php foreach ($suppliers as $supplier): ?>
														<option value="<?php echo $supplier->id; ?>"><?php echo $supplier->name; ?></option>      
													<?php endforeach;?>
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
           <!--<footer class="main-footer bg-white p-a-5">
		  
				<div class="col-md-6">
					<label for="date_final">Data de Entrega da Obra</label>
					<input id="autocomplete" title="type &quot;a&quot;">
				</div>	
		
          </footer>-->
          <!-- END: .main-footer -->

</div>
        <!-- END: .app-main -->	





















