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
								<h3>Funcionários</h3>
								<div class="box-tools">
								</div>
							</header>	
						<div class="box-body">
					
							<a href="<?= url("/app/employee-add"); ?>"  class="btn btn-primary"><i class='fa fa-i fa-plus-circle'></i>Novo</a>

						</div>
						<div class="box-body">
							<table class="table table-bordered table-hover">
								<thead>
									<th scope="col" style="text-align:center;font-size:12px;">Nome do Funcinário</th>
									<th scope="col" style="text-align:center;font-size:12px;">Função</th>
									<th scope="col" style="text-align:center;font-size:12px;">Email</th>
									<th scope="col" style="text-align:center;font-size:12px;">Celular</th>
									<th scope="col" style="text-align:center;font-size:12px;">Ações</th>
								</thead>
								<tbody>	
									<?php if (!empty($employees)): ?>
										<?php foreach ($employees as $employee):?>
											<?php 	$ocupation  = $employee->getOccupation();?>

											<tr>
												<td><?php echo $employee->name;?></td>
												<td><?php echo $ocupation->name; ?></td>
												<td><?php echo $employee->email; ?></td>
												<td><?php echo $employee->mobile; ?></td>
												<td style="width:280px;">
													<a title="Editar"  href="<?= url("/app/employee-edit/{$employee->id}"); ?>" class="btn btn-warning btn-xs"><span class="fa fa-edit fw-fa"></span></a>
													<a  title="Deletar"  class="btn btn-danger btn-xs" title="" href="#"
														data-post="<?= url("/app/employee"); ?>"
														data-action="delete"
														data-confirm="Tem certeza que deseja deletar esse Funcionário?"
														data-id="<?= $employee->id; ?>"><span class="fa fw-i fa-remove"></span></a>
						
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

    <!-- END: .main-footer -->
</div>
<!-- END: .app-main -->	
	



		



		


		

