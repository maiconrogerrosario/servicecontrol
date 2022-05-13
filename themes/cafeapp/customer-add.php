<?php $v->layout("_theme"); ?>

 <div class="main-content bg-clouds">
    <!-- begin .container-fluid -->
    <div class="container-fluid p-t-15">
        <div class="box">
            <header class="bg-primary">
				<h4>Novo Cliente</h4>
            </header>	
		</div>
	
		<form class="form-horizontal" action="<?= url("/app/supplier-add"); ?>" method="post">
			<input type="hidden" name="action" value="create"/>
			
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="name">Nome do Cliente</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Razão Social:"/>
					</div>
				</div>
			</div>
				
			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-6">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" placeholder="Email" name="email"/>
					</div>
					<div class=" col-md-6">
						<label for="document">CNPJ/CPF</label>
						<input type="text" class="form-control mask-doc2" id="document" placeholder="00.000.000/0000-00" name="document"/>
					</div>
				</div>
            </div>
							
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-6">
						<label for="contact">Contato</label>
						<input id="contact"  type="text" class="form-control" name="contact" placeholder="Contato" />
					</div>
				</div>					
			</div>

			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-6">
						<label for="phone1">Telefone</label>
						<input id="phone1"  type="text" class="form-control mask-phone" name="phone1" placeholder="(00)0000-0000" />
					</div>
					<div class=" col-md-6">
							<label for="mobile">Telefone Celular</label>
							<input id="mobile"  type="text" class="form-control mask-mobile" name="mobile" placeholder="(00)00000-0000" />
					</div>
				</div>
            </div>
			
			
			<div class="form-row">
			    <div class="form-group">	
					<div class="col-md-6">
						<label for="phone2">Telefone para Contato </label>
						<input id="phone2"  type="text" class="form-control mask-phone" name="phone2" placeholder="(00)0000-0000"/> 
					</div>
					<div class="col-md-6">
						<label for="fax">Fax</label>
						<input id="fax" type="text" class="form-control mask-phone" name="fax" placeholder="(00)0000-0000"/>
					</div>
				</div>
            </div>
			
			
			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-10">
						<label for="address_street">Lograouro:</label>
						<input type="text" class="form-control"  id="address_street" name="address_street" placeholder="Lograouro"/>
					</div>
					<div class=" col-md-2">
						<label for="address_number">Número:</label>
						<input type="text" class="form-control" id="address_number" name="address_number" placeholder="Número" />
					</div>
				</div>
            </div>
			
			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-6">
						<label for="address_neighborhood">Bairro</label>
						<input type="text" class="form-control" id="address_neighborhood" name="address_neighborhood" placeholder="Bairro"/>
					</div>
					<div class=" col-md-6">
						<label for="address_complement">Complemento</label>
						<input  type="text" class="form-control" id="address_complement" name="address_complement" placeholder="Complemento"/>
					</div>
				</div>
            </div>		
			
			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-6">
						<label for="address_postalcode">CEP</label>
						<input type="text" class="form-control mask-cep" id="address_postalcode" name="address_postalcode" placeholder="00000-000"/>
					</div>
					<div class="col-md-6">
						<label for="address_city">Cidade</label>
						<input type="text" class="form-control" id="address_city" placeholder="Cidade" name="address_city"/>
					</div>
				</div>
            </div>
			
			
			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-6">
						<label for="address_state">Estado</label>
						<input type="text" class="form-control" id="address_state" name="address_state" placeholder="Estado"/>
					</div>
					<div class=" col-md-6">
						<label for="address_country">Páis</label>
						<input type="text" class="form-control" id="address_country" name="address_country" placeholder="País"/>
					</div>
				</div>
            </div>
			

			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-12">
						<label for="observation">Observação</label>			
						<textarea name="observation" class="form-control" id="observation" placeholder="Observação"></textarea>
					</div>
				</div>
            </div>
						
			
			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-4">
						<button type="submit" class="btn btn-primary">Cadastrar</button>
					</div>		
				</div>
            </div>		
		</form>		
	</div>
</div>




