var asset_array = {};
var map;            // google-map

// Date
var DPV = {     // date-picker-variable
	BD: null,   // business day
	GD: null,   // general-day
	OT:null     // overtime
};
DPV.BD = {
	format: 'yyyy-mm-dd',
	clearBtn:true,
	autoclose: true,
	todayHighlight: true,
	weekStart: 1,
	beforeShowDay: function (dt) {
		// datepicker business-day
		var wd = true,
		    tt = '',
		    cc = '';
		if(dt.getDay() == 0 || dt.getDay() == 6) {
			wd = false;
			tt = 'WeekEnd';
			cc = 'weekendI disabled';
		}
		return  { enabled:wd, classes:cc, tooltip:tt };
	}
};
DPV.GD = {
	format: 'yyyy-mm-dd',
	clearBtn:true,
	autoclose: true,
	todayHighlight: true,
	weekStart: 1,
	beforeShowDay: function(dt) {
		var cc = '';
		if(dt.getDay() == 0 || dt.getDay() == 6)
			cc = 'weekendI';
		return  { enabled:true, classes:cc, tooltip:'WeekEnd' };
	}
};

Date.prototype.addDays = function(days) {
	var dat = new Date(this.valueOf());
	dat.setDate(dat.getDate() + days);
	return dat;
};

function dp_CD_OT(dt) {
	// datepicker current overtime
	var y = dt.getFullYear(),
		m = dt.getMonth()+1,
		d = dt.getDate(),
		n = new Date();
	n.setHours(0,0,0,0);

	m = m < 10 ? '0'+m : m;
	d = d < 10 ? '0'+d : d;
	var wot = y + "-" +m + "-" + d;
	if(dt.valueOf() == n.valueOf())
		return jQuery.inArray(wot, DPV.OT)!=-1 ? true : false;
	else
		return false;
}
function dp_BD_OT(dt) {
	// datepicker business-day overtime
	var ot = dp_CD_OT(dt),
		wd = true,
		tt = '',
		cc = '';
	if(dt.getDay() == 0 || dt.getDay() == 6) {
		if(ot) {
			tt = 'Over-Time';
			cc = 'overtime';
		}
		else {
			wd = false;
			tt = 'WeekEnd';
			cc = 'weekendB disabled';
		}
	}
	return  { enabled:wd, classes:cc, tooltip:tt };
}
function is_date(date) {
	var status = false;
	if (date && date.length == 10)
		status = new Date(date) == 'Invalid Date' ? false : true;
	return status;
}
function add_NWD(d, n) {
	if(d) {
		d = new Date(d);
		var i = 1,
			t = 0;
		if(n > 0)
			while (i < n) {
				d.setDate(d.getDate() + 1);
				t = d.getDay();
				if (t && t != 6)
					i++;
			}
		else {
			i = -1;
			while (n < i) {
				d.setDate(d.getDate() - 1);
				t = d.getDay();
				if (t && t != 6)
					n++;
			}
		}
		d = (new Date(d)).toISOString();
		d = d.substr(0, 10);
	}
	else d = '';
	return d;
}
function add_NCD(d, n) {
	var od = new Date(d);
	od.setDate(od.getDate() + n);
	return od;
}
function diff_WD(s, f) {
	var n = 1,
		t = 0;
	if(s && f) {
		s = new Date(s);
		f = new Date(f);
		if(s > f) {
			var x = f;
			f = s;
			s = x;
		}
		while (f > s) {
			f.setDate(f.getDate() - 1);
			t = f.getDay();
			if (t && t != 6)
				n++;
		}
	}
	return n;
}
function delta_WD(a, z) {
	a = new Date(a);
	z = new Date(z);
	if (z < a)
		return 0;

	var msec = 86400 * 1000;
	a.setHours(0,0,0,1);
	z.setHours(23,59,59,999);
	var diff = z - a;
	var days = Math.ceil(diff / msec);
	days = days - (Math.floor(days / 7) * 2);

	var aDay = a.getDay();
	var zDay = z.getDay();

	if (aDay - zDay > 1)
		days -= 2;

	if (aDay == 0 && zDay != 6)
		days -= 1

	if (zDay == 6 && aDay != 0)
		days -= 1

	return days;
}
function wd_calc(v) {
	v = parseFloat(v);
	var d = Math.floor(v),
		h = (v - d)*8,
		o = '';
	if(d && h)
		o = d + 'D ' + h + 'H';
	else {
		if(d)
			o = d + 'D';
		if(h)
			o = h + 'H';
	}
	return o;
}

