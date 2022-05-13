<?php $v->layout("_theme"); ?>
	
<div class="app-main">
	<!-- begin .main-heading -->
   <!--  <header class="main-heading shadow-2dp">
		<!-- begin dashhead -->
       <!-- <div class="dashhead bg-white">
            <div class="dashhead-titles">
				<h6 class="dashhead-subtitle">
                  chaldene
                </h6>
                <h3 class="dashhead-title">Dashboard</h3>
            </div>
            <div class="dashhead-toolbar">
				<div class="dashhead-toolbar-item">
					<a href="index.html">chaldene</a>
                  / Dashboard
                </div>
            </div>
        </div>
		<!-- END: dashhead -->
    <!--  </header>-->
    <!-- END: .main-heading -->
	
    <!-- begin .main-content -->
	<div class="main-content bg-clouds">
	    <!-- begin .container-fluid -->
        <div class="container-fluid p-t-15">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
							<header>
								<h3>Manutenções</h3>
								<div class="box-tools">
								</div>
							</header>	
						<div class="box-body">
					
							<a href="<?= url("/app/maintenance-add"); ?>" class="btn btn-primary"><i class='fa fa-i fa-plus-circle'></i>Nova</a>

						</div>
						<div class="box-body">
							<form class="form-horizontal" role="form" action="<?= url("/app/maintenancesearch"); ?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="maintenancesearch" value="maintenance">
									<div class="col-md-3">
										<label for="service_id">Escolha um Serviço</label>
										<div class="input-group">	
											<span class="input-group-addon"><i class="fa fa-fw fa-male"></i></span>
											<select id="service_id" name="service_id" class="form-control">									
												<option value="all">Todas</option>
												<?php foreach ($services as $service): ?>
													<option <?= (!empty($filter->service_id) && $filter->service_id == $service->id ? "selected" : ""); ?>
													value="<?= $service->id; ?>"><?= $service->name; ?></option>
												<?php endforeach; ?>						
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<label for="equipment_id">Escolha um Equipamento</label>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-fw fa-male"></i></span>
											<select id="equipment_id" name="equipment_id" class="form-control">
												<option value="all">Todas</option>
													<?php foreach ($equipments as $equipment): ?>
														<option <?= (!empty($filter->equipment_id) && $filter->equipment_id == $equipment->id ? "selected" : ""); ?>
														value="<?= $equipment->id; ?>"><?= $equipment->name; ?></option>
													<?php endforeach; ?>	
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<label for="date">Escolha uma Data</label>
										<div class="input-group"> 
											<span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
												<input id="date value="date" type="date" name="date" class="form-control" placeholder="<?= (!empty($filter->date) ? $filter->date : "all"); ?>">
										</div>
									</div>
											
									<div class="col-md-2">
										<label for=""></label>
										<button class="btn btn-primary btn-block">Buscar</button>
									</div>	
							</form>
						</div>
						<div class="box-body">
							<table class="table table-bordered table-hover">
								<thead>
									<th scope="col" style="text-align:center;font-size:12px;">Equipamento</th>
									<th scope="col"style="text-align:center;font-size:12px;">Tipo de Serviço</th>
									<th scope="col" style="text-align:center;font-size:12px;">Manutenção Realizada Por</th>
									<th scope="col" style="text-align:center;font-size:12px;">Tipo de Colobarador</th>
									<th scope="col" style="text-align:center;font-size:12px;">Data da Manutenção</th>
									<th scope="col" style="text-align:center;font-size:12px;">Horario da Manutenção</th>
									<th scope="col" style="text-align:center;font-size:12px;">Ações</th>								
								</thead>
								<tbody>
									<?php if (!empty($maintenances)): ?>
										<?php foreach ($maintenances as $maintenance):?>
											<?php $equipment  = $maintenance->getEquipment();?>
											<?php $service  = $maintenance->getService();?>
											<?php $teste  = $maintenance->type_collaborator;?>
											<tr>
												<td><?php echo $equipment->name; ?></td>
												<td><?php echo $service->name; ?></td>
												<td><?php echo $maintenance->collaborator_name;?></td>
												<td><?php echo $maintenance->getTypeCollaborator($teste);?></td>
												<td><?php echo date_fmt($maintenance->date_initial, "d/m/Y");?></td>
												<td><?php echo $maintenance->time_initial;?></td>
												<td style="width:180px;">				
													<a href="<?= url("/app/maintenance-edit/{$maintenance->id}"); ?>" class="btn btn-warning btn-xs">Editar</a>
													<a class="btn-simple btn btn-danger btn-xs" title="" href="#"
														data-post="<?= url("/app/maintenance-delete/{$maintenance->id}"); ?>"
														data-action="delete"
														data-confirm="Tem Certeza que Deseja Deletar essa Manutenção?"
														data-id="<?= $maintenance->id;?>">Deletar</a>  
												</td>				
											</tr>						
										<?php endforeach; ?>
									<?php endif; ?>		    
								</tbody>
							</table>			
						</div>
					</div>	
				</div>
			</div>
			<!-- END: .row -->		
		</div>		
	</div>	
    <!-- END: .main-content -->
	
    <!-- begin .main-footer -->
    <footer class="main-footer bg-white p-a-5">
		  
		 <?=$paginator?>
			 
    </footer>
    <!-- END: .main-footer -->
	
	
</div>
<!-- END: .app-main -->	
	



		



		


