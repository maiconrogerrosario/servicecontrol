
			
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
								<h3>Documentos dos Equipamentos</h3>
								<div class="box-tools">
								</div>
							</header>	
						<div class="box-body">

							<a href="<?= url("/app/equipment-file-add"); ?>" class="btn btn-primary"><i class='fa fa-i fa-plus-circle'></i>Novo</a>
							
						</div>
						
						
						
						
						<div class="box-body">
							<table class="table table-bordered table-hover">
								<thead>
									<th scope="col" style="text-align:center;font-size:12px;">Subtítulo</th>
									<th scope="col" style="text-align:center;font-size:12px;">Equipamento</th>
									<th scope="col" style="text-align:center;font-size:12px;">Status</th>
									<th scope="col" style="text-align:center;font-size:12px;" >Descrição</th>
									<th scope="col" style="text-align:center;font-size:12px;">Ações</th>	
								</thead>
								<tbody>		
									<?php if (!empty($equipmentFiles)): ?>
										<?php foreach ($equipmentFiles as $equipmentFile):?>
											<?php $equipment  = $equipmentFile->getEquipment();?>
											<tr>			
												<td><?php echo $equipmentFile->title; ?></td>
												<td><?php echo $equipmentFile->subtitle; ?></td>
												<td><?php echo $equipment->name; ?></td>
												<td><?php echo $equipmentFile->status;?></td>
												<td><?php echo $equipmentFile->description;?></td>
												<td style="width:150;">
													<a title="Editar" href="<?= url("/app/equipment-file-edit/{$equipmentFile->id}"); ?>" class="btn btn-warning btn-xs"><span class="fa fa-edit fw-fa"></span></a>
													<a title="Deletar" class="btn btn-danger btn-xs"   title="" href="#"
														data-post="<?= url("/app/equipment-file-delete/{$equipmentFile->id}"); ?>"
														data-action="delete"
														data-confirm="Tem que deseja deletar essa vinculação?"
														data-id="<?= $equipmentFile->id;?>"><span class="fa fa-remove p-r-5"></span></a>  
								
													<a title="Download do Equipamento " href="<?= url("/storage/{$equipmentFile->cover}"); ?>" class="btn btn-primary btn-xs"><span class="fa fw-fa fa-download p-r-5"></span></a>	   
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
	



		



		


		


		






