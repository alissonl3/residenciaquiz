<?php
class QuestaoControle extends TStandardFormList
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
        parent::setActiveRecord('Questao'); // define the Active Record
        parent::setDefaultOrder('id', 'asc'); // define the default order
        $this->setLimit(10); // turn off limit for datagrid
        
        // create the form
        $this->form = new TQuickForm('formularioQuestao');
        $this->form->class = 'tform'; // CSS class
        $this->form->setFormTitle('Questão');
        
        // create the form fields
        $id     = new TEntry('id');
        $enunciado   = new TText('enunciado');
        $altCerta   = new TText("altCerta");
        $alt1   = new TText("alt1");
        $alt2   = new TText("alt2");
        $alt3   = new TText("alt3");
        $alt4   = new TText("alt4");      
        $ano    = new TDBCombo("ano", 'sample', 'Ano', 'id', 'ano');
        $universidade   = new TDBCombo("universidade", 'sample', 'Universidade', 'id', 'universidade');
        $subarea   = new TDBCombo("subarea", 'sample', 'SubArea', 'id', 'subarea');
        $imagem   = new TDBCombo("imagem", 'sample', 'Imagem', 'id', 'id');
        
        
        // add the form fields
        $this->form->addQuickField('ID',    $id,    '30%');
        $this->form->addQuickField('Enunciado',  $enunciado,  '70%', new TRequiredValidator);
        $this->form->addQuickField('Alternativa correta',  $altCerta,  '70%', new TRequiredValidator);
        $this->form->addQuickField('Alternativa 1',  $alt1,  '70%', new TRequiredValidator);
        $this->form->addQuickField('Alternativa 2',  $alt2,  '70%', new TRequiredValidator);
        $this->form->addQuickField('Alternativa 3',  $alt3,  '70%', new TRequiredValidator);
        $this->form->addQuickField('Alternativa 4',  $alt4,  '70%', new TRequiredValidator);
        $this->form->addQuickField('Ano',  $ano,  '70%', new TRequiredValidator);
        $this->form->addQuickField('Universidade',  $universidade,  '70%', new TRequiredValidator);
        $this->form->addQuickField('SubArea',  $subarea,  '70%', new TRequiredValidator);
        $this->form->addQuickField('Imagem',  $imagem,  '70%');
        
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
        $this->datagrid->addQuickColumn('Enunciado', 'enunciado','left',  '60%', new TAction(array($this, 'onReload')), array('order', 'enunciado'));
        $coluna_universidade = new TDataGridColumn('universidade_obj->universidade', 'Universidade', 'right', '30%');  
        $coluna_ano = new TDataGridColumn('ano_obj->ano', 'Ano', 'right', '20%');    
        $this->datagrid->addColumn($coluna_universidade);            
        $this->datagrid->addColumn($coluna_ano);
        
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
