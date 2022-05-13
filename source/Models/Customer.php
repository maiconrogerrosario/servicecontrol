<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * FSPHP | Class User Active Record Pattern
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Models
 */
class Customer extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("customer", ["id"], ["name", "document"]);
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
	   string $name,
	   string $document,
	   string $email,
	   string $contact,
	   string $phone1,
	   string $mobile,
	   string $phone2,
	   string $fax,
	   string $address_street,
	   string $address_number,
	   string $address_neighborhood,
	   string $address_complement,
	   string $address_postalcode,
	   string $address_city,
	   string $address_state,
	   string $address_country,
	   string $observation
	   
    ): Customer {
		$this->application_id = $application_id;
		$this->name = $name;
		$this->document = $document;
		$this->email = $email;
		$this->contact = $contact;
		$this->phone1 = $phone1;
		$this->mobile = $mobile;
		$this->phone2 = $phone2;
		$this->fax = $fax;
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
		

    public function findByEmail(string $email,string $application_id, string $columns = "*"): ?Customer
    {
        $find = $this->find("email = :email AND application_id = :application_id ", "email={$email}&application_id={$application_id}", $columns);
        return $find->fetch();
    } 
	
	public function findByCPF(string $document,string $application_id, string $columns = "*"): ?Customer
    {
        $find = $this->find("document = :document AND application_id = :application_id ", "document={$document}&application_id={$application_id}", $columns);
        return $find->fetch();
    } 
	
	
    /**
     * @return bool
     */
    public function save(): bool
    {
		
		if (!$this->required()) {
            $this->message->warning("Nome, sobrenome, email e senha são obrigatórios");
            return false;
        }
   

        /** User Update */
        if (!empty($this->id)) {
            $customerId = $this->id;

            if ($this->find("document = :document AND id != :i", "document={$this->document}&i={$customerId}", "id")->fetch()) {
                $this->message->warning("O CPF/CNPJ já esta cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$customerId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
			
            if ($this->findByCPF($this->document,$this->application_id, "id")) {
                $this->message->warning("O CPF/CNPJ já esta cadastrado");
                return false;
            }

            $customerId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($customerId))->data();
        return true;	
	  
		
		
    }
	
}