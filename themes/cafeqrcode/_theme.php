<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?= $head; ?>

   <link rel="stylesheet" href="<?= url("/shared/assets/css/vendor.css"); ?>"/>

	<link  href="<?= url("/shared/scripts/fullcalendar/fullcalendar.min.css"); ?>" rel="stylesheet"/>
	<link  href="<?= url("/shared/css/main.css"); ?>" rel='stylesheet'/>



  <!-- END: plugin stylesheet files -->

  <!-- Theme main stlesheet files. REQUIRED -->
  <link rel="stylesheet" href="<?= url("/shared/assets/css/chaldene.css"); ?>"/>
  <link id="theme-list" rel="stylesheet" href="<?= url("/shared/assets/css/theme-peter-river.css"); ?>">
  <!-- END: theme main stylesheet files -->


  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">



</head>

<body>

 
 <!-- begin .app -->
  <div class="app">
	<div class="ajax_load" style="z-index: 999;">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<div class="ajax_response"><?= flash(); ?></div>
  
    <!-- begin .app-wrap -->
    <div class="app-wrap">
      <!-- begin .app-heading -->
      <header class="app-heading">
        <header class="canvas is-fixed is-top bg-white p-v-15 shadow-4dp" id="top-search">

          <div class="container-fluid">
            <div class="input-group input-group-lg icon-before-input">
              <input type="text" class="form-control input-lg b-0" placeholder="Search forshared.">
              <div class="icon z-3">
                <i class="fa fa-fw fa-lg fa-search"></i>
              </div>
              <span class="input-group-btn">
                <button data-target="#top-search" data-toggle="canvas" class="btn btn-danger btn-line b-0">
                  <i class="fa fa-fw fa-lg fa-times"></i>
                </button>
              </span>
            </div>
            <!-- /input-group -->
          </div>

        </header>
        <!-- begin .navbar -->
        <nav class="navbar navbar-default navbar-static-top shadow-2dp">
          <!-- begin .navbar-header -->
          <div class="navbar-header">
            <!-- begin .navbar-header-left with image -->
            <div class="navbar-header-left b-r">
              <!--begin logo-->
               <a class="logo" href="<?= url("/app"); ?>" title="CaféApp">
                <span class="logo-xs visible-xs">
                </span>
                <span class="logo-lg hidden-xs">
                </span>
              </a>
              <!--end logo-->
            </div>
            <!-- END: .navbar-header-left with image -->
           
		   

           
          </div>
          <!-- END: .navbar-header -->
        </nav>
        <!-- END: .navbar -->
      </header>
      <!-- END:  .app-heading -->

      <!-- begin .app-container -->
      <div class="app-container">

        <!-- begin .app-side -->
        
        <!-- END: .app-side -->

        <!-- begin side-collapse-visible bar -->
     
        <!-- begin side-collapse-visible bar -->

        <!-- begin .app-main -->

         
             <?= $v->section("content"); ?>
        

        
        <!-- END: .app-main -->
      </div>
      <!-- END: .app-container -->

      <!-- begin .app-footer -->
      <footer class="app-footer p-t-10 text-white">
        <div class="container-fluid">
          <p class="text-center small">
            3wsoftware Desenvolvimento de Sistemas
          </p>
        </div>
      </footer>
      <!-- END: .app-footer -->

    </div>
    <!-- END: .app-wrap -->
  </div>
  <!-- END: .app -->


  
  <span class="fa fa-angle-up" id="totop" data-plugin="totop"></span>

  <!-- begin theme-switcher. DEMO ONLY! -->
  <div class="canvas is-right is-fixed bg-white shadow-4dp" id="style-switcher">
    <div class="h1 demo-header shadow-4dp" data-target="#style-switcher" data-toggle="canvas">
      <i class="fa fa-fw fa-cog"></i>
    </div>
    <div class=p-a-15>

      <div>

        <!-- Nav tabs -->
        <ul class="nav nav-bordered nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#page" aria-controls="page" role="tab" data-toggle="tab">Page</a></li>
          <li role="presentation"><a href="#theme" aria-controls="theme" role="tab" data-toggle="tab">Theme</a></li>
          <li role="presentation"><a href="#layout" aria-controls="layout" role="tab" data-toggle="tab">Layout</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="page">
            <form class="p-a-15" id="page-form">
              <div class="form-group">
                <label class="radio-inline">
                  <input type="radio" name="p-l" value="0" checked> Fluid
                </label>
                <label class="radio-inline">
                  <input type="radio" name="p-l" value="1"> Fixed
                </label>
                <div class="psc collapse">
                  <fieldset id="plm" disabled>
                    <label class="checkbox-inline">
                      <input type="checkbox" id="plmv" value="2"> Main
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" id="plsv" value="3"> Sidebar
                    </label>
                  </fieldset>
                </div>
              </div>
              <hr>

              <div class="nss hidden">
                <div class="form-group">
                  <label>Navbar Style</label>
                </div>
                <div class="form-group">
                  <label class="radio-inline">
                    <input type="radio" name="ns" value="1" checked> Static
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="ns" value="0"> Fixed
                  </label>
                </div>
                <hr class="b-s-dashed">
              </div>

              <div class="nbc">
                <div class="form-group">
                  <label>Navbar Color</label>
                </div>
                <div class="form-group">
                  <label class="radio-inline">
                    <input type="radio" name="nc" value="1" checked>White
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="nc" value="0">Inverse
                  </label>
                </div>
                <hr class="b-s-dashed">
              </div>

              <div class="psc collapse">
                <div class="form-group">
                  <label>Sidebar Hoverable</label>
                </div>
                <div class="form-group">
                  <label class="radio-inline">
                    <input type="radio" name="hs" value="1" id="hs1"> Add
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="hs" value="0" checked id="hs0"> Remove
                  </label>
                </div>

                <hr class="b-s-dashed">
              </div>

              <div class="form-group">
                <label>Page Width</label>
              </div>
              <div class="form-group">
                <label class="radio-inline">
                  <input type="radio" name="pw" value="0" checked> Wide
                </label>
                <label class="radio-inline">
                  <input type="radio" name="pw" value="1"> Boxed
                </label>
              </div>

            </form>
          </div>
          <div role="tabpanel" class="tab-pane" id="theme">
            <nav class="theme-list u-flex u-flexWrap u-flexRow u-flexJustifyBetween">
              <a class="m-v-5" href="#" rel="../assets/css/theme-peter-river.css">
                <img src="../assets/img/theme-peter-river.svg" alt="peter-river">
              </a>
              <a class="m-v-5" href="#" rel="../assets/css/theme-turquoise.css">
                <img src="../assets/img/theme-turquoise.svg" alt="turquoise">
              </a>
              <a class="m-v-5" href="#" rel="../assets/css/theme-amethyst.css">
                <img src="../assets/img/theme-amethyst.svg" alt="amethyst">
              </a>
              <a class="m-v-5" href="#" rel="../assets/css/theme-orange.css">
                <img src="../assets/img/theme-orange.svg" alt="orange">
              </a>
              <a class="m-v-5" href="#" rel="../assets/css/theme-alizarin.css">
                <img src="../assets/img/theme-alizarin.svg" alt="alizarin">
              </a>
            </nav>
          </div>
          <div role="tabpanel" class="tab-pane" id="layout">
            <ul class="nav layout-list">
              <li><a href="../first/index.html">
                  <img src="../assets/img/theme1.svg" alt="theme 1" />
                </a></li>
              <li><a href="../second/index.html">
                  <img src="../assets/img/theme2.svg" alt="theme 2" />
                </a></li>
              <li><a href="../third/index.html">
                  <img src="../assets/img/theme3.svg" alt="theme 3" />
                </a></li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- END: theme-switcher. -->
 
 
  <script  src="  <?= url("/shared/assets/js/vendor.js"); ?>"></script>
  <script  src="  <?= url("/shared/assets/js/chaldene.js"); ?>"></script>
  <script  src="  <?= url("/shared/assets/js/pagejs/dashboard.js"); ?>"></script>
  <script  src="  <?= url("/shared/assets/js/highlight/highlight.pack.js");?>"></script>
  <script  src="  <?= url("/shared/js/datatables.js");?>"></script>
  <script  src="  <?= url("/shared/scripts/main.js");?>"></script>

  
	

  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready(function()
    {
      $('pre code').each(function(i, block)
      {
        hljs.highlightBlock(block);
      });
    });

  </script>

  <script src="<?= theme("/assets/scripts.js", CONF_VIEW_QRCODE); ?>"></script>
  <?= $v->section("scripts"); ?>
  

 
 
</body>

</html>