function is_boolean(val) {
	if(val === undefined)
		return false;
	else
		switch(val.toLowerCase().trim()){
			case "true":  case "yes": case "1": return true;
			case "false": case "no":  case "0": case null: return false;
			default: return Boolean(val);
		}
}
String.prototype.capitalize = function(all) {
	return (all ? this.toLowerCase() : this).replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
};

function x_post(url, params) {
	var _window = window.open(url, 'x_post');
	if (!_window)
		return false;

	var html = "<html><head></head><body><form id='x_post' method='post' action='" + url + "'>";

	$.each(params, function(key, value) {
		if (value instanceof Array || value instanceof Object) {
			$.each(value, function(key1, value1) {
				html += "<input type='hidden' name='" + key + "["+key1+"]' value='" + value1 + "'/>";
			});
		}
		else{
			html += "<input type='hidden' name='" + key + "' value='" + value + "'/>";
		}
	});
	html += "</form><script type='text/javascript'>document.getElementById(\"x_post\").submit()</script></body></html>";
	_window.document.write(html);
	return _window;
}

function form_del(obj, exec) {
	$   = jQuery;
	// frm = $(frm);
	obj = $(obj);

	exec = exec==undefined ? true : false;
	if(exec) {
		App.startPageLoading();

		AGV.form.find('input[name=act]').val('del');
		if(obj && obj.attr('href') != '#')
			AGV.form.attr('action', obj.attr('href'));
		AGV.form.validate().settings.ignore = "*";
		AGV.form.submit();
	}
	else {
		obj.hide().next().show();
		$('#stack1').hide().next().show();
	}
}

// Format
function Rp(x) {
	x += '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x)) {
		x = x.replace(rgx, '$1' + ',' + '$2');
	}
	return x;
}
function Num(x) {
	var rgx = /(\d+)(\d{3})/;
	x += '';
	while (rgx.test(x)) {
		x = x.replace(rgx, '$1' + ',' + '$2');
	}
	return x;
}

// Sum Column
function sum_col(cls, type) {
	if(type == 'undefined')
		type = 'td';

	var t = 0;
	if(type == 'td') {
		jQuery('td.' + cls).each(function() {
			var o = jQuery(this),
				v = o.html();
			if(v && jQuery.isNumeric(v))
				t = t + parseFloat(v);
		});
	}
	else {
		jQuery('input.' + cls).each(function() {
			var o = jQuery(this),
				v = o.val();
			if(v && jQuery.isNumeric(v))
				t = t + parseFloat(v);
		});
	}
	return t;
}

function br2nl(str) {
	return str.replace(/<br\s*\/?>/ig,"\r");
}
function cycleImages() {
	var $active = $('#imgsLoop .active'),
	    $next	= ($active.next().length > 0) ? $active.next() : $('#imgsLoop div:first');

	$next.css('z-index', 2);
	$active.fadeOut(1500, function() {
		$active.css('z-index', 1).show().removeClass('active');
		$next.css('z-index', 3).addClass('active');
	});
}

/*
 $.validator.addMethod("unique", function(value, element) {
 return  $(element).data('rule--unique') == 'true';
 }, 'I Need Unique Value');
 */

function load_asset(file_asset, callback) {
	var type = 'js';
	if (file_asset.toLowerCase().indexOf(".css") > 0)
		type = 'css';
	
	if (!asset_array[file_asset]) {
		if (debug_state)
			root.root.console.log('load ' + file_asset, debug_style__green);
		
		if (type == 'css') {
			$('<link>').appendTo('head').attr({
				rel: 'stylesheet',
				type: 'text/css',
				href: file_asset
			});
			asset_array[file_asset] = file_asset;
			if(typeof callback === 'function')
				callback();
		}
		else {
			var promise = jQuery.Deferred();
			
			// adding the script tag to the head as suggested before
			var body = document.getElementsByTagName('body')[0],
				script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = file_asset;
			
			// then bind the event to the callback function
			// there are several events for cross browser compatibility
			script.onload = function() {
				promise.resolve();
			};
			
			// fire the loading
			body.appendChild(script);
			
			// clear DOM reference
			//body = null;
			//script = null;
			
			asset_array[file_asset] = promise.promise();
			asset_array[file_asset].then(function () {
				if(typeof callback === 'function')
					callback();
			});
		}
	}
	else if (debug_state)
		root.root.console.log("This script was already loaded %c: " + file_asset, debug_style__warning);
}
