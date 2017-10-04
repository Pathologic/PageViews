<?php namespace PageViews;
include_once (MODX_BASE_PATH . 'assets/snippets/DocLister/lib/DLTemplate.class.php');
include_once (MODX_BASE_PATH . 'assets/snippets/PageViews/model/pageviews.php');
include_once (MODX_BASE_PATH . 'assets/lib/APIHelpers.class.php');


class Module {
    protected $modx = null;
    protected $params = array();
    protected $DLTemplate = null;


    public function __construct(\DocumentParser $modx, $debug = false) {
        $this->modx = $modx;
        $this->params = $modx->event->params;
        $this->DLTemplate = \DLTemplate::getInstance($this->modx);
        $ld = new Model($modx);
        $ld->createTable();
    }

    /**
     * @return bool|string
     */
    public function render() {
        $this->DLTemplate->setTemplatePath('assets/modules/PageViews/tpl/');
        $this->DLTemplate->setTemplateExtension('tpl');
        $ph = array(
            'connector'	    => 	$this->modx->config['site_url'].'assets/modules/PageViews/ajax.php',
            'theme' => $this->modx->config['manager_theme'],
            'site_url'		=>	$this->modx->config['site_url'],
            'manager_url'	=>	MODX_MANAGER_URL
        );
        $output = $this->DLTemplate->parseChunk('@FILE:module',$ph);
        
        return $output;
    }
}
