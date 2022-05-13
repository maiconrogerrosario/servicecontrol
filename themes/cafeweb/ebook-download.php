<?php $v->layout("_theme"); ?>



<section  class="gray-section signup">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line2"><br /></div>
                <img alt="<?= $data->title; ?>" title="<?= $data->title; ?>" src="<?= $data->image; ?>"/>
                <h1><?= $data->title; ?></h1>
                <a class="btn btn-sm btn-primary btn-lg float-left m-t-n-xs cmc-contato-botao-enviar"
                   href="<?= $data->link; ?>" title="Dicas de Martketing para Empresa de Energia Solar">
                    <strong>Abaixar Ebook</strong>
                </a>
            </div>
        </div>	
	 </div>	
</section>



<?php if (!empty($track)): ?>
    <?php $v->start("scripts"); ?>
    <script>
        fbq('track', '<?= $track->fb;?>');
        gtag('event', 'conversion', {'send_to': '<?= $track->aw;?>'});
    </script>
    <?php $v->end(); ?>
<?php endif; ?>
