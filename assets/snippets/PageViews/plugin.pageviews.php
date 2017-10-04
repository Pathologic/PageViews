<?php
if (IN_MANAGER_MODE != 'true') die();
if ($e->name == 'OnEmptyTrash') {
    if (empty($ids)) return;
    $where = implode(',', $ids);
    $ld_table = $modx->getFullTableName('pageviews');
    $modx->db->delete($pv_table, "`rid` IN ($where)");
}
