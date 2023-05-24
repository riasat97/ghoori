<?php

class AccountsController extends \SettingsController {



	public function store()
	{
       return $this->accountRepository->store();
	}
    public function postBkash(){
        return $this->accountRepository->postBkash();
    }





}