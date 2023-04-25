<?php
include_once(MODX_BASE_PATH . 'assets/snippets/PageViews/model/pageviews.php');
include_once(MODX_BASE_PATH . 'assets/snippets/DocLister/lib/DLTemplate.class.php');
$rid = isset($rid) ? (int)$rid : (isset($modx->documentIdentifier) && $modx->documentIdentifier ? $modx->documentIdentifier : 0);
$tpl = isset($tpl) ? $tpl : '@CODE:[+views+]';
$unit = isset($unit) ? $unit : 'просмотр,просмотра,просмотров';
$model = new \PageViews\Model($modx);
$model->hit($rid);


$views = $model->stat($rid);
$unit = explode(',',$unit);
if (count($unit) > 2) {
    $cases = [2, 0, 1, 1, 1, 2];
    $unit = sprintf($unit[ ($views%100>4 && $views%100<20) ? 2 : $cases[min($views%10, 5)] ], $views);
} else {
    $unit = '';
}

if ($tpl) {
    return DLTemplate::getInstance($modx)->parseChunk($tpl,array(
        "views"       => $views,
        "unit"      => $unit
    ));
} else {
   $modx->setPlaceholder('pageviews', $views);
}
