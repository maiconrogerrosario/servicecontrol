<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\User;
use Source\Support\Pager;

/**
 * FSPHP | Class User Active Record Pattern
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Models
 */
class Maintenance extends Model
{
	
	
	private $supplier;
	private $employee;
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("maintenance", ["id"], ["equipment_id", "service_id", "status_id", "maintenance_type", "date_initial", "time_initial", "date_final", "time_final", "type_collaborator", "collaborator_name", "price"]);
		
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string|null $document
     * @return User
     */
    public function bootstrap(
		string $application_id,
		string $equipment_id,
		string $service_id,
		string $status_id,
        string $maintenance_type,
        string $date_initial,
        string $time_initial,
		string $date_final,
		string $time_final,
		string $annotations,
		string $type_collaborator,
		string $collaborator_name,	
		string $price
    ): Maintenance {
		$this->application_id = $application_id;
		$this->equipment_id = $equipment_id;
		$this->service_id = $service_id;
		$this->maintenance_type = $maintenance_type;
        $this->date_initial = $time_initial;
		$this->time_initial = $time_initial;
		$this->date_final = $date_final;
		$this->time_final = $time_final;
		$this->annotations = $annotations;
		$this->type_collaborator = $type_collaborator;
		$this->collaborator_name = $collaborator_name;
		$this->price = $price;
        return $this;
    }		
	
    /**
     * @param string $email
     * @param string $columns
     * @return null|User
     */
    public function findByEmail(string $email, string $columns = "*"): ?Maintenance
    {
        $find = $this->find("email = :email", "email={$email}", $columns);
		
        return $find->fetch();
    }
		
	public function findManu(string $application_id, string $equipment_id, string $service_id, string $status_id,string $maintenance_type, string $date_initial, string $time_initial, string $date_final, string $time_final, string $annotations, string $type_collaborator, string $collaborator_name,string $price, string $columns = "*"): ?Maintenance
    {
		
		$find = $this->find("application_id = :application_id AND  equipment_id = :equipment_id AND  service_id = :service_id AND  status_id = :status_id AND maintenance_type = :maintenance_type AND  date_initial = :date_initial AND  time_initial = :time_initial AND  date_final = :date_final AND  time_final = :time_final AND  annotations = :annotations AND type_collaborator = :type_collaborator AND  collaborator_name = :collaborator_name AND  price = :price", "application_id={$application_id}&equipment_id={$equipment_id}&service_id={$service_id}&status_id={$status_id}&maintenance_type={$maintenance_type}&date_initial={$date_initial}&time_initial={$time_initial}&date_final={$date_final}&time_final={$time_final}&annotations={$annotations}&type_collaborator={$type_collaborator}&collaborator_name={$collaborator_name}&price={$price}", $columns);
		
        return $find->fetch();
		
    }
	
    public function getEquipment(): ?Equipment
	{ 

		if ($this->equipment_id) {
			
            return (new Equipment())->findById($this->equipment_id);
			
        }
		
        return null;
		
	}

