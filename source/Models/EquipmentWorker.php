<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * FSPHP | Class User Active Record Pattern
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Models
 */
class EquipmentWorker extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("equipmentworker", ["id"], ["equipment_id","employee_id"]);
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $tag
     * @param string $password
     * @param string|null $document
     * @return User
     */
	 
    public function bootstrap(
		string $application_id,
		string $equipment_id,
		string $employee_id,
		string $observation,
		string $status
    ): EquipmentWorker {
		$this->application_id = $application_id;
		$this->equipment_id = $equipment_id;
		$this->employee_id = $employee_id;
		$this->observation = $observation;
		$this->status = $status;
        return $this;
    }
		
    public function findEquipmentWorker(string $equipment_id, string $employee_id, string $application_id, string $columns = "*"): ?EquipmentWorker
    {
        $find = $this->find("equipment_id = :equipment_id AND application_id = :application_id AND employee_id = :employee_id",  "equipment_id={$equipment_id}&employee_id={$employee_id}&application_id={$application_id}", $columns);
        return $find->fetch();
    }
	
	public function getEmployee(): ?Employee
    {
        if ($this->employee_id) {
            return (new Employee())->findById($this->employee_id);
        }
        return null;
    }
	
	public function getEquipment(): ?Equipment
    {
        if ($this->equipment_id) {
            return (new Equipment())->findById($this->equipment_id);
        }
        return null;
    }
	
    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Falta informar dados");
            return false;
        }

        /** User Update */
        if (!empty($this->id)) {
            $equipmentWorkerId = $this->id;

            if ($this->find("employee_id = :employee AND equipment_id = :equipment  AND id != :i", "employee={$this->employee_id}&equipment={$this->equipment_id}&i={$equipmentWorkerId}", "id")->fetch()) {
                $this->message->warning("A funcionário já está vinculado ao equipamento");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$equipmentWorkerId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->findEquipmentWorker($this->employee_id,$this->equipment_id,$this->application_id, "id")) {
                $this->message->warning("Esse funcionário já está vinculado a esse equipamento");
                return false;
            }

            $equipmentWorkerId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($equipmentWorkerId))->data();
        return true;
    }
}





