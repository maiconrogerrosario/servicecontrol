<?php $v->layout("_theme"); ?>

 <div class="main-content bg-clouds">
    <!-- begin .container-fluid -->
    <div class="container-fluid p-t-15">
        <div class="box">
            <header class="bg-primary">
				<h3>Editar Dados do Paciente</h3>
            </header>	
		</div>
		<form class="form-horizontal" method="post" id="addproduct" action="<?= url("/app/supplier-edit/{$pacient->id}"); ?>" role="form">
			<div class="form-group">
				<input type="hidden" name="action" value="update"/>
				<label for="inputEmail1" class="col-lg-2 control-label">Nome*</label>
				<div class="col-md-6">
					<input type="text" name="name" value="<?php echo $pacient->name;?>" class="form-control" id="name" placeholder="Nome">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Sobrenome*</label>
				<div class="col-md-6">
					<input type="text" name="lastname" value="<?php echo $pacient->lastname;?>" required class="form-control" id="lastname" placeholder="Sobrenome">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Genero*</label>
				<div class="col-md-6">
					<label class="checkbox-inline">
						<input type="radio" id="inlineCheckbox1" name="gender" required <?php if($pacient->gender=="h"){ echo "checked"; }?> value="h"> Homem
					</label>
					<label class="checkbox-inline">
						<input type="radio" id="inlineCheckbox2" name="gender" required <?php if($pacient->gender=="m"){ echo "checked"; }?> value="m"> Mulher
					</label>
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Data de Nascimento</label>
				<div class="col-md-6">
					<input type="date" name="day_of_birth" class="form-control" value="<?php echo $pacient->day_of_birth; ?>"  id="address1" placeholder="Data de Nascimento">
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Endereço*</label>
				<div class="col-md-6">
					<input type="text" name="address" value="<?php echo $pacient->address;?>" class="form-control" required id="pacientname" placeholder="Endereço">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
				<div class="col-md-6">
					<input type="text" name="email" value="<?php echo $pacient->email;?>" class="form-control" id="email" placeholder="Email">
				</div>
			</div>

			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Telefone</label>
				<div class="col-md-6">
					<input type="text" name="phone"  value="<?php echo $pacient->phone;?>"  class="form-control" id="inputEmail1" placeholder="Telefone">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Doença</label>
				<div class="col-md-6">
					<textarea name="sick" class="form-control" id="sick" placeholder="Doença"><?php echo $pacient->sick;?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Toma alguma Medicação</label>
				<div class="col-md-6">
					<textarea name="medicaments" class="form-control" id="sick" placeholder="Toma alguma Medicação"><?php echo $pacient->medicaments;?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmail1" class="col-lg-2 control-label">Possue Alergia</label>
				<div class="col-md-6">
					<textarea name="alergy" class="form-control" id="sick" placeholder="Possue Alergia"><?php echo $pacient->alergy;?></textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<input type="hidden" name="pacient_id" value="<?php echo $pacient->id;?>">
					<button type="submit" class="btn btn-primary">Atualizar dados do Paciente</button>
				</div>
			</div>
		</form>	
	</div>
</div>
