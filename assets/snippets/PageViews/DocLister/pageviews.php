<?php
include_once(MODX_BASE_PATH . 'assets/snippets/DocLister/core/controller/site_content.php');

/**
 * Class pageviewsDocLister
 */
class pageviewsDocLister extends site_contentDocLister
{
    /**
     * Генерация имени таблицы с префиксом и алиасом
     *
     * @param string $name имя таблицы
     * @param string $alias желаемый алиас таблицы
     * @return string имя таблицы с префиксом и алиасом
     */
    public function getTable($name, $alias = '')
    {
        $table = parent::getTable($name, $alias);
        if ($name == 'site_content') {
            $pv_table = $this->modx->getFullTableName('pageviews');
            $table .= " LEFT JOIN {$pv_table} `pv` ON `pv`.`rid`=`c`.`id`";
        }
        
        return $table;
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
