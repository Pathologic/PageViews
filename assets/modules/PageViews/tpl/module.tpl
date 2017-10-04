<!DOCTYPE html>
<html>
<head>
    <title>Просмотры страниц</title>
    <link rel="stylesheet" type="text/css" href="[+manager_url+]media/style/[+theme+]/style.css" />
    <link rel="stylesheet" href="[+manager_url+]media/style/common/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="[+site_url+]assets/js/easy-ui/themes/modx/easyui.css"/>
    <script type="text/javascript" src="[+manager_url+]media/script/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="[+site_url+]assets/js/easy-ui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="[+site_url+]assets/js/easy-ui/locale/easyui-lang-ru.js"></script>
    <script type="text/javascript" src="[+site_url+]assets/modules/PageViews/js/module.js"></script>
    <script type="text/javascript">
        var Config = {
            url:'[+connector+]'
        };
    </script>
    <style>
        .datagrid-view td {
            vertical-align: middle;
        }
        .pagination td{
            font-size:12px;
        }
    </style>
</head>
<body>
<h1 class="pagetitle">
  <span class="pagetitle-icon">
    <i class="fa fa-eye"></i>
  </span>
    <span class="pagetitle-text">
    Просмотры страниц
  </span>
</h1>
<div id="actions">
    <ul class="actionButtons">
        <li><a href="#" onclick="document.location.href='index.php?a=106';">Закрыть модуль</a></li>
    </ul>
</div>
<div class="sectionBody">
    <div class="dynamic-tab-pane-control tab-pane">
        <div class="tab-page">
            <table id="pageviews" width="100%"></table>
        </div>
    </div>
</div>
<script>
    GridHelper.initGrid();
</script>
</body>
</html>
