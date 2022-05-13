<?php $v->layout("_theme"); ?>

<div class="app-main">
	<div class="row">
		<div class="col-md-12">
			<div class="btn-group pull-right">
				<!--<div class="btn-group pull-right">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-download"></i> Descargar <span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
					</ul>
				</div>-->
			</div>
			<div class="container-fluid p-t-15">
				<div class="box">
					<header>
						<h3>Categorias De Equipamentos</h3>
						<div class="box-tools">
						</div>
					</header>
				</div>
			<div class="card-content table-responsive">
				<a href="<?= url("/app/equipment-category-add"); ?>" class="btn btn-primary"><i class='fa fa-fw fa-th-list'></i>Nova Categoria</a>
				<br><br>

				<table class="table table-bordered table-hover">
					<thead>
						<th>Nome da Categoria </th>
						<th style="width:80px;"></th>
					</thead>
					<tbody>

						<?php foreach ($categories as $categorie):?>
						<tr>
							<td><?php echo $categorie->name?></td>

							<td style="width:80px;">
							<a href="<?= url("/app/equipments-category/{$categorie->id}"); ?>" class="btn btn-simple btn-warning btn-xs"><i class='fa fa-fw fa-pencil'></i></a>
							<a class="btn-simple btn btn-danger btn-xs" title="" href="#" 
								data-post="<?= url("/app/equipments-category-delete/{$categorie->id}"); ?>"
                                data-action="delete"
                                data-confirm="Tem que deseja deletar essa vinculação?"
                                data-id="<?= $categorie->id;?>"><i class='fa fa-fw fa-remove'></i>Deletar</a>      
								   
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			</div>
		</div>	
	</div>
</div>

		





