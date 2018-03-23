<?php
class SubArea extends TRecord
{

    const TABLENAME = "tbSubarea";
    const PRIMARYKEY = "id";
    const IDPOLICY = "max";
    
    private $area;
    
    public function __construct($id = NULL)
    {
        parent::__construct($id);
        
        parent::addAttribute("subarea");
        parent::addAttribute("arearef");
        
    }
    
    public function set_area(Area $object)
    {
        $this->area = $object;
        $this->arearef = $object->id;
    }
    
    public function get_area()
    {
        // loads the associated object
        if (empty($this->area))
            $this->area = new Area($this->arearef);
    
        // returns the associated object
        return $this->area;
    }
}