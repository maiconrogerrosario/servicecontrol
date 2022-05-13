<?php $v->layout("_theme"); ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Cadastro de Clientes</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <form id="formNovoCliente">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">E-mail</label>
                          <input type="text" class="form-control" id="emailnovocliente"  name="emailnovocliente" >
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Telefone</label>
                          <input type="text" class="form-control" id="telefone" name="telefone" >
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">CPF </label>
                          <input  class="form-control" id="tax_id" name="tax_id">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nome </label>
                          <input type="text" class="form-control" id="name" name="name" >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">CEP</label>
                          <input type="text" class="form-control" id="address_zip" name="address_zip">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Endereço</label>
                          <input type="text" class="form-control" id="address" name="address">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Cidade</label>
                          <input type="text" class="form-control" id="address_city" name="address_city">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">País</label>
                          <input type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Código Postal</label>
                          <input type="text" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Sobre </label>
                          <div class="form-group">
                            <label class="bmd-label-floating" > </label>
                            <textarea class="form-control" rows="5"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" id="btnGravar" class="btn btn-primary pull-right">Salvar</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
						<label>
							<i class="material-icons">camera_alt</i>
							<input style="display:none" type="file" id="arquivocliente" name="arquivocliente"/>
						</label>
					
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
									<img class="img" id="imagemcliente"  src="https://storagearchive.s3.sa-east-1.amazonaws.com/28840033000169/png/1560867943468_noprofileimg.png" />
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category">Alterações sendo realizadas por</h6>
                  <h4 class="card-title">{user}</h4>
                  <p class="card-description">
									Atenção ao informar o código do produto, caso informe um código existente, o mesmo será alterado
                  </p>
									<?php echo date('l jS \of F Y  ');  ?>
                  <a href="/overcrm_php/index.php/clientes" class="btn btn-primary btn-round">Lista de Clientes</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="">
                  MY GITHUB
                </a>
              </li>
              <li>
                <a href="">
                  LINKEDIN
                </a>
              </li>
              <li>
                <a href="">
                  FACEBOOK
                </a>
              </li>
            </ul>
          </nav>
          <!-- <div class="copyright float-right" id="date">
            , Feito <i class="material-icons">favorite</i> por
            <a href="" target="_blank">THIAGO G ROCHA</a> Modelo de CRM.
          </div> -->
        </div>
      </footer>
      <script>
        const x = new Date().getFullYear();
        let date = document.getElementById('date');
				date.innerHTML = '&copy; ' + x + date.innerHTML;
				

      </script>
    </div>
  </div>
  
  
  

