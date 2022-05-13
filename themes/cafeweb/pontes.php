<?php $v->layout("_theme"); ?>

<section  class="gray-section signup">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line2"><br /></div>
                <h1>Pontes</h1>
                 <p>Preencha seus dados e clique em enviar</p>
            </div>
        </div>
        <div class="row m-b-lg cmc-contato-formulario">
            <div class="col-lg-2"><br /></div>
            <div class="col-lg-8">
               
                <form action="<?= url("/pontes"); ?>"  method="post">


                    <div class="form-group">
                        <label>Ponte:</label>
						<input type="hidden" name="action" value="create"/>

							<select name="name" class="form-control">
								<option value="MCPR01">MCPR-01</option>
								<option value="MCPR02">MCPR-02</option>
								<option value="MCPR03">MCPR-03</option>
								<option value="MCPR04">MCPR-04</option>
								<option value="MCPR05">MCPR-05</option>
								<option value="MCPR06">MCPR-06</option>
								<option value="MCPR07">MCPR-07</option>
								<option value="MCPR08">MCPR-08</option>
								<option value="MCPR09">MCPR-09</option>
								<option value="MCPR10">MCPR-10</option>
								<option value="MCPR11">MCPR-11</option>
								<option value="MCPR12">MCPR-12</option>
								<option value="MCPR13">MCPR-13</option>
								<option value="MCPR14">MCPR-14</option>
								<option value="MCPR15">MCPR-15</option>
								<option value="MCPR16">MCPR-16</option>
								<option value="MCPR17">MCPR-17</option>
								<option value="MCPR18">MCPR-18</option>
								<option value="MCPR19">MCPR-19</option>
								<option value="MCPR20">MCPR-20</option>
								<option value="MCPR21">MCPR-21</option>
								<option value="MCPR22">MCPR-22</option>
								<option value="MCPR23">MCPR-23</option>
								<option value="MCPR24">MCPR-24</option>
								<option value="MCPR25">MCPR-25</option>
								<option value="MCPR26">MCPR-26</option>
								<option value="MCPR27">MCPR-27</option>
								<option value="MCPR28">MCPR-28</option>
								<option value="MCPR29">MCPR-29</option>
								<option value="MCPR30">MCPR-30</option>
								<option value="MCPR31">MCPR-31</option>
								<option value="MCPR32">MCPR-32</option>
								<option value="MCPR33">MCPR-33</option>
								<option value="MCPR34">MCPR-34</option>
								<option value="MCPR35">MCPR-35</option>
								<option value="MCPR36">MCPR-36</option>
							</select>        

                    </div>
					
					<div class="form-group">
					
						<label >Fim de Curso Ponte:</label>
							<select name="fimdecurso" class="form-control">
								<option value="norte">Ligado no Botão Norte do Controle</option>
								<option value="sul">Ligado no Botão Sul do Controle</option>
								<option value="not">Não Possue Fim de Curso</option>
							</select>        
					  
					</div>
					
					<div class="form-group">
				
							<label>Posição Anticolisão 1</label>
								<select name="anticolisao1" class="form-control form-control-lg">
									<option value="norte">Ligado no Botão Norte do Controle</option>
								<option value="sul">Ligado no Botão Sul do Controle</option>
								</select>        
					
					</div>	

					<div class="form-group">
					
						<label>Posição Anticolisão 2</label>
							<select name="anticolisao2" class="form-control"/>
								<option value="norte">Ligado no Botão Norte do Controle</option>
								<option value="sul">Ligado no Botão Sul do Controle</option>
								<option value="not">Não Possue Anticolisão 2</option>
						</select>        
					
					</div>	
					
					
					<div class="form-group">
					
						<label>Observações:</label>
							<textarea name="observacao" class="form-control"/></textarea>        
					
					</div>	

                    <div><br />
                        <button class="btn btn-sm btn-primary btn-lg float-left m-t-n-xs cmc-contato-botao-enviar"><strong>Enviar Dados</strong></button>
                        <img  class="cmc-loader-enviar-cadastro-contato cmc-oculto"/>
                    </div>
                </form>
            </div>
            <div class="col-lg-2"><br /></div>
        </div>
        <div class="row cmc-contato-mensagem-resultado">
        </div>
    </div>
</section>