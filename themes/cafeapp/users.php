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
						<h3>Fornecedores</h3>
						<div class="box-tools">
						</div>
					</header>
				</div>
			<div class="card-content table-responsive">
				<a href="<?= url("/app/supplier-add"); ?>" class="btn btn-primary"><i class='fa fa-fw fa-male'></i>Novo Fornecedor</a>
				<br><br>

				<table class="table table-bordered table-hover">
					<thead>
						<th>Nome</th>
						<th>Email</th>
						<th>Telefone</th>
						<th>Ativo</th>
						<th>Status</th>
						<th></th>
					</thead>
					<tbody>

						<?php foreach ($users as $user):?>
						
						<tr>
							<td><?php echo $user->name;?></td>
							<td><?php echo $user->email; ?></td>
							<td><?php echo $user->contact; ?></td>
							<td><?php echo $supplier->phone; ?></td>
							<td style="width:280px;">
							<a href="<?= url("/app/pacienthistory"); ?>" class="btn btn-primary btn-xs">Historico</a>
							<a href="<?= url("/app/supplier-edit/{$supplier->id}"); ?>" class="btn btn-warning btn-xs">Editar</a>
							<a class="btn btn-danger btn-xs" title="" href="#"
                                   data-post="<?= url("/app/supplier-edit/{$supplier->id}"); ?>"
                                   data-action="delete"
                                   data-confirm="Tem certeza que deseja deletar esse Usuario?"
                                   data-supplier_id="<?= $supplier->id; ?>">Deletar</a>
						
						
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
			</table>
		</div>
	</div>
</div>