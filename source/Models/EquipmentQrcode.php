<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * FSPHP | Class User Active Record Pattern
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Models
 */
class EquipmentQrcode extends Model
{
	
	private $equipment;
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("equipment_qrcode", ["id"], ["equipment_id"]);
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
		string $uri,
		string $info,
		string $support,
		string $status
    ): EquipmentQrcode {
		$this->application_id = $application_id;
		$this->equipment_id = $equipment_id;
		$this->uri = $uri;
		$this->info = $info;
		$this->support = $support;
		$this->status = $status;
        return $this;
    }
		
    public function findEquipmentQrcode(string $application_id, string $equipment_id, string $columns = "*"): ?EquipmentQrcode
    {
        $find = $this->find("application_id = :application_id AND equipment_id = :equipment_id",  "application_id={$application_id}&equipment_id={$equipment_id}", $columns);
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
            $equipmentQrcodeId = $this->id;

            if ($this->find("equipment_id = :equipment_id AND id != :i", "equipment_id={$this->equipment_id}&i={$equipmentQrcodeId}", "id")->fetch()) {
                $this->message->warning("O QR Code já foi criado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$equipmentQrcodeId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->findEquipmentQrcode($this->application_id, $this->equipment_id, "id")) {
                $this->message->warning("Esse QR Code  já foi cadastrado");
                return false;
            }

            $equipmentQrcodeId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($equipmentQrcodeId))->data();
        return true;
    }
}





