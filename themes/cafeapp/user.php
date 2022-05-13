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
								<h3>Usuários</h3>
								<div class="box-tools">
								</div>
							</header>	
						<div class="box-body">
					
							<a href="<?= url("/work/user-add"); ?>" class="btn btn-primary"><i class='fa fa-i fa-plus-circle'></i>Usuário</a>

						</div>
						<div class="box-body">
							<table class="table table-bordered table-hover">
								<thead>
									<th>NOME</th>
									<th>SOBRENOME</th>
									<th>EMAIL</th>
									<th>AÇÕES</th>		
								</thead>
								<tbody>
									<?php foreach ($users as $user):?>
										<tr>
											<td><?php echo $user->first_name; ?></td>
											<td><?php echo $user->last_name; ?></td>
											<td><?php echo $user->email; ?></td>										
											<td style="width:280px;">
											<!--<a href="" class="btn btn-primary btn-xs">Historico</a>-->
												<a href="<?= url("/app/user-edit/{$user->id}"); ?>" title="Editar Usuário" class="btn btn-warning btn-xs"><span class="fa fa-edit fw-fa"></span></a>
												<a class="btn btn-danger btn-xs" title="Deletar Usuário" href="#"
													data-post="<?= url("/app/user/{$user->id}"); ?>"
													data-action="delete"
													data-confirm="Tem certeza que deseja deletar esse Usuario?"
													data-user_id="<?= $user->id; ?>"><span class="fa fw-i fa-remove"></span></a>
											</td>
										</tr>
									<?php endforeach; ?>
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
	



		



		







