<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * FSPHP | Class User Active Record Pattern
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Models
 */
class CollaboratorCategory extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("collaborator_category", ["id"], ["name"]);
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
        string $name
		
    ): CollaboratorCategory {
        $this->name = $name;
        return $this;
    }
		
	

     public function findByName(string $name, string $columns = "*"): ?CollaboratorCategory
    {
        $find = $this->find("name = :name", "name={$name}", $columns);
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
            if ($this->findByName($this->name, "id")) {
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








