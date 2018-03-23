<?php
class Questao extends TRecord
{

    const TABLENAME = "tbQuestao";
    const PRIMARYKEY = "id";
    const IDPOLICY = "max";
    
    private $ano_obj;
    private $universidade_obj;
    
    public function __construct($id = NULL)
    {
        parent::__construct($id);
        
        parent::addAttribute("enunciado");
        parent::addAttribute("altCerta");
        parent::addAttribute("alt1");
        parent::addAttribute("alt2");
        parent::addAttribute("alt3");
        parent::addAttribute("alt4");
        parent::addAttribute("ano");
        parent::addAttribute("universidade");
        parent::addAttribute("subarea");
        parent::addAttribute("imagem");
        
        
    }
    
    public function set_ano_obj(Ano $object)
    {
        $this->ano_obj = $object;
        $this->ano = $object->id;
    }
    
    public function get_ano_obj()
    {
        // loads the associated object
        if (empty($this->ano_obj))
            $this->ano_obj = new Ano($this->ano);
    
        // returns the associated object
        return $this->ano_obj;
    }
    
    public function set_universidade_obj(Universidade $object)
    {
        $this->universidade_obj = $object;
        $this->universidade = $object->id;
    }
    
    public function get_universidade_obj()
    {
        // loads the associated object
        if (empty($this->universidade_obj))
            $this->universidade_obj = new Universidade($this->universidade);
    
        // returns the associated object
        return $this->universidade_obj;
    }
    
    
}
