<?php
include_once(MODX_BASE_PATH . 'assets/snippets/DocLister/core/controller/site_content.php');

/**
 * Class pageviewsDocLister
 */
class pageviewsDocLister extends site_contentDocLister
{
    public function __construct ($modx, $cfg = array(), $startTime = null)
    {
        parent::__construct($modx, $cfg, $startTime);
        $this->setFiltersJoin(" LEFT JOIN {$this->getTable('pageviews', 'pv')} ON `pv`.`rid`=`c`.`id`");
    }
    
    public static function prepare(array $data = array(), DocumentParser $modx, $_DocLister, prepare_DL_Extender $_extDocLister){
        $unit = $_DocLister->getCFGDef('unit','просмотр,просмотра,просмотров');
        $unit = explode(',',$unit);
        if (isset($data['views']) && count($unit>2)) {
            $cases = [2, 0, 1, 1, 1, 2];
            $data['unit'] = sprintf($unit[ ($data['views']%100>4 && $data['views']%100<20) ? 2 : $cases[min($data['views']%10, 5)] ], $data['views']);
        }

        return $data;
    }
}
