var columns = [ [
    {
        field:'pagetitle',
        title:'Название документа',
        sortable:true,
        width:200,
        formatter: function(value,row) {
            return row.crumbs + '<b>'+value
                .replace(/&/g, '&amp;')
                .replace(/>/g, '&gt;')
                .replace(/</g, '&lt;')
                .replace(/"/g, '&quot;')+'</b>';
        }
    },
    {
        field:'views',
        width:80,
        fixed:true,
        align:'center',
        title:'<span style="color:#9c27b0;" class="fa fa-lg fa-eye"></span>',
        sortable:true
    },
    {
        field:'action',
        width:40,
        title:'',
        align:'center',
        fixed:true,
        formatter:function(value,row){
                return '<a class="action delete" href="javascript:void(0)" onclick="GridHelper.reset('+row.rid+')" title="Обнулить"><i class="fa fa-eraser fa-lg"></i></a>';
        }
    }
] ];
var GridHelper = {
    reset: function(rid) {
        if (rid){
            $.post(
                Config.url+'?mode=reset',
                {
                    rid:rid
                },
                function(data) {
                    if(data.success) {
                        $('#pageviews').datagrid('reload');
                    } else {
                        $.messager.alert('Ошибка','Не удалось выполнить');
                    }
                },'json'
            ).fail(GridHelper.handleAjaxError);
        }
    },
    handleAjaxError: function(xhr){
        var message = xhr.status == 200 ? 'Не удалось обработать ответ сервера' : 'Ошибка сервера ' + xhr.status + ' ' + xhr.statusText;
        $.messager.alert('Ошибка', message, 'error');
    },
    initGrid: function () {
        $('#pageviews').datagrid({
            url: Config.url,
            fitColumns:true,
            pagination:true,
            pageSize:50,
            pageList: [ 50, 100, 150, 200 ],
            idField:'rid',
            singleSelect:true,
            striped:true,
            checkOnSelect:false,
            selectOnCheck:false,
            sortName:'views',
            sortOrder:'desc',
            columns: columns
        });
    }
};

