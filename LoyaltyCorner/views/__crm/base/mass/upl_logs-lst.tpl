{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_21"}
    <div class="widget-toolbar" id="widget_toolbar_21" style="display:none;">
        <button class="button-icon btn btn-danger" title="Upload to Stage II"><i class="fa fa-gear"></i> Upload to Stage II</button>
    </div>
{/block}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DATA ENTITY"    field="upl_entity_type"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="FILE NAME" field="upl_filename"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="STAGE"     field="upl_stage"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="STATUS"    field="upl_status"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ROWS"      field="upl_rows_src"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED BY"    field="aaa_account" break="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED TIME" field="created_on"  break="all"}
{/block}
{block name="td_ext"}
    <td>{$i.upl_entity_type}</td>
    <td>{$i.upl_filename}</td>
    <td class="stage" data-val="{$i.upl_stage_id}">{$i.upl_stage}</td>
    <td class="stats" data-val="{$i.upl_status_id}">{$i.upl_status}</td>
    <td>{$i.upl_rows_src}</td>
    <td>{$i.aaa_account}</td>
    <td>{$i.created_on}</td>
{/block}
{block name="tfooter_ext"}
    <tfoot>
    <td></td><td></td>
    <td></td>
    <td></td>
    <td>Total Records</td>
    <td>{$sys.rsp.aux.tot_upl_rows}</td>
    <td></td>
    </tfoot>
{/block}
{block name="jquery_page_ready"}
    $('table.footable tbody tr').click(function(e) {
        $('#widget_toolbar_21').hide();

        var row     = $(this),
            stage   = parseInt(row.find('td[class="stage"]').data('val')),
            stats   = parseInt(row.find('td[class="stats"]').data('val'));
        row.siblings().removeClass('bg-gray')
        if(stage == 5) {
            row.addClass('bg-gray');
            $('#widget_toolbar_21').show();
        }
    });
{/block}
{block name="script_page_pst"}
    <script>
        jQuery(function() {
            $('#svc_file').change(ExportToTable);
        });
        function ExportToTable() {
	        $('.btn-import').click();
            var regex   = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;
            var svc_f   = $('#svc_file');
            // Checks whether the file is a valid excel file
            if (regex.test(svc_f.val().toLowerCase())) {
	            // Flag for checking whether excel is .xls format or .xlsx format
                var flag_xlsx = false;
                var file_name = svc_f.val();

                if (file_name.toLowerCase().indexOf(".xlsx") > 0) {
                    flag_xlsx = true;
                }
                /*Checks whether the browser supports HTML5*/
                if (typeof (FileReader) !== "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var data = e.target.result;
                        /*Converts the excel data in to object*/
                        if (flag_xlsx) {
                            var workbook = XLSX.read(data, { type: 'binary' });
                        }
                        else {
                            var workbook = XLS.read(data, { type: 'binary' });
                        }

 	                    $.get(AGV.host + 'svc/upl/tpl_xls_buffer', function(html) {
	                        $('#PCD').html(html);

	                        /*Gets all the sheetnames of excel in to a variable*/
	                        var sheets  = workbook.SheetNames;
	                        var cnt     = 0;
	                        var exceljson;
                            var post_json = { };
                            var tBody   = $('#TFBody');

	                        /* This is used for restricting the script to consider only first sheet of excel */
	                        /* Iterate through all sheets */
	                        sheets.forEach(function (sheet) {
		                        /* Convert the cell value to Json */
                                var s = sheet.replace(/\+/g, '__');

		                        if (flag_xlsx) {
			                        exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[sheet], { header: "A" });
		                        }
		                        else {
			                        exceljson = XLS.utils.sheet_to_json(workbook.Sheets[sheet], { header: "A" });
		                        }
		                        if (exceljson.length > 0 && cnt == 0) {
			                        BindTable(exceljson, '#TFBody');
			                        post_json[s] = exceljson;
			                        cnt++;
		                        }
	                        });

	                        tBody.children().eq(0).appendTo($('#TFHead'));
	                        tBody.children().eq(0).each(function() {
		                        $(this).find('td').contents().unwrap().wrap('<th>');
                            }).appendTo($('#TFHead'));

	                        // $('#TFHead').append($('#TFBody').children().eq(1));
	                        $('#PCD').show().prev().hide();
                            $('#btnPostXLS').prepend(tBody.children().length + ' Rows Read ! ');
	                        $('#btnPostXLS').click(function () {
	                        	var pst = {
	                        		"svc_file": file_name,
	                        		"svc_code": $('#svc_code').val(),
                                    "svc_data": JSON.stringify(post_json)
	                        	};
		                        $.post(AGV.host + 'svc/upl/jsn/{$sys.req.rid}', pst, function (ack) {
			                        if (ack.err) {
				                        toastr.options.positionClass = "toast-top-right";
				                        toastr.error(data.msg, data.err);
				                        console.log('ERRORS: ' + data.msg);
			                        }
			                        else {
				                        toastr.options.positionClass = "toast-top-right";
				                        toastr.success('File Success Uploaded', 'Success!');
				                        location.reload();
				                        // $('#M_' + {$sys.req.rid}).click();
			                        }
		                        });
	                        });
                        });
                    }
                    if (flag_xlsx) {
                        /*If excel file is .xlsx extension than creates a Array Buffer from excel*/
                         reader.readAsArrayBuffer(svc_f[0].files[0]);
                     }
                    else {
                        reader.readAsBinaryString(svc_f[0].files[0]);
                    }
                }
                else {
                    alert("Sorry! Your browser does not support HTML5!");
                }
            }
            else {
                alert("Please upload a valid Excel file!");
            }
        }
        function BindTable(jsondata, tableid) {
            /*Function used to convert the JSON array to Html Table*/

            var columns = BindTableHeader(jsondata, tableid); /*Gets all the column headings of Excel*/
            for (var i = 0; i < jsondata.length; i++) {
                var row$ = $('<tr/>');
                for (var colIndex = 0; colIndex < columns.length; colIndex++) {
                    var cellValue = jsondata[i][columns[colIndex]];
                    if (cellValue == null)
                        cellValue = "";
                    row$.append($('<td/>').html(cellValue));
                }
	            $(tableid).append(row$);
            }
        }
        function BindTableHeader(jsondata, tableid) {
            /*Function used to get all column names from JSON and bind the html table header*/
             var columnSet = [];
             var headerTr$ = $('<tr/>');
             for (var i = 0; i < jsondata.length; i++) {
                 var rowHash = jsondata[i];
                 for (var key in rowHash) {
                     if (rowHash.hasOwnProperty(key)) {
                         if ($.inArray(key, columnSet) == -1) {
                             /* Adding each unique column names to a variable array */
                             columnSet.push(key);
                             headerTr$.append($('<th/>').html(key));
                         }
                    }
                 }
            }
            $(tableid).append(headerTr$);
            return columnSet;
        }
        load_asset('js/plugin/sheet.js/js/xlsx.full.min.js');
    </script>
{/block}
