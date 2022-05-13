
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Cadastro de Produtos</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <form id="formProdutos">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                        <input type="hidden" class="form-control" id="idproduto" name="produto_id" value="">
                          <label class="bmd-label-floating">Código</label>
                          <input type="text" class="form-control" id="codigo" name="codigo" value="">
                          
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group">
                        <label class="bmd-label-floating">Categoria </label>
												<input type="text" class="form-control"  id="categoria" >

                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label class="bmd-label-floating">Unidade </label>
											<input type="text" class="form-control"  name="unidademedida_id" id="unidadeProduto" >
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Estoque </label>
                          <input type="text" class="form-control"  id="estoqueProduto" >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nome</label>
                          <input type="text" class="form-control" id="nomeProduto" name="nome">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Status</label>
													<input type="text" class="form-control" name="flagexcluido" id="prodflagexcluido">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Fabricante</label>
                          <input type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Marca</label>
                          <input type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Preço</label>
                          <input type="text" class="form-control"  id="precoProduto" name="tpreco01" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'digits': 2, 'digitsOptional': false, 'prefix': 'R$ ', 'placeholder': '0'" data-mask >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Descrição do Produto</label>
                          <div class="form-group">
                            <label class="bmd-label-floating" > </label>
                            <textarea class="form-control" rows="5"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right" id="btnGravar">Salvar</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
						<label>
							<i class="material-icons">camera_alt</i>
							<input style="display:none" type="file" id="arquivoproduto" name="arquivoproduto"/>
						</label>
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
									<img class="img" id="imagemproduto"  src="https://storagearchive.s3.sa-east-1.amazonaws.com/28840033000169/png/1560867943468_noprofileimg.png" />
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category">Alterações sendo realizadas por</h6>
                  <h4 class="card-title">{user}</h4>
                  <p class="card-description">
                    Atenção ao informar o código do produto, caso informe um código existente, o mesmo será alterado
                  </p>
									<?php echo date('l jS \of F Y  ');  ?>
                  <a href="/overcrm_php/index.php/produtos" class="btn btn-primary btn-round">Lista de Produtos</a>
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
  
  
  
