<?php $v->layout("_theme"); ?>

<?php if (!empty($events)): ?>
<?php foreach ($events as $event):?>
<?php 	$thejson[] = array(
			"title"=>$event->getEquipment()->name,
			"start"=>$event->date_initial."T".$event->time_initial, 
			"description"=>$event->getEquipment()->name,
			"url"=>"app/maintenance-edit/{$event->id}")
?>

<?php endforeach; ?>
<?php endif; ?>




<?php $v->start("scripts"); ?>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
	 themeSystem: 'bootstrap',
		buttonText: {
		today:    'hoje',
		month:    'mês',
		week:     'semana',
		day:      'dia',
		list:     'lista'
	},
    headerToolbar: {
		left:'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
	timeZoneName: 'short',
	timeZone: 'UTC',
	locale:'pt-br',
    navLinks: true, // can click day/week names to navigate views
    selectable: true,
    selectMirror: true,
    editable: true,
	eventLimit: true, // allow "more" link when too many events
    dayMaxEvents: true, // allow "more" link when too many events
    events: <?php echo json_encode($thejson); ?>
    });

    calendar.render();
  });

</script>
    
<?php $v->end(); ?>



  <div class="app-main">

          <!-- begin .main-heading -->
          <header class="main-heading shadow-2dp">
            <!-- begin dashhead -->
            <div class="dashhead bg-white">
              <div class="dashhead-titles">
                <h6 class="dashhead-subtitle">
					Calendário de Manutenções
                </h6>
                <h3 class="dashhead-title">Calendario</h3>
              </div>

              <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item">
                  
                </div>
              </div>
            </div>
            <!-- END: dashhead -->
          </header>
          <!-- END: .main-heading -->

          <!-- begin .main-content -->
          <div class="main-content bg-clouds">

            <!-- begin .container-fluid -->
            <div class="container-fluid p-t-15">
              
                <div class="col-sm-9">
                  <div class="box">
                    <div class="box-body">
                      <div id="calendar"></div>
                    </div>
                  </div>
                </div>
            </div>

             

          </div>
            <!-- END: .container-fluid -->

          

         

        </div>
        <!-- END: .app-main -->




