<?php
class Area extends TRecord
{

    const TABLENAME = "tbArea";
    const PRIMARYKEY = "id";
    const IDPOLICY = "max";
    
    public function __construct($id = NULL)
    {
        parent::__construct($id);
        
        parent::addAttribute("areas");
        
    }
}