	public function getOccupation($type_collaborator): ?string
	{ 
		if ($type_collaborator == "internal_collaborator"){
			
			if ($this->collaborator_name) {
			
				$this->employee = $this->getEmployee();
			
				return "{$this->employee->name}";
			
			}
			
        }
				
		if ($type_collaborator == "external_collaborator"){
			
			if ($this->collaborator_name) {
			
				$this->supplier = $this->getSupplier();
			 
				return "{$this->supplier->name}";
			
			}
		}		
	
		return null;
	}
	
	
	public function getTypeCollaborator($type_collaborator): ?string
	{ 
		if ($type_collaborator == 'internal_collaborator'){
					
				return "Interno";
			
        }
				
		if ($type_collaborator == 'external_collaborator'){
			
			return "Tercerizado";
		}		
	
		return null;
	}
	
	
	
	
	
	
	 public function filter($application_id, ?array $filter, ?int $limit = null, ?int $offset = null): ?array
    {
		$service_id = (!empty($filter["service_id"]) && $filter["service_id"] != "all" ? "AND service_id = '{$filter["service_id"]}'" : null);
        $equipment_id = (!empty($filter["equipment_id"]) && $filter["equipment_id"] != "all" ? "AND equipment_id = '{$filter["equipment_id"]}'" : null);
			
		$date = (!empty($filter["date"]) && $filter["date"] != "all" ? "AND date_initial = '{$filter["date"]}'" : null);

		$due = $this->find(
			"application_id= :application_id {$service_id} {$equipment_id} {$date}","application_id={$application_id}")->order("date_initial ASC");
		
        if ($limit) {
            $due->limit($limit);
        }
		
		if ($limit) {
            $due->offset($offset);
        }
		
		

        return $due->fetch(true);
			
    }
	
	
	
	
	public function pag($application_id, ?array $filter)
	{ 
	    $service = (!empty($filter["service_id"]) && $filter["service_id"] != "all" ? "AND service_id = '{$filter["service_id"]}'" : null);
        $equipment = (!empty($filter["equipment_id"]) && $filter["equipment_id"] != "all" ? "AND equipment_id = '{$filter["equipment_id"]}'" : null);
		        
	    $date = (!empty($filter["date"]) && $filter["date"] != "all" ? "AND date_initial = '{$filter["date"]}'" : null);

		$due = $this->find(
			"application_id= :application_id {$service} {$equipment} {$date}","application_id={$application_id}")->order("date_initial ASC");
			
			
		
	
		$service_id = (!empty($filter["service_id"]) ? $filter["service_id"] : "all");
	    $equipment_id = (!empty($filter["equipment_id"]) ? $filter["equipment_id"] : "all");
		$date1  = (!empty($filter["date"]) ? $filter["date"] : "all");
		$pager = new Pager(url("/app/maintenance/{$service_id}/{$equipment_id}/{$date1}/"));
	    $pager->pager($due->count(), 12, (!empty($filter["page"]) ? $filter["page"] : 1));
	
		return  $pager;
	
	}
	
    public function getService(): ?ServiceCategory
	{ 
	
		if ($this->service_id){
			
            return (new ServiceCategory())->findById($this->service_id);
        }
		
        return null;
		
	}
	
    public function getStatus(): ?Status
	{ 
	
		if ($this->status_id) {
			
            return (new Status())->findById($this->status_id);
			
        }
		
        return null;
		
	}
	
    public function getPayment(): ?Payment
	{ 
	
		if ($this->payment_id) {
            return (new Payment())->findById($this->payment_id);
        }
        return null;

	}

	public static function getRepeated(string $pacient_id, string $medic_id, string $date_at,string $time_at, string $columns = "*")
	{
		
		$find = $this->find("pacient_id =:pacient_id and medic_id =:medic_id and date_at =:date_at and time_at= :time_at", "pacient_id={$pacient_id} and medic_id={$medic_id} and date_at={$date_at} and time_at={$time_at}", $columns);
		return $find->fetch();
		
	}



    /**
     * @return string
     */
    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }



    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Por favor informar todos os dados");
            return false;
        }

        /** User Update */
        if (!empty($this->id)) {
            $reservationId = $this->id;

            if ($this->find("id != :i AND equipment_id= :equipment_id AND  service_id= :service_id AND status_id= :status_id AND maintenance_type= :maintenance_type AND  date_initial= :date_initial AND  time_initial= :time_initial AND  date_final= :date_final AND  time_final= :time_final AND  annotations= :annotations AND type_collaborator= :type_collaborator AND  collaborator_name= :collaborator_name AND  price= :price", "i={$reservationId}&equipment_id={$this->equipment_id}&service_id={$this->service_id}&status_id={$this->status_id}&maintenance_type={$this->maintenance_type}&date_initial={$this->date_initial}&time_initial={$this->time_initial}&date_final={$this->date_final}&time_final={$this->time_final}&annotations={$this->annotations}&type_collaborator={$this->type_collaborator}&collaborator_name={$this->collaborator_name}&price={$this->price}", "id")->fetch()) {
                $this->message->warning("Erro ao atualizar essa manutenção");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$reservationId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {

			if ($this->findManu($this->application_id, $this->equipment_id, $this->service_id, $this->status_id, $this->maintenance_type, $this->date_initial, $this->time_initial, $this->date_final,$this->time_final,$this->annotations,$this->type_collaborator,$this->collaborator_name,$this->price, "id")) {
                $this->message->warning("Essa data já está reservada por favor esolher outra");
                return false;	
            }

            $reservationId = $this->create($this->safe());
            if ($this->fail()) {	
                $this->message->error("Erro ao agendar, verifique os dados");
                return false;
            }
        }
		
		

        $this->data = ($this->findById($reservationId))->data();
        return true;
    }
}