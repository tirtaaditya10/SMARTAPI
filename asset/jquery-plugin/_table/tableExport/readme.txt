BASIC INSTALL

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="tableExport.js">
<script type="text/javascript" src="jquery.base64.js">


TO PDF
<script type="text/javascript" src="jspdf/libs/sprintf.js">
<script type="text/javascript" src="jspdf/jspdf.js">
<script type="text/javascript" src="jspdf/libs/base64.js">

TP PNG
<script type="text/javascript" src="html2canvas.js">

USAGE
<a href="#" onClick ="$('#tableID').tableExport({type:'json',escape:'false'});">JSON</a>
<a href="#" onClick ="$('#tableID').tableExport({type:'excel',escape:'false'});">XLS</a>
<a href="#" onClick ="$('#tableID').tableExport({type:'csv',escape:'false'});">CSV</a>
<a href="#" onClick ="$('#tableID').tableExport({type:'pdf',escape:'false'});">PDF</a>

OTHER TYPE
{type:'json',escape:'false'}
{type:'json',escape:'false',ignoreColumn:'[2,3]'}
{type:'json',escape:'true'}
{type:'xml',escape:'false'}
{type:'sql'}
{type:'csv',escape:'false'}
{type:'txt',escape:'false'}
{type:'excel',escape:'false'}
{type:'doc',escape:'false'}
{type:'powerpoint',escape:'false'}
{type:'png',escape:'false'}
{type:'pdf',pdfFontSize:'7',escape:'false'}