<?php namespace PageViews;
/**
 * Class Model
 * @package PageViews
 */
class Model {
    protected $modx = null;
    protected $table = 'pageviews';

    /**
     * PageViews constructor.
     * @param \DocumentParser $modx
     */
    public function __construct(\DocumentParser $modx) {
        $this->modx = $modx;
        $this->table = $modx->getFullTableName($this->table);
        if (!isset($_SESSION['pageviews'])) $_SESSION['pageviews'] = array();
    }

    /**
     * @param int $resourceId
     * @return $this
     */
    public function hit($resourceId) {
        $resourceId = (int)$resourceId;
        if (!$this->modx->getLoginUserID('mgr') && $resourceId && !in_array($resourceId, $_SESSION['pageviews'])) {
            $classKey = $this->modx->db->escape($classKey);
            $this->modx->db->query("INSERT INTO {$this->table} (`rid`, `views`) VALUES ({$resourceId}, 1) ON DUPLICATE KEY UPDATE `views` = `views` + 1");
            $_SESSION['pageviews'][] = $resourceId;
        }

        return $this;
    }

    /**
     * @param $resourceId
     * @param string $classKey
     * @return array
     */
    public function stat($resourceId) {
        $out = 0;
        $resourceId = (int)$resourceId;
        if ($resourceId) {
            $q = $this->modx->db->query("SELECT COALESCE(views,0) FROM {$this->table} WHERE `rid`={$resourceId}");
            $out = (int)$this->modx->db->getValue($q);
        }

        return $out;
    }

    /**
     * @param $resourceId
     */
    public function reset($resourceId) {
        $resourceId = (int)$resourceId;
        if ($resourceId) {
            $this->modx->db->query("DELETE FROM {$this->table} WHERE `rid`={$resourceId}");
        }
    }

    public function createTable() {
        $q = "CREATE TABLE IF NOT EXISTS {$this->table} (
            `rid` INT(10) NOT NULL UNIQUE,
            `views` INT(10) NOT NULL DEFAULT 0,
            KEY `views` (`views`)
            ) Engine=MyISAM
            ";
        $this->modx->db->query($q);
    }
}
