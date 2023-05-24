<?php namespace Chorki\Validators;


abstract class FormValidator {

    protected $input;

    protected $errors;

    public function __construct($input = NULL)
    {
        $this->input = $input ?: \Input::all();
    }

    public function passes()
    {
        $validation = \Validator::make($this->input, static::$rules);

        if($validation->passes()) return true;

        $this->errors = $validation->messages();

        return false;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}