<?php
class Ano extends TRecord
{

    const TABLENAME = "tbAno";
    const PRIMARYKEY = "id";
    const IDPOLICY = "max";
    
    public function __construct($id = NULL)
    {
        parent::__construct($id);
        
        parent::addAttribute("ano");
        
    }
}

