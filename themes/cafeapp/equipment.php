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
								<h3>Equipamentos</h3>
								<div class="box-tools">
								</div>
							</header>	
						<div class="box-body">
					
							<a href="<?= url("/app/equipment-add"); ?>" class="btn btn-primary"><i class='fa fa-i fa-plus-circle'></i>Novo</a>

						</div>
						
						<div class="box-body">
						
							<div class="dashhead bg-white">
								<form class="form-horizontal" action="<?= url("/app/equipment"); ?>">
									<div class="icon-after-input">
										<input type="text" name="s" value="<?=$search;?>" class="form-control" placeholder="Search">
										<button class="icon">
												<i class="fa fa-fw fa-search"></i>
										</button>	
									</div>
								</form>
							</div>
						</div>
						
						
						<div class="box-body">
							<table class="table table-bordered table-hover">
								<thead>
									<th scope="col" style="text-align:center;font-size:12px;">Equipamento</th>
									<th scope="col" style="text-align:center;font-size:12px;">Tipo de Equipamento</th>
									<th scope="col" style="text-align:center;font-size:12px;">Localização</th>
									<th scope="col" style="text-align:center;font-size:12px;">Tagueamento</th>
									<th scope="col" style="text-align:center;font-size:12px;">Ação</th>
								</thead>
								<tbody>	
									<?php if (!empty($equipments)): ?>
										<?php foreach ($equipments as $equipment):?>
											<tr>
												<td><?php echo $equipment->name;?></td>
												<td><?php echo $equipment->getCategory()->name; ?></td>
												<td><?php echo $equipment->localization; ?></td>
												<td><?php echo $equipment->tag; ?></td>
												<td style="width:280px;">
													<a href="<?= url("/app/equipment-edit/{$equipment->id}"); ?>" class="btn btn-warning btn-xs"><span class="fa fa-edit fw-fa"></span></a>
													<a class="btn btn-danger btn-xs" title="" href="#"
													data-post="<?= url("/app/equipment");  ?>"
													data-action="delete"
													data-confirm="Tem Esse Equipamento"
													data-id="<?= $equipment->id; ?>"><span class="fa fw-i fa-remove"></span></a>						
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
	



		



		


		


		



