<?php
namespace App\Entities;


use Illuminate\Database\Eloquent\Model;
use Rakit\Validation\Validator;

class Entity extends Model
{
    protected $errors = [];

    protected $validateRules = [];

    protected $validateMessages = [];

    public function validate(array $inputs = []): bool
    {
        $validator = new Validator();

        $validator->setMessages($this->validateMessages);

        $validation = $validator->make(count($inputs) > 0 ? $inputs : $this->toArray(), $this->validateRules);

        $validation->validate();

        if ($validation->fails()) {

            $this->errors =  $validation->errors()->toArray();

            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        $errors = [];

        foreach ($this->errors as $k => $v) {
            $errors[$k] = array_values($v);
        }

        return $errors;
    }

}
