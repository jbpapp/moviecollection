<?php namespace Smartbit;

use Smartbit\Exceptions\InvalidArgumentException;

trait ValidatorTrait {

    public function validate($data, $rules, $messages)
    {
        $validation = Validator::make(
            $data, $rules, $messages
        );

        if ($validation->fails())
            throw new InvalidArgumentException('Validation failed.', $validation->errors());
    }

}