<?php
class Imagem extends TRecord
{

    const TABLENAME = "tbImagem";
    const PRIMARYKEY = "id";
    const IDPOLICY = "max";
    
    public function __construct($id = NULL)
    {
        parent::__construct($id);
        
        parent::addAttribute("referencia");
        
    }
}
