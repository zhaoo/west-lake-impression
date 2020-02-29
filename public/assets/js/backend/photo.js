define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'photo/index',
                    add_url: 'photo/add',
                    edit_url: 'photo/edit',
                    del_url: 'photo/del',
                    multi_url: 'photo/multi',
                    table: 'photo',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'image', title: __('Image'), formatter: Table.api.formatter.image},
                        {field: 'title', title: __('Title')},
                        {field: 'uploadtime', title: __('Uploadtime'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'scenic_id', title: __('Scenic_id')},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'status', title: __('Status'), searchList: {"open":__('Open'),"close":__('Close')}, formatter: Table.api.formatter.status},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});