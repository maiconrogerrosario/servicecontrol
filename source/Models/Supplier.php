<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * FSPHP | Class User Active Record Pattern
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Models
 */
class Supplier extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("supplier", ["id"], ["name", "email"]);
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
		string $supplier_type,
        string $name,
		string $email,
		string $site,
		string $document,
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
    ): Supplier {
		$this->application_id = $application_id;
		$this->occupation_id = $occupation_id;
		$this->supplier_type = $supplier_type;
		$this->name = $name;
		$this->document = $document;
		$this->email = $email;
		$this->site = $site;
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
		

    public function findByEmail(string $email,string $application_id, string $columns = "*"): ?Supplier
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

	public function getService(): ?ServiceCategory
	{ 

		if ($this->id) {
			
			return (new ServiceCategory())->findById($this->id);
			
        }
		
        return null;
		
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
            $supplierId = $this->id;

            if ($this->find("email = :e AND id != :i", "e={$this->email}&i={$supplierId}", "id")->fetch()) {
                $this->message->warning("O e-mail informado já está cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$supplierId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->findByEmail($this->email,$this->application_id, "id")) {
                $this->message->warning("O e-mail informado já está cadastrado");
                return false;
            }

            $supplierId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($supplierId))->data();
        return true;
    }
	
}