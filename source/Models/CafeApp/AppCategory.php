<?php

namespace Source\Models\CafeApp;

use Source\Core\Model;

/**
 * Class AppCategory
 * @package Source\Models\CafeApp
 */
class AppCategory extends Model
{
    /**
     * AppCategory constructor.
     */
    public function __construct()
    {
        parent::__construct("app_categories", ["id"], ["name", "type"]);
    }
	
	 public function bootstrap(
		string $user_id,	
		string $application_id,
		string $type,
		string $name	
    ): AppCategory{
		$this->user_id = $user_id;
		$this->application_id = $application_id;
		$this->type = $type;
        $this->name = $name;
        return $this;
    }
		
	

    public function findByName(string $name, string $application_id, string $columns = "*"): ?AppCategory
    {
        $find = $this->find("name = :name AND application_id = :application_id ", "name={$name}&application_id={$application_id}", $columns);
        return $find->fetch();
    }
	
	
	
	
	
	 /**
     * @return string
     */
    public function fullName(): string
    {
        return "{$this->name}";
    }



    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Essa Categoria Já existe");
            return false;
        }
  

        /** User Update */
        if (!empty($this->id)) {
            $categoryId = $this->id;

            if ($this->find("name = :e AND id != :i", "e={$this->name}&i={$categoryId}", "id")->fetch()) {
                $this->message->warning("Essa Categoria Já existe");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$categoryId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->findByName($this->name,$this->application_id, "id")) {
                $this->message->warning("Essa Categoria já está cadastrado");
                return false;
            }

            $categoryId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($categoryId))->data();
        return true;
    }
}
	
	
	
