INSTALL

<script src="xlsx.core.js"></script>
<script src="FileSaver.js"></script>
 ...
<script src="tableexport.js"></script>

USAGE

new TableExport(document.getElementsByTagName("table"));

// OR simply

TableExport(document.getElementsByTagName("table"));

// OR using jQuery

$("table").tableExport();

OPTION

/* Defaults */
TableExport(document.getElementsByTagName("table"), {
    headers: true,                              // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
    footers: true,                              // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
    formats: ['xlsx', 'csv', 'txt'],            // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
    filename: 'id',                             // (id, String), filename for the downloaded file, (default: 'id')
    bootstrap: false,                           // (Boolean), style buttons using bootstrap, (default: true)
    exportButtons: true,                        // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
    position: 'bottom',                         // (top, bottom), position of the caption element relative to table, (default: 'bottom')
    ignoreRows: null,                           // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
    ignoreCols: null,                           // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
    trimWhitespace: true                        // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
});