/* oss.sheetjs.com (C) 2014-present SheetJS -- http://sheetjs.com */
/* vim: set ts=2: */
var path_worker = AGV.asset + 'js/worker/';

var sheet_drop = function DropSheet(opts) {
	if (!opts) opts = {};
	var nullfunc = function () {
	};
	if (!opts.errors) opts.errors = {};
	if (!opts.errors.badfile) opts.errors.badfile = nullfunc;
	if (!opts.errors.pending) opts.errors.pending = nullfunc;
	if (!opts.errors.failed) opts.errors.failed = nullfunc;
	if (!opts.errors.large) opts.errors.large = nullfunc;
	if (!opts.on) opts.on = {};
	if (!opts.on.workstart) opts.on.workstart = nullfunc;
	if (!opts.on.workend) opts.on.workend = nullfunc;
	if (!opts.on.sheet) opts.on.sheet = nullfunc;
	if (!opts.on.wb) opts.on.wb = nullfunc;
	
	var rABS = typeof FileReader !== 'undefined' && FileReader.prototype && FileReader.prototype.readAsBinaryString;
	var useworker = typeof Worker !== 'undefined';
	var pending = false;
	
	function fix_data(data) {
		var o = "", l = 0, w = 10240;
		for (; l < data.byteLength / w; ++l)
			o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w, l * w + w)));
		
		o += String.fromCharCode.apply(null, new Uint8Array(data.slice(o.length)));
		return o;
	}
	
	function sheet_worker(data, call_back, read_type) {
		pending = true;
		opts.on.workstart();
		
		var worker = new Worker(path_worker + 'sheetJS.js');
		worker.onmessage = function (e) {
			switch (e.data.t) {
				case 'ready':
					break;
				case 'e':
					pending = false;
					console.error(e.data.d);
					break;
				case 'xlsx':
					pending = false;
					opts.on.workend();
					call_back(JSON.parse(e.data.d));
					break;
			}
		};
		worker.postMessage({d: data, b: read_type, t: 'xlsx'});
	}
	
	var last_wb;
	
	function to_json(workbook) {
		if (useworker && workbook.SSF)
			XLSX.SSF.load_table(workbook.SSF);
		var result = {};
		workbook.SheetNames.forEach(function (sheetName) {
			var roa = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], {header: 1});
			if (roa.length > 0) result[sheetName] = roa;
		});
		return result;
	}
	
	function choose_sheet(sheetidx) {
		read_worksheet(last_wb, sheetidx);
	}
	
	function read_worksheet(wb, sheetidx) {
		last_wb = wb;
		opts.on.wb(wb, sheetidx);
		var sheet = wb.SheetNames[sheetidx || 0];
		var json  = to_json(wb)[sheet];
		opts.on.sheet(json, wb.SheetNames, choose_sheet);
	}
	
	function handle_file(e) {
		if (pending) return opts.errors.pending();
		var files = e.target.files;
		var i, f;
		for (i = 0, f = files[i]; i != files.length; ++i) {
			var reader  = new FileReader();
			var name    = f.name;
			reader.onload = function (e) {
				var data        = e.target.result;
				var read_type   = {type: rABS ? 'binary' : 'base64'};
				if (!rABS)
					data = btoa(fix_data(data));
				
				function read_workbook() {
					try {
						if (useworker) {
							sheet_worker(data, read_worksheet, read_type);
							return;
						}
						read_worksheet(XLSX.read(data, read_type));
					}
					catch (e) {
						console.log(e);
						opts.errors.failed(e);
					}
				}
				
				if (e.target.result.length > 1e6) opts.errors.large(e.target.result.length, function (e) {
					if (e) read_workbook();
				});
				else {
					read_workbook();
				}
			};
			if (rABS)
				reader.readAsBinaryString(f);
			else
				reader.readAsArrayBuffer(f);
		}
	}
	
	if (opts.file && opts.file.addEventListener) opts.file.addEventListener('change', handle_file, false);
};
