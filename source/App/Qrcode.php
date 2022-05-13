<?php

namespace Source\App;

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
use Source\Models\Maintenance;
use Source\Models\Equipment;
use Source\Models\EquipmentCategory;
use Source\Models\EquipmentWorker;
use Source\Models\EquipmentFile;
use Source\Models\EquipmentQrcode;
use Source\Models\ServiceCategory;
use Source\Models\OccupationCategory;
use Source\Models\CollaboratorCategory;
use Source\Models\Supplier;
use Source\Models\Employee;




/**
 * Class App
 * @package Source\App
 */
class Qrcode extends Controller
{
    

    /**
     * App constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_QRCODE . "/");

    }

    /**
     * @param array|null $data
     */
    public function dash(?array $data): void
    {
        if (!empty($data["wallet"])) {
            $session = new Session();

            if ($data["wallet"] == "all") {
                $session->unset("walletfilter");
                echo json_encode(["filter" => true]);
                return;
            }

            $wallet = filter_var($data["wallet"], FILTER_VALIDATE_INT);
            $getWallet = (new AppWallet())->find("user_id = :user AND id = :id",
                "user={$this->user->id}&id={$wallet}")->count();

            if ($getWallet) {
                $session->set("walletfilter", $wallet);
            }

            echo json_encode(["filter" => true]);
            return;
        }

        //CHART UPDATE
        $chartData = (new AppInvoice())->chartData($this->user);
        $categories = str_replace("'", "", explode(",", $chartData->categories));
        $json["chart"] = [
            "categories" => $categories,
            "income" => array_map("abs", explode(",", $chartData->income)),
            "expense" => array_map("abs", explode(",", $chartData->expense))
        ];

        //WALLET
        $wallet = (new AppInvoice())->balance($this->user);
        $wallet->wallet = str_price($wallet->wallet);
        $wallet->status = ($wallet->balance == "positive" ? "gradient-green" : "gradient-red");
        $wallet->income = str_price($wallet->income);
        $wallet->expense = str_price($wallet->expense);
        $json["wallet"] = $wallet;

        echo json_encode($json);
    }

    /**
     * APP HOME
     */
    public function home(): void
    {
		$equipments = (new Equipment())->find("application_id = :application_id AND equipment_id = :equipment_id AND name = :equipment_name","application_id={$data["application_id"]}&equipment_id={$data["equipment_id"]}&equipment_name={$data["equipment_name"]}");		
	    $equipmentworkers =(new EquipmentWorker())->find("application_id = :application_id AND equipment_id = :equipment_id","application_id={$data["application_id"]}&equipment_id={$data["equipment_id"]}");
		
		 foreach ($equipmentworkers as $equipmentworker){
			  
			$equipment = $equipmentworker->getEquipment();
		    $employee = $equipmentworker->getEmployee();
		
			$subject ="Solicitação de Reparo Técnico - {$equipment->name}";
			$message = "Problema Técnico no {$equipment->name}";

			$view = new View(__DIR__ . "/../../shared/views/email");
			$body = $view->render("mail", [
            "subject" => $subject,
            "message" => str_textarea($message)
			]);
		   (new Email())->bootstrap(
            $subject,
            $body,
            CONF_MAIL_SUPPORT,
            "Suporte " . "{$equipment->name}"
			)->queue($employee->email, "{$employee->name}");
			
		}

		echo $this->view->render("home",[
            "head" => $head
            
        ]);
			
    }
	
	public function equipment(?array $data): void
    {
		$equipmentWorker =(new EquipmentWorker())->find("application_id= :aplication AND equipment_id= :equipment_id ","aplication={$data["application_id"]}&equipment_id={$data["equipment_id"]}")->fetch();
		$uri = $data["equipment_name"];
		//create
        if (!empty($data["email"]) && $data["email"] == "email") {
		
			$equipmentWorkers =(new EquipmentWorker())->find("application_id= :aplication AND equipment_id= :equipment_id ","aplication={$data["application_id"]}&equipment_id={$data["equipment_id"]}")->fetch(true);
	
			foreach ($equipmentWorkers as $equipmentWorkers) {
				
				$equipment = $equipmentWorkers->getEquipment();
				$employee = $equipmentWorkers->getEmployee();
				
				$subject =  "Solicitar Manutenção {$equipment->name}";
				$message = "Problema no {$equipment->name}";

				$view = new View(__DIR__ . "/../../shared/views/email");
				$body = $view->render("mail", [
					"subject" => $subject,
					"message" => str_textarea($message)
				]);
				
				(new Email())->bootstrap(
					$subject,
					$body,
					$employee->email,
					$employee->name
				)->send();
			}
			
			$json["message"] = $this->message->success("A Solicitação Foi Enviada Com Sucesso")->render();
			$json["reload"] = true;
			echo json_encode($json);
			return;		
		
		}
			
		$head = $this->seo->render(
			"Lista de Fornecedores",
			CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg"),
            false
        );
		
        echo $this->view->render("equipment", [
            "head" => $head,
			"equipmentWorker" => $equipmentWorker,
			"uri" => $uri      
        ]);
		
    }
	
	public function equipmentHome(?array $data): void
    {
	    $equipmentFile =(new EquipmentFile())->find("application_id= :aplication AND equipment_id= :equipment_id ","aplication={$data["application_id"]}&equipment_id={$data["equipment_id"]}");
		$search = null;
        $all = ($search ?? "all");
        $pager = new Pager(url("/equipment-file/{$all}/"));
        $pager->pager($equipmentFile->count(),20, (!empty($data["page"]) ? $data["page"] : 10));
	
		$head = $this->seo->render(
			"Lista de Fornecedores",
			CONF_SITE_DESC,
            url(),
            theme("/assets/images/share.jpg"),
            false
        );

        echo $this->view->render("equipment-home",[
            "head" => $head,
			"equipmentFiles" => $equipmentFile->order("title")->limit($pager->limit())->offset($pager->offset())->fetch(true),
			"paginator" => $pager->render()
			      
        ]);
			 			
    }
	
	
	

}