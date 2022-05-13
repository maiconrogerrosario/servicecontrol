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
							<h4>Cadastro de Manutenção de Equipamento<small></small> </h4>
							<!-- begin box-tools -->
							<!--<div class="box-tools">
							<a class="fa fa-fw fa-minus" href="#" data-box="collapse"></a>
							<a class="fa fa-fw fa-times" href="#" data-box="close"></a>
							</div>-->
							<!-- END: box-tools -->
						</header>
						<div class="box-body">
							<form class="form-horizontal" action="<?= url("/app/maintenance-add"); ?>" method="post">
								<input type="hidden" name="action" value="create"/>
								<div>
									<section>
										<div class="form-group">
											<div class="col-lg-12">
												<label for="maintenance_type">Tipo de Manutenção</label>
												<select name="maintenance_type" id="maintenance_type"  class="form-control" required>
													<option value="">SELECIONE TIPO DE MANUTENÇÃO</option>
													<option value="Manutenção Preventiva">MANUTENÇÃO PREVENTIVA</option>
													<option value="Manutenção Correntiva">MANUTENÇÃO CORRENTIVA</option>
													<option value="Manutenção Preditiva">MANUTENÇÃO PREDITIVA</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-12">
												<label for="equipment_id">Equipamento</label>
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
												<label for="service_id">Tipo de Serviço:</label>
												<select name="service_id" id="service_id"  class="form-control" required>
													<option value="">SELECIONE TIPO DE SERVIÇO</option>
													<?php foreach($services as $service):?>
														<option value="<?php echo $service->id;?>"><?php echo $service->name?></option>
													<?php endforeach; ?>			
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-6">
												<label for="date_initial">Data da Manutenção Inicial</label>
												<input type="date" id="date_initial" name="date_initial"  class="form-control" id="date_initial" placeholder="Data Inicial" required>
											</div>
											<div class="col-lg-6">
												<label for="time_initial">Horário  da Manutenção Inicial</label>
												<input type="time" id="time_initial" name="time_initial"  class="form-control"  placeholder="Horário Final" required>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-6">
												<label for="date_final">Data da Manutenção Final</label>
												<input type="date" id="date_final" name="date_final"  class="form-control"  placeholder="Data Final" required>
											</div>
											<div class="col-lg-6">
												<label for="time_final">Horário da Manutenção Final</label>
												<input type="time" id="time_final" name="time_final"  class="form-control" id="time_final" placeholder="Hora Final" required>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-12">
												<label for="annotations">Anotações</label>
												<textarea type="text" class="form-control" id="annotations" name="annotations" placeholder="Anotações"></textarea>
											</div>
										</div>
										<div class="form-group">
											<div class="col-lg-12">
												<label for="collaborator_name" >Manutenção Realizada Por:</label>
												<select name="collaborator_name" id="collaborator_name"   class="form-control">
													<?php foreach($suppliers as $supplier): ?>
														<option value="<?=$supplier->name; ?>"><?=  $supplier->name;?></option>
													<?php endforeach; ?>
												</select>							
											</div>	
										</div>			
										<div class="form-group">
											<div class="col-lg-12">
												<label for="status_id">Estado do Serviço</label>
												<select name="status_id" id="status_id" class="form-control" required>
													<option value="ATIVO">ATIVO</option>
													<option value="FINALIZADA">FINALIZADA</option>
													
												</select>
											</div>		
										</div>		
										<div class="form-group">
											<div class="col-lg-12">
												<label for="price">Custo Total da Manutenção</label>
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-usd"></i></span>
													<input type="text" id="price" class="form-control" name="price" placeholder="Custo Total da Manutenção">
												</div>
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

<?php $v->start("scripts"); ?>

<script>
  function typeCollaborator(){
    if (document.getElementById('collaborator').value == 'internal'){
      document.getElementById('internal').style.display='block';
      document.getElementById('external').style.display='none';
    }else{
      document.getElementById('external').style.display='block';
      document.getElementById('internal').style.display='none';
    }
	
  }

</script>




<?php $v->end(); ?>





