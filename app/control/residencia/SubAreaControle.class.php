<?php
class SubAreaControle extends TStandardFormList
{
    protected $form;      // formulário de cadastro
    protected $datagrid;  // listagem
    protected $loaded;
    protected $pageNavigation;  // pagination component
    
    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        parent::setDatabase('sample'); // define the database
        parent::setActiveRecord('SubArea'); // define the Active Record
        parent::setDefaultOrder('id', 'asc'); // define the default order
        $this->setLimit(10); // turn off limit for datagrid
        
        // create the form
        $this->form = new TQuickForm('formularioSubArea');
        $this->form->class = 'tform'; // CSS class
        $this->form->setFormTitle('SubArea');
        
        // create the form fields
        $id     = new TEntry('id');
        $sub   = new TEntry('subarea');
        $area   = new TDBCombo('arearef', 'sample', 'Area', 'id', 'areas');
        
        
        // add the form fields
        $this->form->addQuickField('ID',    $id,    '30%');
        $this->form->addQuickField('SubArea',  $sub,  '70%', new TRequiredValidator);
        $this->form->addQuickField('Area',  $area,  '70%', new TRequiredValidator);
        
        // define the form actions
        $this->form->addQuickAction(_t('Save'), new TAction(array($this, 'onSave')), 'fa:save green');
        $this->form->addQuickAction(_t('Clear'),  new TAction(array($this, 'onClear')), 'fa:eraser red');
        
        // make id not editable
        $id->setEditable(FALSE);
        
        // create the datagrid
        $this->datagrid = new TQuickGrid;
        $this->datagrid->style = 'width: 100%';
        
        // add the columns
        $this->datagrid->addQuickColumn('ID',   'id',  'center', '20%', new TAction(array($this, 'onReload')), array('order', 'id'));
        $this->datagrid->addQuickColumn('SubArea', 'subarea','left',  '60%', new TAction(array($this, 'onReload')), array('order', 'subarea'));
        $coluna_area = new TDataGridColumn('area->areas', 'Area', 'right', '20%');     
        $this->datagrid->addColumn($coluna_area);
        
        // add the actions
        $this->datagrid->addQuickAction('Editar',  new TDataGridAction(array($this, 'onEdit')),   'id', 'fa:edit blue');
        $this->datagrid->addQuickAction('Excluir', new TDataGridAction(array($this, 'onDelete')), 'id', 'fa:trash red');
        
        // create the datagrid model
        $this->datagrid->createModel();
        
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
        
        // wrap objects inside a table
        $vbox = new TVBox;
        $vbox->add($this->form);
        $vbox->add($this->datagrid);
        $vbox->add($this->pageNavigation);
        
        // pack the table inside the page
        parent::add($vbox);
    }
}
