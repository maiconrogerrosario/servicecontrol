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
                <h3 class="dashhead-title">Solicitar Chamado Equipe Técnica</h3>
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
				   <form action="<?= url("/qrcode/equipment/{$equipmentWorker->application_id}/{$equipmentWorker->equipment_id}/{$uri}");?>"  method="post">
						<input type="hidden" name="email" value="email"/>	
						<button class="btn btn-primary">Solicitar Chamado </button>						
						
					</form>	
                  </div>
                </header>
                  
                </div>
              </div>

          </div>
            <!-- END: .container-fluid -->

          </div>
          <!-- END: .main-content -->


				
		

