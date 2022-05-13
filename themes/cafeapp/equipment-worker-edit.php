<?php $v->layout("_theme"); ?>

 <div class="main-content bg-clouds">
    <!-- begin .container-fluid -->
    <div class="container-fluid p-t-15">
        <div class="box">
            <header class="bg-primary">
				<h4>Editar Vinculação do Usuário</h4>
            </header>	
		</div>
	
		<form class="form-horizontal" action="<?= url("/app/equipment-worker-edit/{$equipmentworker->id}"); ?>" method="post">
			<input type="hidden" name="action" value="update"/>	
				
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="equipment_id">Equipamento</label>
						<select name="equipment_id" id="equipment_id" class="form-control" required>
							<option value="<?php echo $equipmentworker->equipment_id; ?>"><?php echo $equipmentworker->getEquipment()->name;?></option>      
						</select>
					</div>
				</div>
			</div>
			
			<div class="form-row" >
				<div class="form-group">
					<div class="col-md-12">
						<label for="employee_id" >Funcionário</label>
						<select name="employee_id" id="employee_id"   class="form-control">	
							<option value="<?php echo $equipmentworker->employee_id; ?>"><?php echo $equipmentworker->getEmployee()->name;?></option>      
						</select>
					</div>	
				</div>		
			</div>

			<div class="form-row" >
				<div class="form-group">
					<div class="col-md-12">
						<label for="status" >Status</label>
						<select name="status" id="status"   class="form-control">	
							<option value="ATIVO" <?php if($equipmentworker->status == "ATIVO"){echo "selected";}?> >VINCULAÇÃO ATIVA</option>
							<option value="INATIVO"  <?php if($equipmentworker->status == "INATIVO"){echo "selected";}?> >VINCULAÇÃO INATIVA</option>
						</select>
					</div>	
				</div>		
			</div>
			
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="observation">Observaçãoes</label>
						<textarea type="text" class="form-control" id="observation" name="observation" placeholder="observaçãoes"><?php echo $equipmentworker->observation;?></textarea>
					</div>
				</div>
			</div>	
		
			<div class="form-row">
				<div class="form-group">
					<div class="col-lg-12">
						<button class="btn btn-primary">Criar Vinculação</button>
					</div>
				</div>
			</div>	
			
		</form>
		
	</div>

</div>









