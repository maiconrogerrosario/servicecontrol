<?php $v->layout("_theme"); ?>

 <div class="main-content bg-clouds">
    <!-- begin .container-fluid -->
    <div class="container-fluid p-t-15">
        <div class="box">
            <header class="bg-primary">
				<h4>Atualizar de Equipamento</h4>
            </header>	
		</div>
		<form class="form-horizontal" action="<?= url("/app/equipment-edit/{$equipments->id}"); ?>" method="post">
			<div class="form-group">
				<label for="category_id" class="col-lg-2 control-label">Tipo de Equipamento</label>
				<div class="col-md-6">
					<input type="hidden" name="action" value="update"/>
					<select name="category_id" class="form-control">
					<?php foreach ($categories as $category): ?>
						<option value="<?php echo $category->id; ?>" <?php if($equipments->category_id==$category->id){ echo "selected"; }?>><?php echo $category->name; ?></option> 
					<?php endforeach;?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="name" class="col-lg-2 control-label">Equipamento</label>
				<div class="col-md-6">
					<input type="text" value="<?php echo $equipments->name; ?>" name="name" class="form-control" id="name" placeholder="Equipamento (Indentificação Descrição)">
				</div>
			</div>
			
			
			<div class="form-group">
				<label for="localization" class="col-lg-2 control-label">Localização</label>
				<div class="col-md-6">
					<input type="text" value="<?php echo $equipments->localization;?>" name="localization" class="form-control" id="localization" placeholder="Localização">
				</div>
			</div>

			<div class="form-group">
				<label for="tag" class="col-lg-2 control-label">Tagueamento</label>
				<div class="col-md-6">
					<input type="text" value="<?php echo $equipments->tag;?>" name="tag" required class="form-control" id="tag" placeholder="Tagueamento">
				</div>
			</div>

			<div class="form-group">
				<label for="supplier_id" class="col-lg-2 control-label">Fornecedor</label>
				<div class="col-md-6">
					<select name="supplier_id" class="form-control">
					<?php foreach ($suppliers as $supplier): ?>
						<option value="<?php echo $supplier->id; ?>" <?php if($equipments->supplier_id==$supplier->id){ echo "selected"; }?> ><?php echo $supplier->name; ?></option>      
					<?php endforeach;?>
					</select>
				</div>
			</div>	

					
			
			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<button type="submit" class="btn btn-primary">Atualizar Equipamento</button>
				</div>
			</div>
		</form>
	</div>
</div>