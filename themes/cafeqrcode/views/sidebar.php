
<!-- BEGIN: nav-content -->
 <ul class="metismenu nav nav-inverse nav-bordered nav-stacked" data-plugin="metismenu">
 
            <li>
				<a title="Inicio" href="<?= url("/app"); ?>" >
					<span class="nav-icon">
						<i class="fa fa-fw fa-home"></i>	
					</span>	
					 <span class="nav-title">Inicio</span>
                </a>
            </li>
			
            <li>
                <a title="Consultas" href="<?= url("/app/maintenance"); ?>">
					<span class="nav-icon">
						<i class="fa fa-fw fa-gear"></i>
					</span>		
                     <span class="nav-title">Manutenações</span>
                </a>
            </li>
			
            <li>
                <a title="Fornecedores" href="<?= url("/app/supplier"); ?>" >
					<span class="nav-icon">
						<i class="fa fa-fw fa-industry"></i>
					</span>		
                    <span class="nav-title">Fornecedores</span>
                </a>
            </li>
			
            <li>
                <a title="Médicos" href="<?= url("/app/equipment"); ?>">
					<span class="nav-icon">
						<i class="fa fa-fw fa-tag"></i>
					</span>		
                    <span class="nav-title">Gerenciamento de Equipamentos</span>
                </a>				
				<ul class="nav nav-sub nav-stacked">
					<li><a title="Equipamentos" href="<?= url("/app/equipment"); ?>">Equipamentos</a></li>
					<li><a title="QRcode Equipamentos" href="<?= url("/app/equipment-qrcode"); ?>">QR Code Equipamentos</a></li>
					<li><a title="Funcionários Responsáveis Equipamentos" href="<?= url("/app/equipment-worker"); ?>">Funcionários Responsáveis Equipamentos</a></li>
					<li><a title="Documentos dos Equipamentos" href="<?= url("/app/equipment-file"); ?>">Documentos dos Equipamentos</a></li>
					<li><a title="Documentos dos Equipamentos" href="<?= url("/app/equipment-history"); ?>">Histórico de Maunteção dos Equipamentos</a></li>
				</ul>			
            </li>
			
			<li>
                <a title="Médicos" href="<?= url("/app/employee"); ?>">
					<span class="nav-icon">
						<i class="fa fa-fw fa-tag"></i>
					</span>		
                    <span class="nav-title">Funcionários</span>
                </a>
            </li>
						
            <li>
                <a>
					<span class="nav-icon">
						<i class="fa fa-fw fa-th-list"></i>
					</span>		
                     <span class="nav-title">Categorias</span>
                </a>
				<ul class="nav nav-sub nav-stacked">
					<li><a title="Serviços" href="<?= url("/app/service-category"); ?>">Categorias de Serviços</a></li>
					<li><a title="Equipamentos" href="<?= url("/app/equipments-category"); ?>">Categorias de Equipamentos</a></li>
					<li><a title="Manutenções" href="<?= url("/app/maintenance-category"); ?>">Categorias de Manutenções</a></li>
					<li><a title="Funções" href="<?= url("/app/occupation-category"); ?>">Categorias de Funções</a></li>
				</ul>
            </li>
			
            <li>
                <a title="Relátorio de Consultas" href="<?= url("/app/reportsview"); ?>">
					<span class="nav-icon">
						<i class="fa fa-fw fa-area-chart"></i>
					</span>		
                     <span class="nav-title">Relátorio de Consultas</span>
                </a>
            </li>
			
			 <!-- BEGIN: Clientes -->
			<li>
				<a href="javascript:;">
					<span class="nav-icon"><i class="fa fa-fw fa-user"></i></span>                    
					<span class="nav-title">Categorias</span>
					<span class="nav-tools"><i class="fa fa-fw arrow"></i>
				</a>
				<ul class="nav nav-sub nav-stacked">
					<li><a title="Equipamentos" href="<?= url("/app/equipment-category");?>">Equipamentos</a></li>
					<li><a title="Serviços" href="<?= url("/app/service-category"); ?>">Serviços</a></li>
					<li><a title="Função de Funcionários" href="<?= url("/app/occupation-category"); ?>">Função de Funcionários</a></li>
				</ul>
			</li>
			<!-- END: Clientes -->	
			
			<li>
                <a title="Usuários" href="<?= url("/app/user");?>">
					<span class="nav-icon">
						<i class="fa fa-fw fa-users"></i>
					</span>		
                    <span class="nav-title">Usuários</span>
                </a>
            </li>
			
			
			<li>
                <a title="Usuários" href="<?= url("/app/sair");?>">
					<span class="nav-icon">
						<i class="fa fa-fw fa-users"></i>
					</span>		
                    <span class="nav-title">Sair</span>
                </a>
            </li>
             
  </ul>              
     
	
	
	
	


