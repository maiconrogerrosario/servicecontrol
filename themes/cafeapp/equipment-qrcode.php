			
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
								<h3>QR Code</h3>
								<div class="box-tools">
								</div>
							</header>	
						<div class="box-body">

							<a href="<?= url("/app/equipment-qrcode-add"); ?>" class="btn btn-primary"><i class='fa fa-i fa-plus-circle'></i>Novo</a>
							
						</div>
						
						
						
						
						<div class="box-body">
							<table class="table table-bordered table-hover">
								<thead>
									<th scope="col" style="text-align:center;font-size:12px;">id</th>	
									<th scope="col" style="text-align:center;font-size:12px;">Nome do equipamento</th>
									<th scope="col" style="text-align:center;font-size:12px;">Status</th>
									<th scope="col" style="text-align:center;font-size:12px;">Ações</th>
									
									
								</thead>
								<tbody>	
									<?php if (!empty($equipmentQrcodes)): ?>
										<?php foreach ($equipmentQrcodes as $equipmentQrcode):?>
											<?php $equipment  = $equipmentQrcode->getEquipment();?>
		
											<tr>			
												<td><?php echo $equipmentQrcode->id;?></td>
												<td><?php echo $equipment->name; ?></td>
												<td><?php echo $equipmentQrcode->status; ?></td>			
												<td style="width:150;">	
													<a title="Editar" href="<?= url("/app/equipment-qrcode-edit/{$equipmentQrcode->id}"); ?>" class="btn btn-warning btn-xs"><span class="fa fa-edit fw-fa"></span></a>
													<a title="Deletar" class="btn btn-danger btn-xs"   title="" href="#"
														data-post="<?= url("/app/equipment-qrcode-delete/{$equipmentQrcode->id}"); ?>"
														data-action="delete"
														data-confirm="Tem que deseja deletar essa vinculação?"
														data-id="<?=$equipmentQrcode->id;?>"><i class="fa fa-remove p-r-5"><span class="fa fw-i fa-remove"></span></a>	 
													<a title="QR-Code de Informações" href="<?=$equipmentQrcode->info;?>" class="btn btn-primary btn-xs"><SPAN class="fa fw-i fa-download p-r-5"></SPAN></a>
													<a title="QR-Code de Support" href="<?= $equipmentQrcode->support;?>" class="btn btn-primary btn-xs"><SPAN class="fa fw-i fa-download p-r-5"></SPAN></a>	   
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
	



		



		


		


		




