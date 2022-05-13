
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Cadastro de  Usuários</h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <form id="formNovoUsuario">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <input type="hidden" id="usuario_id" name="usuario_id" value="">
                          <label class="bmd-label-floating ">E-mail</label>
                          <input type="text" class="form-control" id="newUseremail" name="email" placeholder="example@email.com" required value="" >
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Senha</label>
                          <input type="text" class="form-control" id="newPassword" name="senha" placeholder="" required value="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">CPF </label>
                          <input  class="form-control" id="newUsertax_id" name="cpf" data-inputmask='"mask": "99999-999"' data-mask name="" required placeholder="Somente numeros" value="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nome </label>
                          <input type="text" class="form-control" id="newUsername" name="nome" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Sobre mim</label>
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
							<input style="display:none" type="file" id="arquivouser" name="arquivouser"/>
						</label>
					
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo"><img class="img" id="imagemuser"  src="https://storagearchive.s3.sa-east-1.amazonaws.com/28840033000169/png/1560867943468_noprofileimg.png" /> <img class="img" src="../assets/img/faces/marc.jpg" />
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category">Alterações sendo realizadas por</h6>
                  <h4 class="card-title">{user}</h4>
                  <p class="card-description">
										Atenção ao informar o código do produto, caso informe um código existente, o mesmo será alterado
                  </p>
									<?php echo date('l jS \of F Y  ');  ?>
                  <a href="/overcrm_php/index.php/usuarios" class="btn btn-primary btn-round">Lista de Usuários</a>
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
  
  
  
