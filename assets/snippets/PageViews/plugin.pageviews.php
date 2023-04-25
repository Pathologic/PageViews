<?php
if (!defined('IN_MANAGER_MODE')) die();
if ($modx->event->name == 'OnEmptyTrash') {
    if (empty($ids)) return;
    $where = implode(',', $ids);
    $ld_table = $modx->getFullTableName('pageviews');
    $modx->db->delete($pv_table, "`rid` IN ($where)");
}
if ($modx->event->name == 'OnDocFormRender') {
    if(empty($modx->event->params['id'])) return;
    $views = $modx->runSnippet('PageViews', ['rid' => $modx->event->params['id'], 'tpl' => '@CODE: ([+views+])']);
    $modx->event->addOutput("<script>document.addEventListener('DOMContentLoaded', function(){const pageviews = '{$views}'; const btn = document.querySelector('#Button4 > span'); btn.innerText += pageviews;})</script>");
}
