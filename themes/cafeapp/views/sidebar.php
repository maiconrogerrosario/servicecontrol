
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
                <a title="Médicos" href="<?= url("/app/employee"); ?>">
					<span class="nav-icon">
						<i class="fa fa-fw fa-tag"></i>
					</span>		
                    <span class="nav-title">Funcionários</span>
                </a>
            </li>

            <li>
                <a title="Gerenciamento de Equipamentos" href="<?= url("/app/equipment"); ?>">
					<span class="nav-icon">
						<i class="fa fa-fw fa-tag"></i>
					</span>		
                    <span class="nav-title">Equipamentos</span>
                </a>				
				<ul class="nav nav-sub nav-stacked">
					<li><a title="Equipamentos" href="<?= url("/app/equipment"); ?>">Equipamentos</a></li>
					<li><a title="QRcode" href="<?= url("/app/equipment-qrcode"); ?>">QRcode</a></li>
					<li><a title="Responsáveis" href="<?= url("/app/equipment-worker"); ?>">Responsáveis</a></li>
					<li><a title="Documentos" href="<?= url("/app/equipment-file"); ?>">Documentos</a></li>
				</ul>			
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
     
	
	
	
	


