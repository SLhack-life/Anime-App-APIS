<?php

namespace App\Traits;

trait ValidationErrorTrait {
     protected function errorMessages($errors = [])
    {
        $error = [];
        foreach ($errors->toArray() as $key => $value) {
            foreach ($value as $messages) {
                $error[$key] = $messages;
            }
        }
        return $error;
    }
  
}