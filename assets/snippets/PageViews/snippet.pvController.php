<?php
$params = array_merge(array(
    "controller"    =>  "pageviews",
    "dir"        =>  "assets/snippets/PageViews/DocLister/",
    "selectFields" => "c.*,COALESCE(pv.views,0) AS views"
), $modx->event->params);

return $modx->runSnippet("DocLister", $params);
