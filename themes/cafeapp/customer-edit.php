<?php $v->layout("_theme"); ?>

 <div class="main-content bg-clouds">
    <!-- begin .container-fluid -->
    <div class="container-fluid p-t-15">
        <div class="box">
            <header class="bg-primary">
				<h4>Editar Cliente</h4>
            </header>	
		</div>
	
		<form class="form-horizontal" action="<?= url("/app/customer-edit/{$customer->id}"); ?>" method="post">
			<input type="hidden" name="action" value="update"/>
			
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="name">Nome do Cliente:</label>
						<input type="text" value="<?php echo $customer->name;?>" class="form-control" id="name" name="name" placeholder="Razão Social:"/>			
					</div>
				</div>
			</div>
			
			
			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-6">
						<label for="email">Email</label>
						<input type="email" value="<?php echo $customer->email;?>" class="form-control" id="email" placeholder="Email" name="email"/>
					</div>
					<div class=" col-md-6">
						<label for="document">CPF/CNPJ</label>
						<input type="text" value="<?php echo $customer->document;?>" class="form-control mask-doc2" id="document" placeholder="CNPJ" name="document"/>
					</div>
				</div>
            </div>
							
			<div class="form-row">
				<div class="form-group">
					<div class="col-md-12">
						<label for="contact">Contato</label>
						<input id="contact" value="<?php echo $customer->contact;?>" type="text" class="form-control" name="contact" placeholder="contact" />
					</div>	
				</div>					
			</div>

			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-6">
						<label for="phone1">Telefone</label>
						<input id="phone1" value="<?php echo $customer->phone1;?>"  type="text" class="form-control mask-phone" name="phone1" placeholder="(00)0000-0000" />
					</div>
					<div class=" col-md-6">
							<label for="mobile">Telefone Celular</label>
							<input id="mobile" value="<?php echo $customer->mobile;?>"  type="text" class="form-control mask-mobile" name="mobile" placeholder="(00)00000-0000" />
					</div>
				</div>
            </div>
			
			
			<div class="form-row">
			    <div class="form-group">	
					<div class="col-md-6">
						<label for="phone2">Telefone para Contato </label>
						<input id="phone2" value="<?php echo $customer->phone2;?>"   type="text" class="form-control mask-phone" name="phone2" placeholder="(00)0000-0000"/> 
					</div>
					<div class="col-md-6">
						<label for="fax">Fax</label>
						<input id="fax" type="text" value="<?php echo $customer->fax;?>" class="form-control mask-phone" name="fax" placeholder="(00)0000-0000"/>
					</div>
				</div>
            </div>
			
			
			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-10">
						<label for="address_street">Lograouro:</label>
						<input type="text" value="<?php echo $customer->address_street;?>" class="form-control"  id="address_street" name="address_street" placeholder="Lograouro"/>
					</div>
					<div class=" col-md-2">
						<label for="address_number">Número:</label>
						<input type="text" value="<?php echo $customer->address_number;?>" class="form-control" id="address_number" name="address_number" placeholder="Número" />
					</div>
				</div>
            </div>
			
			
			
			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-6">
						<label for="address_neighborhood">Bairro</label>
						<input type="text" value="<?php echo $customer->address_neighborhood;?>" class="form-control" id="address_neighborhood" name="address_neighborhood" placeholder="Bairro"/>
					</div>
					<div class=" col-md-6">
						<label for="address_complement">Complemento</label>
						<input  type="text" value="<?php echo $customer->address_complement;?>"  class="form-control" id="address_complement" name="address_complement" placeholder="Complemento"/>
					</div>
				</div>
            </div>		
			
			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-6">
						<label for="address_postalcode">CEP</label>
						<input type="text" value="<?php echo $customer->address_postalcode;?>" class="form-control mask-cep" id="address_postalcode" name="address_postalcode" placeholder="00000-000"/>
					</div>	
					<div class="col-md-6">
						<label for="address_city">Cidade</label>
						<input type="text" value="<?php echo $customer->address_city;?>" class="form-control" id="address_city" placeholder="Cidade" name="address_city"/>
					</div>	
				</div>
            </div>
			
			
			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-6">
						<label for="address_state">Estado</label>
						<input type="text" value="<?php echo $customer->address_state;?>" class="form-control" id="address_state" name="address_state" placeholder="Estado"/>
					</div>
					<div class=" col-md-6">
						<label for="address_country">Páis</label>
						<input type="text" value="<?php echo $customer->address_country;?>" class="form-control" id="address_country" name="address_country" placeholder="País"/>
					</div>
				</div>
            </div>
			

			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-12">
						<label for="observation">Observação</label>			
						<textarea  type="text"  name="observation"  class="form-control" id="observation" placeholder="Observação"><?php echo $customer->observation;?></textarea>
					</div>
				</div>
            </div>
						
			
			<div class="form-row">
			    <div class="form-group">
					<div class="col-md-4">
						<button type="submit" class="btn btn-primary">Atualizar</button>
					</div>
					
				</div>
            </div>		
		</form>		
	</div>
</div>




