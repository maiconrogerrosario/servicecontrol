<?php $v->layout("_theme"); ?>

 <!-- begin .app-main -->
        <div class="app-main">
		
          <!-- begin .main-heading -->
          <header class="main-heading shadow-2dp">
            <!-- begin dashhead -->
            <div class="dashhead bg-white">
              <div class="dashhead-titles">
                <h6 class="dashhead-subtitle">
                 
                </h6>
                <h3 class="dashhead-title">Lista de Manutenções</h3>
              </div>

              <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item">
					
                </div>
              </div>
            </div>
            <!-- END: dashhead -->
          </header>
          <!-- END: .main-heading -->

          <!-- begin .main-content -->
          <div class="main-content bg-clouds">

            <!-- begin .container-fluid -->
            <div class="container-fluid p-t-15">
              <div class="box">
				<header>
                  <div class="form-horizontal">
					<a href="<?= url("/app/equipment-worker-add"); ?>" class="btn btn-primary">Vincular Novo Funcionário</a>
                  </div>
                </header>
			  
			  
					
					  
				
                <div class="box-body">
                  <table id="datatables" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Equipamento</th>
						<th>Tipo de Serviço</th>
						<th>Tipo de Manutenção</th>
						<th>Data da Manutenção</th>
						<th>Ações</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Equipamento</th>
						<th>Tipo de Serviço</th>
						<th>Tipo de Manutenção</th>
						<th>Data da Manutenção</th>
						<th>Ações</th>
                      </tr>
                    </tfoot>
                    <tbody>
						<?php if (!empty($equipmentworkers)): ?>
						<?php foreach ($equipmentworkers as $equipmentworker):?>
						<?php $equipment  = $equipmentworker->getEquipment();?>
						<?php $employee  = $equipmentworker->getEmployee();?>

						<tr>
							<td><?php echo $equipment->name; ?></td>
							<td><?php echo $employee->name; ?></td>
							<td style="width:180px;">				
							<a class="btn-simple btn btn-danger btn-xs" title="" href="#"
                                   data-post="<?= url("/app/equipmentworker-delete/{$equipmentworker->id}"); ?>"
                                   data-action="delete"
                                   data-confirm="Tem Certeza que Deseja Deletar essa Manutenção?"
                                   data-id="<?= $equipmentworker->id;?>">Deletar</a>  
							</td>				
						</tr>						
						<?php endforeach; ?>
						<?php endif; ?>		    
                    </tbody>
                  </table>
				  
                </div>
              </div>

            </div>
            <!-- END: .container-fluid -->

          </div>
          <!-- END: .main-content -->

          <!-- begin .main-footer -->
          <footer class="main-footer bg-white p-a-5">
		  
			 <?=$paginator?>
			 
          </footer>
          <!-- END: .main-footer -->

        </div>
				
		

