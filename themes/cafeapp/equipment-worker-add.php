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
							<h4>Vincular Funcionários</small> </h4>
							<!-- begin box-tools -->
							<!--<div class="box-tools">
							<a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
							<a class="fa fa-fw fa-times" href="#" data-box="close"></a>
							</div>-->
							<!-- END: box-tools -->
						</header>
						<div class="box-body">
							<form class="form-horizontal" action="<?= url("/app/equipment-worker-add"); ?>" method="post">
								<input type="hidden" name="action" value="create"/>
								<div>
									<section>
										<div class="form-group">
											<div class="col-lg-12">
												<label for="equipment_id">Equipamento:</label>
												<select name="equipment_id" id="equipment_id" class="form-control" required>
														<option value="">SELECIONE</option>
													<?php foreach($equipments as $equipment):?>
														<option value="<?php echo $equipment->id; ?>"><?php echo $equipment->id." - ".$equipment->name?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-12">
												<label for="employee_id" >Funcionário:</label>
												<select name="employee_id" id="employee_id"   class="form-control">
													<?php foreach($employees as $employee): ?>	
														<option value="<?=$employee->id; ?>"><?=  $employee->name;?></option>
													<?php endforeach; ?>
												</select>
											</div>	
										</div>		
		
			
		
										<div class="form-group">
											<div class="col-lg-12">
												<label for="status" >Status:</label>
												<select name="status" id="status"   class="form-control">	
													<option value="ATIVO">VINCULAÇÃO ATIVA</option>
													<option value="INATIVO">VINCULAÇÃO INATIVA</option>
												</select>
											</div>	
										</div>		
		
		
										<div class="form-group">
											<div class="col-lg-12">
												<label for="observation">Observaçãoes:</label>
												<textarea type="text" class="form-control" id="observation" name="observation" placeholder="Observaçãoes:"></textarea>
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
		  
				<div class="col-lg-6">
					<label for="date_final">Data de Entrega da Obra</label>
					<input id="autocomplete" title="type &quot;a&quot;">
				</div>	
		
          </footer>-->
          <!-- END: .main-footer -->

</div>
        <!-- END: .app-main -->	




























