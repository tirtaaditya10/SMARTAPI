/* oss.sheetjs.com (C) 2014-present SheetJS -- http://sheetjs.com */
/* vim: set ts=2: */

/** drop target **/
var _target = document.getElementById('drop');
var _file = document.getElementById('file');
var _grid = document.getElementById('grid');

/** Spinner **/
var spinner;

var _worker_start = function () {
	spinner = new Spinner().spin(_target);
}
var _worker_end = function () {
	spinner.stop();
}

/** Alerts **/
var _badfile = function () {
	alertify.alert('This file does not appear to be a valid Excel file.', function () {
	});
};

var _pending = function () {
	alertify.alert('Please wait until the current file is processed.', function () {
	});
};

var _large = function (len, cb) {
	alertify.confirm("This file is " + len + " bytes and may take a few moments.  Your browser may lock up during this process.  Shall we play?", cb);
};

var _failed = function (e) {
	console.log(e, e.stack);
	alertify.alert('We unfortunately dropped the ball here.  Please test the file using the <a href="/js-xlsx/">raw parser</a>.  If there are issues with the file processor, please send this file to <a href="mailto:dev@sheetjs.com?subject=I+broke+your+stuff">dev@sheetjs.com</a> so we can make things right.', function () {
	});
};


var cdg = canvasDatagrid({
	parentNode: _grid
});
cdg.style.height = '100%';
cdg.style.width = '100%';

function _resize() {
	_grid.style.height = (window.innerHeight - 200) + "px";
	_grid.style.width = (window.innerWidth - 200) + "px";
}

window.addEventListener('resize', _resize);

var _onsheet = function (json, sheetnames, call_back) {
	document.getElementById('footnote').style.display = "none";
	
	/* show grid */
	_grid.style.display = "block";
	_resize();
	
	/* set up table headers */
	var L = 0;
	json.forEach(function (r) {
		if (L < r.length) L = r.length;
	});
	console.log(L);
	for (var i = json[0].length; i < L; ++i) {
		json[0][i] = "";
	}
	
	/* load data */
	cdg.data = json;
};

/** Drop it like it's hot **/
sheet_drop({
	file: _file,
	drop: _target,
	on: {
		workstart: _worker_start,
		workend: _worker_end,
		sheet: _onsheet,
		foo: 'bar'
	},
	errors: {
		badfile: _badfile,
		pending: _pending,
		failed: _failed,
		large: _large,
		foo: 'bar'
	}
})
