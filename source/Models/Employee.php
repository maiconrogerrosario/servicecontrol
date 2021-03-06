<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * FSPHP | Class User Active Record Pattern
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Models
 */
class Employee extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("employee", ["id"], ["name", "email"]);
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
		string $occupation_id,
        string $name,
		string $email,
		string $document,
		string $phone1,
		string $mobile,
        string $phone2,
		string $address_street,
		string $address_number,
		string $address_neighborhood,
		string $address_complement,
	    string $address_postalcode,
		string $address_city,
		string $address_state,
		string $address_country,
		string $observation	
    ): Employee {
		$this->application_id = $application_id;
		$this->occupation_id = $occupation_id;
		$this->name = $name;
		$this->document = $document;
		$this->email = $email;
		$this->phone1 = $phone1;
		$this->mobile = $mobile;
		$this->phone2 = $phone2;
		$this->address_street = $address_street;
		$this->address_number = $address_number;
		$this->address_neighborhood = $address_neighborhood;
		$this->address_complement = $address_complement;
		$this->address_postalcode = $address_postalcode;
		$this->address_city = $address_city;
		$this->address_state = $address_state;
		$this->address_country = $address_country;
		$this->observation = $observation;
        return $this;
    }
		

    public function findByEmail(string $email,string $application_id, string $columns = "*"): ?Employee
    {
        $find = $this->find("email = :email AND application_id = :application_id ", "email={$email}&application_id={$application_id}", $columns);
        return $find->fetch();
    } 


	

	
	public function getOccupation(): ?OccupationCategory
	{ 

		if ($this->occupation_id) {
			
			 return (new OccupationCategory())->findById($this->occupation_id);
        }
		
        return null;
		
	} 
	
	
	

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Nome, sobrenome, email e senha s??o obrigat??rios");
            return false;
        }
   

        /** User Update */
        if (!empty($this->id)) {
            $employeeId = $this->id;

            if ($this->find("email = :e AND id != :i", "e={$this->email}&i={$employeeId}", "id")->fetch()) {
                $this->message->warning("O e-mail informado j?? est?? cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$employeeId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->findByEmail($this->email,$this->application_id, "id")) {
                $this->message->warning("O e-mail informado j?? est?? cadastrado");
                return false;
            }

            $employeeId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($employeeId))->data();
        return true;
    }
	
}