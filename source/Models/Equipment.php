<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * FSPHP | Class User Active Record Pattern
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Models
 */
class Equipment extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("equipments", ["id"], ["name","tag"]);
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
		string $category_id,
		string $supplier_id,
		string $name,
        string $localization,
		string $tag		
    ): Equipment {
		$this->application_id = $application_id;
		$this->category_id = $category_id;
		$this->supplier_id = $supplier_id;
		$this->name = $name;
		$this->localization = $localization;
		$this->tag = $tag;
        return $this;
    }
		
		
		


     public function findByTag(string $tag, string $application_id, string $columns = "*"): ?Equipment
    {
        $find = $this->find("tag = :tag AND application_id = :application_id",  "tag={$tag}&application_id={$application_id}", $columns);
        return $find->fetch();
    }
	
	
	  public function getCategory(): ?EquipmentCategory
    {
        if ($this->category_id) {
            return (new EquipmentCategory())->findById($this->category_id);
        }
        return null;
    }
	
	
	  public function getSupplier(): ?Supplier
    {
        if ($this->supplier_id) {
            return (new Supplier())->findById($this->supplier_id);
        }
        return null;
    }



    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Nome, sobrenome, tag e senha são obrigatórios");
            return false;
        }

              

        /** User Update */
        if (!empty($this->id)) {
            $equipmentId = $this->id;

            if ($this->find("tag = :e AND id != :i", "e={$this->tag}&i={$equipmentId}", "id")->fetch()) {
                $this->message->warning("A tag já está cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$equipmentId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->findByTag($this->tag,$this->application_id, "id")) {
                $this->message->warning("A taga já esta cadastrada");
                return false;
            }

            $equipmentId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($equipmentId))->data();
        return true;
    }
}





