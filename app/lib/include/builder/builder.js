function __adianti_builder_edit_page()
{
    var url = Adianti.currentURL;
    url = url.replace('engine.php?', '');
    var params = __adianti_query_to_json(url);
    var controller = params['class'];
    __adianti_load_page('index.php?class=BuilderPageService&method=editPage&static=1&controller='+controller);
}

function number_format(number, decimals, decPoint, thousandsSep) { // eslint-disable-line camelcase

    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    var n = !isFinite(+number) ? 0 : +number
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    var s = ''

    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec)
        return '' + (Math.round(n * k) / k)
            .toFixed(prec)
    }

    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }

    return s.join(dec)
}

window.Builder = ( function() {

    const toogleButtonExecutar =  function(element) {
        if( $(element).is(':checked') ) {
            $('#tbutton_btn_executar').attr('disabled', false);
        } else {
            $('#tbutton_btn_executar').attr('disabled', true);
        }
    }

    const adjustOptions = function() {
        $('select[name^=news_]:first option').each(function(index, element) {
            var value = $(this).val();

            if(value) {
                if( $(`option[value=${value}]:selected`).length == 0) {
                    $(`option[value=${value}]:not(:selected)`).show();
                    unblockLineDropTable(value);
                } else {
                    $(`option[value=${value}]:not(:selected)`).hide();
                    var name = $(`option[value=${value}]:selected`).closest('select').attr('name').substring(5);
                    blockLineDropTable(value, name);
                }
            }
        });
    };

    const adjustChecksTablesDiff = function() {
        $('#database-merge #tableDiffForm input[type=checkbox]').change(function(evt){

            if(! $(this).is(':checked')) {
                evt.preventDefault();
                evt.stopPropagation();
                $(this).closest('label').toggleClass('active');
                return;
            }

            var id = $(this).attr('id');
            var value = $(this).val();
            var row   = $(this).closest('tr');

            var odd = $(this).closest('div').find(`input:not('#${id}')`);


            odd.prop('checked', false);
            odd.closest('label').removeClass('active');

            changeStatus($(this));

            if(value && $(this).is(':checked')) {
                $(`select[name=news_${value}]`).val('');
                $(`select[name=news_${value}]`).hide('highlight');
                adjustOptions();
            } else {
                value = odd.val();
                $(`select[name=news_${value}]`).show('highlight');
            }
        });
    };

    const comandsSqls = {}

    const warningTables = {}

    const changeSql = function(element) {
        var id = $(element).val().replace("commands_", "");
        var checked = $(element).is(':checked');
        var info = id.split('_-_');

        if( info.length == 1 ) {
            $(`input[name="commands_${id}[]"]`)
                .closest('.table-column-diff-name')
                .next()
                .find(`input[name^="commands_${id}"]`)
                .prop('checked', checked).change();
        }

        if(checked) {
            $(`.commands div#${id}`).show('highlight');
        } else {
            $(`.commands div#${id}`).hide('highlight');
        }
    }

    const setSqlCommands = function() {
        $.each($('.commands div'), function(index, element){
            var id = $(element).attr('id');
            var targets = id.split('_-_');
            if(targets[1]) {
                var sql = Builder.getSqlColumn(targets[0], targets[1]);
                sql = sql.replace(/;/g, ';<br>');
                $(element).html(sql);
            } else {
                var sql = Builder.getSqlTable(targets[0]);
                sql = sql.replace(/;/g, ';<br>');
                $(element).html(sql);
            }
        });

        $('[id^=commands_]').each(function(index, el){
            var value = $(el).attr('id').replace('commands_', '');
           Builder.defineColumnRename(value);
        });

        $("table tr:not('.warning'):not(':first')").filter(":odd").css("background-color", "rgba(0,0,0,.05)");

        $.each(Builder.warningTables, function(table, columns) {
            $.each(columns, function(column, warnings){
                $(`#warning-${table}_-_${column}`).show();
                $(`#warning-${table}_-_${column}`).addClass('hasWarnings');
                $(`[name^='commands_${table}_-_${column}']`).prop('checked', false);
                $(`.commands div#${table}_-_${column}`).hide();

                let msg = "Atenção! A coluna <b>" + column +  "</b> contém: <br/>" +  warnings.join('<br/>') + '<br/> Caso queira executar o comando basta marcar a coluna';
                $(`#warning-${table}_-_${column}`).attr('title', msg);
            });
        });
    }

    const processErrors = function(sqlsSuccess, sqlError) {

        var divSuccess = '<div class="success"><span><i class="fa fa-check"></i></span><span>{command}</span></div>';
        var divError   = '<div class="error"><span><i class="fa fa-times"></i></span><span>{command}</span></div>';

        $('form[name=ConfirmCommandsDiffForm] #results').closest('.row').show();

        $('form[name=ConfirmCommandsDiffForm] #results div').remove();
        var value = $('form[name=ConfirmCommandsDiffForm] textarea[name=commands]').val();

        $.each(sqlsSuccess, function(index, el) {
            var div = divSuccess;
            div = div.replace(/{command}/g, el);
            $('form[name=ConfirmCommandsDiffForm] #results').append(div);

            value = value.replace(el+";", '');
        });

        var div = divError;
        div = div.replace(/{command}/g, sqlError);

        $('form[name=ConfirmCommandsDiffForm] #results').append(div);
        $('form[name=ConfirmCommandsDiffForm] textarea[name=commands]').val(value.trim());
    }

    const getSqlTable = function(tableName) {
        commands = '';
        if(! Builder.comandsSqls[tableName]) {
            return commands;
        }

        if(Builder.comandsSqls[tableName].drop) {
            if(Builder.comandsSqls[tableName].drop.drop_fk) {
                commands += Builder.comandsSqls[tableName].drop.drop_fk;
            }

            commands += Builder.comandsSqls[tableName].drop.drop_table;
        }

        if(Builder.comandsSqls[tableName].rename) {
            commands += Builder.comandsSqls[tableName].rename;
        }

        if(Builder.comandsSqls[tableName].create) {
            commands += Builder.comandsSqls[tableName].create.create_table;

            if(Builder.comandsSqls[tableName].create.create_fk) {
                commands += Builder.comandsSqls[tableName].create.create_fk;
            }
        }

        return commands;
    }

    const getSqlColumn = function(tableName, columnName) {
        if(! Builder.comandsSqls[tableName]) {
            return '';
        }

        if(Builder.comandsSqls[tableName].adjust && Builder.comandsSqls[tableName].adjust[columnName]) {
            return Builder.comandsSqls[tableName].adjust[columnName];
        }

        return '';
    }

    const defineColumnRename = function(table)
    {
        $(`[id^='${table}']`).css('opacity', 1);

        $(`[name='colunas+new+${table}[]']`).each(
            function(index, ele) {
                let column = $(ele).val();
                column = column.split('<=>');
                if(column.length > 1) {
                    column = column[1].split('->');
                    column = column[1];
                    $(`#${table}_-_${column}`).css('opacity', 0.5);
                    $(`#${table}_-_${column} [role=group]`).css('display', 'none');
                }
            }
        );
    }

    const blockLineDropTable = function(table, tableBuilder) {

        var row = $(`[name="drops[][]"][value=${table}]`).closest('tr');
        var msg = `<label class="label">A tabela <b>${table}</b> será <span class="badge bg-orange">renomeada</span> para <b>${tableBuilder}</b> na base de dados, e pode sofrer alterações nas estrutura das colunas. <br/>* Essa alteração <u>mantêm</u> os dados da tabela <b>${table}</b>.</label>`;

        row.find('.div-status').html(msg);
        $(`select[name^=news_] option[value="${table}"]:selected`).closest('tr').find('.div-status').html(msg);

        row.css('opacity', '0.2');
        row.find('input').attr('disabled', true);
    }

    const unblockLineDropTable = function(table) {
        var row = $(`[name="drops[][]"][value=${table}]`).closest('tr');

        row.css('opacity', '1');
        row.find('input').attr('disabled', false);

        if(row.find('input:first').is(':checked')) {
            var value = row.find('input:first').closest('label').data('reference');
            row.find('.div-status').html(`<label class="label">A tabela <b>${value}</b> será <span class="badge bg-black">mantida</span> do banco de dados sem sofrer alterações</label>`);
        } else if(row.find('input:last').is(':checked')) {
            var value = row.find('input:last').closest('label').data('reference');
            row.find('.div-status').html(`<label class="label">A tabela <b>${value}</b> será <span class="badge bg-red-active">removida</span> do banco de dados</label>`);
        } else {
            var value = row.find('input:last').closest('label').data('reference');
            row.find('.div-status').html(`<label class="label">A tabela <b>${value}</b> <span class="badge bg-red">não foi encontrada</span> no modelo do Builder</label>`);
        }
    }

    const changeStatus = function(check) {
        var message = '';
        var table = check.closest('label').data('reference');

        if(check.attr('name') =="news[][]" && ! check.val())
        {
            message = `<label class="label">A tabela <b>${table}</b> será <span class="badge bg-orange">renomeada</span> com uma tabela da base de dados</label>`;
        }
        else if(check.attr('name') =="news[][]" && check.val())
        {
            message = `<label class="label">A tabela <b>${table}</b> será <span class="badge bg-green">adicionada</span> na base de dados</label>`;
        }
        else if (check.attr('name') =="drops[][]" && ! check.val())
        {
            message = `<label class="label">A tabela <b>${table}</b> será <span class="badge bg-black">mantida</span> do banco de dados sem sofrer alterações</label>`;
        }
        else if (check.attr('name') =="drops[][]" && check.val())
        {
            message = `<label class="label">A tabela <b>${table}</b> será <span class="badge bg-red-active">removida</span> do banco de dados</label>`;
        }


       check.closest('tr').find('.div-status').html(message);
    }

    const setRenameTable = function(combo) {
        adjustOptions();
    }

    const setDataRenameTable = function(tables) {
        for (var i = tables.length - 1; i >= 0; i--) {
            var new_table = tables[i];
            var table = new_table.substring(5);
            $(`[data-reference='${table}'] input:first`).prop('checked', true).change();
            $(`[data-reference='${table}'] input:first`).closest('label').addClass('active');
            $(`select[name=${new_table}]`).show();
        }

        adjustOptions();

        $('input[name="news[][]"][value!=""]:checked').change();
    }

    const checkAllCheckboxes = function(formName, type)
    {
        $('form[name="'+formName+'"]').find('input[type="checkbox"]').each(function(){
            if(type == 'uncheck')
            {
                $(this).prop('checked', false);
            }
            else if(type == 'check')
            {
                $(this).prop('checked', true);
            }
            else if(type == 'invert')
            {
                $(this).prop('checked', !$(this).prop('checked'));
            }
        });    
    }
    
    const editPage = function()
    {
        var url = Adianti.currentURL;
        url = url.replace('engine.php?', '');
        var params = __adianti_query_to_json(url);
        var controller = params['class'];
        __adianti_load_page('index.php?class=BuilderPageService&method=editPage&static=1&controller='+controller);
    }
    
    const initMonacoEditor = function(value_selector, language)
    {
        if(typeof Builder.editor != 'undefined')
        {
            Builder.editor.dispose();
        }
        
        Builder.editor = monaco.editor.create(document.getElementById('monaco-code-editor-container'), {
            value: $(value_selector).val(),
            language: language
        });
        
        monaco.editor.setModelLanguage(monaco.editor.getModels()[0], language);
        
        Builder.editor.onDidChangeModelContent((event) => {
            $(value_selector).val(Builder.editor.getValue());
        });
    }
    
    return {
        checkAllCheckboxes: checkAllCheckboxes,
        editPage: editPage,
        adjustOptions: adjustOptions,
        setRenameTable: setRenameTable,
        setDataRenameTable: setDataRenameTable,
        initMonacoEditor: initMonacoEditor,
        adjustChecksTablesDiff: adjustChecksTablesDiff,
        defineColumnRename: defineColumnRename,
        comandsSqls: comandsSqls,
        warningTables: warningTables,
        getSqlColumn: getSqlColumn,
        getSqlTable: getSqlTable,
        changeSql: changeSql,
        setSqlCommands: setSqlCommands,
        processErrors: processErrors,
        toogleButtonExecutar: toogleButtonExecutar
    };

})();