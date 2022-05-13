<?php
namespace Source\Support;

use Dompdf\Dompdf;
use Dompdf\Options;
use Source\Core\Controller;
use Source\Core\Session;
use Source\Core\View;
use Source\Models\Auth;
use Source\Models\CafeApp\AppCategory;
use Source\Models\CafeApp\AppInvoice;
use Source\Models\CafeApp\AppOrder;
use Source\Models\CafeApp\AppPlan;
use Source\Models\CafeApp\AppSubscription;
use Source\Models\CafeApp\AppWallet;
use Source\Models\Post;
use Source\Models\Report\Access;
use Source\Models\Report\Online;
use Source\Models\User;
use Source\Support\Email;
use Source\Support\QRC;
use Source\Support\Thumb;
use Source\Support\Upload;
use Source\Support\Pager;
use Source\Models\Reservation;
use Source\Models\Status;
use Source\Models\Payment;
use Source\Models\Works;
use Source\Models\Customer;
use Source\Models\Maintenance;
use Source\Models\Equipment;
use Source\Models\SupplierType;
use Source\Models\Stage;
use Source\Models\Task;
use Source\Models\StageCategory;
use Source\Models\EquipmentCategory;
use Source\Models\EquipmentWorker;
use Source\Models\EquipmentFile;
use Source\Models\EquipmentQrcode;
use Source\Models\ServiceCategory;
use Source\Models\OccupationCategory;
use Source\Models\CollaboratorCategory;
use Source\Models\Supplier;
use Source\Models\Employee;
use Source\Models\ProjectFile;

/**
 * FSPHP | Class Email
 *
 * @author Maicon Roger do Rosario <maiconrogerrosario@gmail.com>
 * @package Source\Core
 */
class PDF extends Controller
{
    /** @var array */
    private $dompdf;

     private $options;


    /**
     * Qrcode constructor.
     */
    public function __construct()
    {
		
		parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_WORK . "/");
		
		$this->options = new Options();
		$setoptions= $this->options->set('defaultFont', 'Courier');
		$this->options->setIsHtml5ParserEnabled(true);
		$this->dompdf = new Dompdf($this->options);


		
    }

    /**
     * @param string $subject
     * @param string $body
     * @param string $recipient
     * @param string $recipientName
     * @return Email
     */
    public function load(?array $data)
    {
	
		$project = null;
		$teste = null;
		
		if (!empty($data["project_id"])) {			
            $projectId = filter_var($data["project_id"], FILTER_VALIDATE_INT);
            $project = (new Works())->findById($projectId);
			
        }
		$stage = (new Stage())->find("application_id = :aplication AND work_id = :work_id","aplication={$this->user->application_id}&work_id={$project->id}");
		$tasks = (new Task())->find("application_id = :aplication AND work_id = :work_id","aplication={$this->user->application_id}&work_id={$project->id}");
		
		$html = $this->view->render("cronograma", [
			"project" => $project,
			"user" => $this->user,
			"stage" => $stage->order("stage_name asc")->fetch(true),
			"tasks" => $tasks->order("task_name asc")->fetch(true),
			
			"income" => (new AppInvoice())->find("application_id = :aplication ","aplication={$this->user->application_id}"),
			"expense" => (new AppInvoice())->find("application_id = :aplication ","aplication={$this->user->application_id}"),
            "atualizar" => $atualizar = (new AppInvoice())
			
		]);
		
		$this->dompdf->load_html("{$html}");
		$this->dompdf->setPaper('A4');
		$this->dompdf->render();
		$this->dompdf->stream("relatorio.pdf", ["Attachment" => false]);
        return $this;
    }
}