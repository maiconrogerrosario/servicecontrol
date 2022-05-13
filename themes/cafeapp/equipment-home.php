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
                <h3 class="dashhead-title">Documentos e Informações Equipamentos</h3>
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
					<a href="<?= url("/app/equipment-file-add"); ?>" class="btn btn-primary">Salvar Novo Documento do Equipamento</a>
                  </div>
                </header>
                <div class="box-body">
                  <table id="datatables" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                       <th>Nome do Documento</th>	
						<th>Subtítulo</th>
						 <th>Equipamento</th>
						<th>Status</th>
						<th>Descrição</th>
						<th>Ações</th>
                      </tr>
                    </thead>
                    <tfoot>
                      
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
							<a href="<?= url("/app/equipment-file-edit/{$equipmentFile->id}"); ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil p-r-5"></i>Editar</a>	
							<a class="btn btn-danger btn-xs"   title="" href="#"
                                   data-post="<?= url("/app/equipment-file-delete/{$equipmentFile->id}"); ?>"
                                   data-action="delete"
                                   data-confirm="Tem que deseja deletar essa vinculação?"
                                   data-id="<?= $equipmentFile->id;?>"><i class="fa fa-remove p-r-5"></i>Deletar</a>  
								
							<a href="<?= url("/storage/{$equipmentFile->cover}"); ?>" class="btn btn-primary btn-xs"><i class="fa fa-download p-r-5"></i>Download</a>	   
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
				
		

