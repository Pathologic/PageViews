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
            'connector'	    => MODX_SITE_URL . 'assets/modules/PageViews/ajax.php',
            'theme' => $this->modx->getConfig('manager_theme'),
            'site_url'		=>	MODX_SITE_URL,
            'manager_url'	=>	MODX_MANAGER_URL
        );
        $output = $this->DLTemplate->parseChunk('@FILE:module',$ph);

        return $output;
    }
}
