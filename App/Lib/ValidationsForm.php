<?php

namespace App\Lib;

class ValidationsForm
{

    private $itemsForValidation, $listValidations, $listValidationsIsArrayMultidimensional, $messageError;

    private  $typesValidation = array(
        array(
            'nameValidation' => 'required',
            'methodResponsibleForValidation' => 'isNotEmpty',
            'messageError' => 'O campo [name] não está preenchido!'
        ),
        array(
            'nameValidation' => 'numeric',
            'methodResponsibleForValidation' => 'isNumeric',
            'messageError' => 'O campo [name] não é um número'
        ),
        array(
            'nameValidation' => 'minLenght',
            'methodResponsibleForValidation' => 'hasMinLenght',
            'messageError' => 'O campo [name] não tem a quantidade mínima de caracteres!'
        ),
    );

    private function setItemsForValidation($items)
    {
        $this->itemsForValidation = $items;
    }

    private function setListValidations($validations)
    {
        if ($this->isArrayMultidimensional($validations)) {
            foreach ($validations as $key => $item) {
                $this->listValidations[$key]['nameKeyItem'] = $item[0];
                $this->listValidations[$key]['nameValidation'] = $item[1];
            }
            $this->listValidationsIsArrayMultidimensional = true;
        } else {
            $this->listValidationsIsArrayMultidimensional = false;
            $this->listValidations['nameKeyItem'] = $validations[0];
            $this->listValidations['nameValidation'] = $validations[1];
        }
    }

    private  function isNotEmpty($item, $validation): bool
    {
        if (!empty($item)) {
            return true;
        }
        $this->messageError = $validation['messageError'];
        return false;
    }

    private  function isNumeric($item, $validation): bool
    {
        if (is_numeric($item)) {
            return true;
        }
        $this->messageError = $validation['messageError'];
        return false;
    }

    private function hasMinLenght($item, $validation)
    {
        if (preg_match('!\d+!', $validation['nameValidation'], $minimumCharacters)) {
            $numberOfCharactersInString = strlen($item);
            if ($numberOfCharactersInString > $minimumCharacters[0]) {
                return true;
            }
            var_dump($validation);
            die;
            return false;
        }
        throw new \Exception('Não foi informado o número mínimo de caracteres!');
    }

    private  function isArrayMultidimensional(array $array): bool
    {
        if (is_array($array[0])) {
            return true;
        }
        return false;
    }

    private  function hasMultipleValidations($validations): bool
    {
        $validationsList = explode(',', $validations);
        if (count($validationsList) > 1) {
            return true;
        }
        return false;
    }

    private  function getMethodResponsibleForValidation($validation)
    {
        $filterValidation = trim($validation);
        $filterValidation = explode('[', $filterValidation)[0];
        foreach ($this->typesValidation as $itemOfValidation) {
            if ($itemOfValidation['nameValidation'] == $filterValidation) {
                return $itemOfValidation['methodResponsibleForValidation'];
            }
        }
        throw new \Exception('Método para validação não encontrado!');
    }

    private  function makeValidation($item, $validation)
    {
        if (!empty($validation)) {
            $method = $this->getMethodResponsibleForValidation($validation['nameValidation']);
            $keyItem = $validation['nameKeyItem'];
            if (isset($item[$keyItem])) {
                if ($this->$method($item[$keyItem], $validation) == false) {
                    return false;
                }
                return true;
            }
            $this->messageError = 'O item ' . $keyItem . 'não existe';
        }
    }

    private  function makeValidationArrayList($item, $validations)
    {
        $validations['nameValidation'] = explode(',', $validations['nameValidation']);
        foreach ($validations['nameValidation'] as $key => $validation) {
            $itemValidation = $validations;
            $itemValidation['nameValidation'] = $validations['nameValidation'][$key];
            if (!$this->makeValidation($item, $itemValidation)) {
                return false;
            }
        }
        return true;
    }

    private  function isValidItem($itens, array $validations): bool
    {
        if ($this->hasMultipleValidations($validations['nameValidation'])) {
            if ($this->makeValidationArrayList($itens, $validations)) {
                return true;
            }
        } else {
            if ($this->makeValidation($itens, $validations)) {
                return true;
            }
            return false;
        }
        return false;
    }

    private  function isValidArrayList(): bool
    {
        foreach ($this->listValidations as $validations) {
            if (!$this->isValidItem($this->itemsForValidation, $validations)) {
                return false;
            }
        }
        return true;
    }

    public  function isValid($itens, array $validations)
    {
        if (!empty($itens) && !empty($validations)) {
            $this->setItemsForValidation($itens);
            $this->setListValidations($validations);
            if ($this->listValidationsIsArrayMultidimensional) {
                return $this->isValidArrayList();
            }
            return $this->isValidItem($this->itemsForValidation, $this->listValidations);
        }
        throw new \Exception('Itens para valiação inválidos');
    }
}
