
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Lista de Usuários</h4>
                  <p class="card-category"> <?php echo date('l jS \of F Y  ');  ?> </p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        
                        <th>
                          Nome
                        </th>
                        <th>
                          Data Cadastro
                        </th>
                        <th>
                          E-mail
                        </th>
                        <th>
                          Login
                        </th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tbody>
											<?php
										if($usuarios)
											foreach ($usuarios as $usuario){ ?>
                        <tr>   
                          <td>
													<?php echo $usuario->nome ?>
                          </td>
                          <td>
													<?php echo $usuario->datacadastro ?>
                          </td>
                          <td>
													<?php echo $usuario->email ?>
                          </td>
                          <td class="text-primary">
													<?php echo $usuario->login ?>
                          </td>
                          <td><i class="material-icons" data-toggle="modal" data-target="#modalusuario"  onclick="editausuarioLista('<?php echo  $usuario->usuario_id ?>')">edit</i></td>
                          <td><i class="material-icons">delete_forever</i></td>
                        </tr>
                      
                        </tr>
                      </tbody>
						<?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
<!-- MODAL DE EDIT -->
<style>
#formNovoUsuario label,input,textarea{
	color: black !important;
	/*define cor do label e input dos modais*/ 
}
</style>
<!--inicio Modal -->
<div class="modal fade bd-example-modal-lg" id="modalusuario" tabindex="-1" role="dialog" aria-labelledby="labelmodalusuario" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelmodalusuario">Editar Usuário {usuario}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body">
      <div class="modal-body">
			<form id="formNovoUsuario">
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
							<input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $usuario->usuario_id ?>">
								<label class="bmd-label-floating ">E-mail</label>
								<input type="text" class="form-control" id="emailusuario" name="email" placeholder="example@email.com" required value="" >
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label class="bmd-label-floating">Senha</label>
								<input type="text" class="form-control" id="newPassword" name="senha" placeholder=""  value="">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="bmd-label-floating">CPF </label>
								<input  class="form-control" id="newUsertax_id" name="cpf" data-inputmask='"mask": "99999-999"' data-mask name="" required placeholder="Somente numeros" value="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="bmd-label-floating">Nome </label>
								<input type="text" class="form-control" id="newUsername" name="nome" >
							</div>
						</div>
					</div>
					
					<div class="clearfix"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
						<button type="submit" class="btn btn-primary">Salvar</button>
					</div>
					</form>
				<!--fim formulario-->
				</div>
      </div>      
    </div>
  </div>
</div>

<script>

function editausuarioLista(usuario_id) {
    var data = new FormData();
    var url = "/overcrm_php/index.php/Usuarios/resgataUsuario";
    data.append("usuario_id", usuario_id);
    $.ajax({
        url: url,
        data: data,
        processData: false,
        contentType: false,
        type: "POST",
        success: function(data) {
            var retorno = $.parseJSON(data);
            if (retorno.sucesso) {
               
                $("#idusuario").val(retorno[0].usuario_id);
                $("#newUsername").val(retorno[0].nome);
                $("#perfil_id").val(retorno[0].perfil_id);
                $("#emailusuario").val(retorno[0].email);
                $("#newUsertax_id").val(retorno[0].cpf);
                $("#telefone").val(retorno[0].telefone);
                $("#profissaoUsuario").val(retorno[0].profissao);
                $("#address").val(retorno[0].endereco);
                $("#address_district").val(retorno[0].enderecobairro);
                $("#address_city").val(retorno[0].enderecocidade);
                $("#address_zip").val(retorno[0].enderecocep);
                $("#address_state").val(retorno[0].uf);
                $("#perfil").val(retorno[0].imagem_url);
                $("#fotopefilUsuario").attr("src", retorno[0].imagem_url);
                $("#urlPerfilUsuario").val(retorno[0].imagem_url);
                $("#avisosenha").attr("class", "");
                
               
            }
        }
    })
}

</script>