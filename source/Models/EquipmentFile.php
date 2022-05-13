<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * FSPHP | Class User Active Record Pattern
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Models
 */
class EquipmentFile extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("equipmentfile", ["id"], ["equipment_id", "title" ,"uri" ,"subtitle" ,"status" ,"description" ,"cover"]);
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
		string $title,
		string $uri,
		string $subtitle,
		string $status,
		string $description,
		string $cover
    ): EquipmentFile {
		$this->application_id = $application_id;
		$this->equipment_id = $equipment_id;
		$this->title = $title;
		$this->uri = $uri;
		$this->subtitle = $subtitle;
		$this->status = $status;
		$this->description = $description;
		$this->cover = $cover;
        return $this;
    }
		
    public function findEquipmentFile(string $application_id, string $equipment_id, string $title, string $uri, string $subtitle, string $status, string $description, string $cover, string $columns = "*"): ?EquipmentFile
    {
        $find = $this->find("application_id = :application_id AND equipment_id = :equipment_id AND title = :title  AND uri = :uri  AND subtitle = :subtitle AND status = :status AND description = :description AND cover = :cover",  "application_id={$application_id}&equipment_id={$equipment_id}&title={$title}&uri={$uri}&subtitle={$subtitle}&status={$status}&description={$description}&cover={$cover}", $columns);
        return $find->fetch();
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
            $equipmentcoverId = $this->id;

            if ($this->find("equipment_id = :equipment_id AND title = :title  AND uri = :uri  AND subtitle = :subtitle AND status = :status AND description = :description AND cover = :cover AND id != :i", "equipment_id={$this->equipment_id}&title={$this->title}&uri={$this->uri}&subtitle={$this->subtitle}&status={$this->status}&description={$this->description}&cover={$this->cover}&i={$this->equipmentcoverId}", "id")->fetch()) {
                $this->message->warning("O Arquivo já foi cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$equipmentcoverId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->findEquipmentFile($this->application_id, $this->equipment_id, $this->title, $this->uri, $this->subtitle, $this->status, $this->description, $this->cover, "id")) {
                $this->message->warning("Esse arquivo já foi cadastrado");
                return false;
            }

            $equipmentcoverId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($equipmentcoverId))->data();
        return true;
    }
}





