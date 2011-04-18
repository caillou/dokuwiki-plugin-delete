<?php

 
if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once DOKU_PLUGIN.'action.php';
 
class action_plugin_delete extends DokuWiki_Action_Plugin {
 
    function getInfo()
    {
        return confToHash(dirname(__FILE__).'/plugin.info.txt');
    }

    public function register(&$controller) {
        $controller->register_hook('HTML_EDITFORM_OUTPUT', 'BEFORE', $this, 'addButton');
        $controller->register_hook('ACTION_ACT_PREPROCESS', 'BEFORE', $this, 'processAction');
        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'includeJs');
    }
 
    public function addButton($event)
    {
        global $lang;
        
        $form = $event->data;

        $position = $form->findElementById('edbtn__save') + 1;
        
        $button = array ( '_elem' => 'button',
            'type' => 'submit',
            '_action' => 'delete',
            'value' => $lang['btn_delete'],
            'class' => 'button',
            'id' => 'edbtn__delete',
            'accesskey' => 'd',
            'title' => $lang['btn_delete'] . ' [D]'
        );
        
        $form->insertElement($position, $button);
        
    }
    
    public function processAction($event)
    {
        global $ACT;
        global $TEXT;

        if (!(is_array($ACT) && isset($ACT['delete']))) {
            return;
        }

        $TEXT = '';
        $ACT = 'save';
        
    }
    
    public function includeJs($event)
    {
        $event->data['script'][] = array(
            'type'    => 'text/javascript',
            'charset' => 'utf-8',
            '_data'   => '',
            'src'     => DOKU_BASE . 'lib/plugins/delete/js/edit.js'
        );
    }

}