<?php $v->layout("_theme"); ?>

<div class="main-content bg-clouds">
    <!-- begin .container-fluid -->
    <div class="container-fluid p-t-15">
        <div class="box">
            <header class="bg-primary">
				<h4>Atualizar Manutenção</h4>
            </header>	
		</div>
		
		<div class="form-horizontal">
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="collaborator">Tipo de Colaborador</label>
						<select name="collaborator" id="collaborator"  class="form-control" onchange="typeCollaborator();"  >
				
							<option value="internal" <?php if($maintenance->collaborator=="internal"){ echo "selected"; }?>>Colaborador Interno</option>
						    <option value="external" <?php if($maintenance->collaborator=="external"){ echo "selected"; }?>>Colaborador Externo</option>

						</select>
					</div>					
				</div>
			</div>
		</div>	
			
		
		<form  class="form-horizontal" id="internal" action="<?= url("/app/maintenance-edit/{$maintenance->id}"); ?>" method="post">
			<input type="hidden" name="action" value="update"/>	
			
			<input type="hidden" name="type_collaborator" value="internal_collaborator"/>
			
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="maintenance_type">Tipo de Manutenção</label>
						<select name="maintenance_type" id="maintenance_type"  class="form-control">			
							<option value="Manutenção Preventiva"<?php if($maintenance->maintenance_type=="Manutenção Preventiva"){echo "selected";}?>>MANUTENÇÃO PREVENTIVA</option>
						    <option value="Manutenção Correntiva"<?php if($maintenance->maintenance_type=="Manutenção Correntiva"){echo "selected";}?>>MANUTENÇÃO CORRENTIVA</option>
							<option value="Manutenção Preditiva"<?php if($maintenance->maintenance_type=="Manutenção Preditiva"){echo "selected";}?>>MANUTENÇÃO PREDITIVA</option>
						</select>
					</div>
				</div>
			</div>
				
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="equipment_id">Equipamento</label>
						<select name="equipment_id" id="equipment_id" class="form-control">
							<?php foreach($equipments as $equipment):?>
							<option value="<?php echo $equipment->id; ?>"<?php if($maintenance->equipment_id == $equipment->id){echo "selected";}?>><?php echo $equipment->name;?></option>      
							<?php endforeach;?>			
						</select>
					</div>
				</div>
			</div>
				
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="service_id">Tipo de Serviço:</label>
						<select name="service_id" id="service_id"  class="form-control">
							<?php foreach($services as $service):?>
							<option value="<?= $service->id;?>"<?php if($maintenance->service_id == $service->id){ echo "selected"; }?>><?= $service->name;?></option>      
							<?php endforeach;?>			
						</select>
						
						
					</div>
				</div>
			</div>
					
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-6">
						<label for="date_initial">Data da Manutenção Inicial</label>
						<input type="date" value="<?php echo $maintenance->date_initial;?>" id="date_initial" name="date_initial"  class="form-control" placeholder="Data Inicial" >
					</div>
				
					<div class="col-md-6">
						<label for="time_initial">Horário  da Manutenção Inicial</label>
						<input type="time" value="<?php echo $maintenance->time_initial;?>" id="time_initial" name="time_initial"  class="form-control" placeholder="Horário Final" >
					</div>
				</div>
			</div>
					
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-6">
						<label for="date_final">Data da Manutenção Final</label>
						<input type="date" value="<?php echo $maintenance->date_final;?>" id="date_final" name="date_final"  class="form-control"  placeholder="Data Final">
					</div>
				
					<div class="col-md-6">
						<label for="time_final">Horário da Manutenção Final</label>
						<input type="time" value="<?php echo $maintenance->time_final;?>" id="time_final" name="time_final"  class="form-control"  placeholder="Hora Final">
					</div>
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="annotations">Anotações</label>
						<textarea type="text"  class="form-control" id="annotations" name="annotations" placeholder="<?php echo $maintenance->annotations;?>"></textarea>
					</div>
				</div>
			</div>
									
		
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="collaborator_name">Manutenção Realizada Por:</label>		
						<select name="collaborator_name"  class="form-control" required>
							<?php foreach($employees as $employee):?>
							<option value="<?= $employee->id;?>" <?php if($maintenance->collaborator_name == $employee->name){echo "selected";}?>><?= $employee->name; ?></option>      
							<?php endforeach;?>
						</select>
						
					</div>	
				</div>		
			</div>
				
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="status_id">Estado do Serviço</label>
						<select name="status_id" id="status_id" class="form-control" required>
							<?php foreach($statuses as $statuse):?>
							<option value="<?php echo $statuse->id; ?>"><?php echo $statuse->name;?></option>
							<?php endforeach; ?>
						</select>
					</div>		
				</div>		
			</div>
			
			<div class="form-row">
				<div class="form-group">
					<div class="col-lg-12">
						<label for="price">Custo Total da Manutenção</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-usd"></i></span>
							<input value="<?php echo $maintenance->price;?>" type="text" id="price" class="form-control" name="price" placeholder="Custo Total da Manutenção">
						</div>
					</div>
				</div>	
			</div>
			
			<div class="form-row">
				<div class="form-group">
					<div class="col-lg-12">
						<button class="btn btn-primary">Agendar Manutenção</button>
					</div>
				</div>
			</div>	
			
		</form>
		
		
		<form  class="form-horizontal" id="external" style="display:none;" action="<?= url("/app/maintenance-edit{$maintenance->id}"); ?>" method="post">
			<input type="hidden" name="action" value="update"/>	
			
			<input type="hidden" name="type_collaborator" value="external_collaborator"/>	
			
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="maintenance_type">Tipo de Manutenção</label>
						<select name="maintenance_type" id="maintenance_type"  class="form-control">			
							<option value="Manutenção Preventiva"<?php if($maintenance->maintenance_type=="Manutenção Preventiva"){echo "selected";}?>>MANUTENÇÃO PREVENTIVA</option>
						    <option value="Manutenção Correntiva"<?php if($maintenance->maintenance_type=="Manutenção Correntiva"){echo "selected";}?>>MANUTENÇÃO CORRENTIVA</option>
							<option value="Manutenção Preditiva"<?php if($maintenance->maintenance_type=="Manutenção Preditiva"){echo "selected";}?>>MANUTENÇÃO PREDITIVA</option>
						</select>
					</div>
				</div>
			</div>
				
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="equipment_id">Equipamento</label>
						<select name="equipment_id" id="equipment_id" class="form-control">
							<?php foreach($equipments as $equipment):?>
							<option value="<?php echo $equipment->id;?>"<?php if($maintenance->equipment_id == $equipment->id){echo "selected";}?>><?php echo $equipment->name;?></option>      
							<?php endforeach;?>			
						</select>
					</div>
				</div>
			</div>
				
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="service_id">Tipo de Serviço:</label>
						<select name="service_id" id="service_id"  class="form-control">
							<?php foreach($services as $service):?>
							<option value="<?php echo $service->id;?>"><?php echo $service->name;?></option>      
							<?php endforeach;?>			
						</select>
					</div>
				</div>
			</div>
					
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-6">
						<label for="date_initial">Data da Manutenção Inicial</label>
						<input type="date" value="<?php echo $maintenance->date_initial;?>" id="date_initial" name="date_initial"  class="form-control" placeholder="Data Inicial" >
					</div>
				
					<div class="col-md-6">
						<label for="time_initial">Horário  da Manutenção Inicial</label>
						<input type="time" value="<?php echo $maintenance->time_initial;?>" id="time_initial" name="time_initial"  class="form-control" placeholder="Horário Final" >
					</div>
				</div>
			</div>
					
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-6">
						<label for="date_final">Data da Manutenção Final</label>
						<input type="date" value="<?php echo $maintenance->date_final;?>" id="date_final" name="date_final"  class="form-control"  placeholder="Data Final">
					</div>
				
					<div class="col-md-6">
						<label for="time_final">Horário da Manutenção Final</label>
						<input type="time" value="<?php echo $maintenance->time_final;?>" id="time_final" name="time_final"  class="form-control"  placeholder="Hora Final">
					</div>
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="annotations">Anotações</label>
						<textarea type="text"  class="form-control" id="annotations" name="annotations" placeholder="<?php echo $maintenance->annotations;?>"></textarea>
					</div>
				</div>
			</div>
									
		
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="collaborator_name">Manutenção Realizada Por:</label>		
						<select name="collaborator_name"  class="form-control" required>
							<?php foreach($suppliers as $supplier):?>
							<option value="<?= $supplier->id;?>" <?php if($maintenance->collaborator_name == $supplier->name){echo "selected";}?>><?= $supplier->name;?></option>      
							<?php endforeach;?>
						</select>
						
					</div>	
				</div>		
			</div>
				
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="status_id">Estado do Serviço</label>
						<select name="status_id" id="status_id" class="form-control" required>
							<?php foreach($statuses as $statuse):?>
							<option value="<?php echo $statuse->id; ?>"><?php echo $statuse->name;?></option>
							<?php endforeach; ?>
						</select>
					</div>		
				</div>		
			</div>
			
			<div class="form-row">
				<div class="form-group">
					<div class="col-lg-12">
						<label for="price">Custo Total da Manutenção</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-usd"></i></span>
							<input value="<?php echo $maintenance->price;?>" type="text" id="price" class="form-control" name="price" placeholder="Custo Total da Manutenção">
						</div>
					</div>
				</div>	
			</div>
			
			<div class="form-row">
				<div class="form-group">
					<div class="col-lg-12">
						<button class="btn btn-primary">Atualizar Agendamento de Manutenção</button>
					</div>
				</div>
			</div>	
	
		</form>
	
	</div>

</div>



<?php $v->start("scripts"); ?>

<script>
  function typeCollaborator(){
    if (document.getElementById('collaborator').value == 'internal'){
      document.getElementById('internal').style.display='block';
      document.getElementById('external').style.display='none';
    }else{
      document.getElementById('external').style.display='block';
      document.getElementById('internal').style.display='none';
    }
  }

</script>




<?php $v->end(); ?>





