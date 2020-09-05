<?php

class SigesSurveyForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesAtletaPesquisa';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesAtletaPesquisa';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        
        TTransaction::open(self::$database); // open a transaction

        $this->form = new BootstrapFormBuilder(self::$formName);
                
        $this->form->setFormTitle('Pesquisa');
        
        $criteria_siges_atletas_id = new TCriteria();
        $criteria_siges_atletas_id->setProperty('order', 'name asc');
        
        $id = new THidden('id');

        $siges_atletas_id = new TDBSeekButton('siges_atletas_id', 'siges', self::$formName, 'SystemUsers', 'name', 'siges_atletas_id', 'siges_atletas_id_display' , $criteria_siges_atletas_id );
        
        $siges_atletas_id_display = new TEntry('siges_atletas_id_display');

        $data_pesquisa = new TDate('data_pesquisa');
        $data_pesquisa->addValidation("Data", new TRequiredValidator()); 

        $data_pesquisa->setMask('dd/mm/yyyy');
        $data_pesquisa->setValue(date('d/m/Y'));
        
        $data_pesquisa->setSize(200);

            if (isset($param['key']))
            {
                $object = new stdClass;
                $filterPesquisas = $param['key'];
                TSession::setValue('pesquisa_id', $param['key']);
            }
            else
            {
                $filterPesquisas = TSession::getValue('pesquisa_id');
            }
        
        $criteria_siges_pesquisas_id = new TCriteria();
        $criteria_siges_pesquisas_id->add(new TFilter('id', '=', $filterPesquisas));
        
        $siges_pesquisas_id = new THidden('siges_pesquisas_id');
            
        $criteria_alternativa = new TCriteria();

        $criteria_alternativa->add(new TFilter('siges_pesquisas_id', '=', $filterPesquisas));
        
        $siges_atletas_id->addValidation('Atleta', new TRequiredValidator()); 

        $siges_atletas_id->setDisplayMask('{name}');
        $siges_atletas_id->setAuxiliar($siges_atletas_id_display);

        $id->setEditable(false);
        $siges_atletas_id_display->setEditable(false);

        $id->setSize(100);

        $siges_atletas_id->setSize(70);
        $siges_atletas_id_display->setSize('calc(100% - 100px)');
        //$siges_atletas_id_display->style .= ';margin-left:3px';

        $data_pesquisa->setDatabaseMask('yyyy-mm-dd');

        $siges_pesquisas = new SigesPesquisas($filterPesquisas);
    
        $question = new TRepository('SigesQuestionarios');
        $criteriaQ = new TCriteria;
        $criteriaQ->add(new TFilter('siges_pesquisas_id', '=', $filterPesquisas));
        $questions = $question->load($criteriaQ);
        
        $row1 = $this->form->addFields([$id]);
        $row1->layout = ['col-sm-12'];

        $row2 = $this->form->addFields([new TLabel('Atleta:', null, '14px', null, '100%'),$siges_atletas_id]);
        $row2->layout = ['col-sm-12'];
        
        $row4 = $this->form->addFields([new TLabel('Data da pesquisa:', null, '14px', null, '100%'),$data_pesquisa]);
        $row4->layout = ['col-sm-12'];

        $row3 = $this->form->addFields([$siges_pesquisas_id]);
        $row3->layout = ['col-sm-12'];
 
        $row6 = $this->form->addFields([new TTextDisplay($siges_pesquisas->titulo, null, '24px', 'b')]);
        $row6->layout = ['col-sm-12'];

        $row8 = $this->form->addFields([new TTextDisplay($siges_pesquisas->subtitulo, null, '20px', null)]);
        $row8->layout = ['col-sm-12'];

        $row9 = $this->form->addFields([new TTextDisplay($siges_pesquisas->instrucoes, null, '16px', null)]);
        $row9->layout = ['col-sm-12'];
        
        foreach ($questions as $key_question => $question)
        {
            $alternativa = new TDBRadioGroup('alternativa' . $key_question, 'siges', 'SigesAlternativas', 'valor_alternativa', '{alternativa}','id asc' , $criteria_alternativa );
            $alternativa->addValidation('Alternativa da questão ' . ($key_question+1), new TRequiredValidator());
            $alternativa->setSize(250);
            $alternativa->setLayout('horizontal');

            $siges_question_id = new THidden('siges_question_id[]');
            $siges_question_id->setValue($question->id);
               
            $row[] = array(
                             $this->form->addFields([($key_question+1), ' - ', $question->questoes]),
                             $this->form->addFields([$siges_question_id]),
                             $this->form->addFields([$alternativa])
                            );
        }

        $btn_onclear = $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');
        $btn_onsave = $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(['Pesquisas','Pesquisa de Atleta']));
        
        $container->add($this->form);

        parent::add($container);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $this->form->validate(); // validate form data
            //$atleta_id = TSession::getValue('siges_atletas_id'); // get items
            //var_dump($param['data_pesquisa']);
            if( !empty($param['siges_question_id']) AND is_array($param['siges_question_id']) )
            {
                foreach( $param['siges_question_id'] as $row => $siges_question_id)
                {
                    $alternativa = 'alternativa' . $row;
                    
                    if ($siges_question_id)
                    {
                        $object = new SigesAtletaPesquisa;
                        $object->data_pesquisa = TDate::date2us($param['data_pesquisa']);
                        $object->system_users_id = (int) $param['siges_atletas_id'];
                        $object->siges_pesquisas_id = (int) $param['siges_pesquisas_id'];
                        $object->siges_questionarios_id  = (int) $param['siges_question_id'][$row];
                        $object->resposta  = $param[$alternativa];
                    }
                    $object->store();
                }
            }
            
            $data = new stdClass;
            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data

            TSession::setValue('siges_atletas_id', null);
            TSession::setValue('pesquisa_id', null);
            TTransaction::close(); // close the transaction

            $messageAction = new TAction(['SigesPesquisasList', 'onShow']); 
            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'), $messageAction);

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode>  

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {

    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

    }

    public function onShow($param = null)
    {
        try
        {   
           if (isset($param['key']))
            {
                $object = new stdClass;
                $object->siges_pesquisas_id = $param['key'];
                //TSession::setValue('pesquisa_id', $param['key']);
                //$object->id_db = $param['key'];
                $this->form->setData($object);
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }            
    } 

    public static function onExitSeek($param)
    {
        try
        {   
           if (isset($param['siges_atletas_id']))
            {
                $object = new stdClass;
                $object->hide_atletas_id = $param['siges_atletas_id'];
                TSession::setValue('siges_atletas_id', $param['siges_atletas_id']);
                //$object->id_db = $param['key'];
                TForm::sendData('form_SigesAtletaPesquisa', $object);
                //$this->form->setData($object);
            }
            else
            {
                //$this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }            
    }
    

}