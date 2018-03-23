<?php
class Universidade extends TRecord
{

    const TABLENAME = "tbUniversidade";
    const PRIMARYKEY = "id";
    const IDPOLICY = "max";
    
    public function __construct($id = NULL)
    {
        parent::__construct($id);
        
        parent::addAttribute("universidade");
        
    }
}
