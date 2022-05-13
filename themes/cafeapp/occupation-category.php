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
								<h3>Categorias De Funções de Funcionários</h3>
								<div class="box-tools">
								</div>
							</header>	
						<div class="box-body">
					
							<a href="<?= url("/app/service-category-add"); ?>" class="btn btn-primary"><i class='fa fa-i fa-plus-circle'></i>Novo</a>

						</div>
						<div class="box-body">
							<table class="table table-bordered table-hover">
								<thead>
									<th scope="col" style="text-align:center;font-size:12px;">NOME</th>
									<th scope="col" style="text-align:center;font-size:12px;">AÇÕES</th>
								</thead>
								<tbody>
									<?php if (!empty($categories)): ?>
										<?php foreach ($categories as $categorie):?>
											<tr scope="row">
												<td scope="col" style="text-align:center;font-size:12px;"><?php echo $categorie->name;?></td>
												<td scope="col" style="text-align:center;font-size:12px;">
													<a class="btn-simple btn btn-danger btn-xs" title="" href="#"
														data-post="<?= url("/app/occupation-category-delete/{$categorie->id}"); ?>"
														data-action="delete"
														data-confirm="Tem certeza que deseja deletar essa Categoria?"
														data-id="<?= $categorie->id;?>"><i class='fa fa-fw fa-remove'></i></a> 
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


		


		


		


		


		


		


		









