<!DOCTYPE html>
<html>
<head><meta http-equiv="Expires" content="0">
  <meta http-equiv="Last-Modified" content="0">
  <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
  <meta http-equiv="Pragma" content="no-cache">
	<link rel="stylesheet" type="text/css" href="estilos.css" />
	<link rel="icon" href="logo1.png">
	<title>Boletos</title>
    
</head>
<body>
  
    <nav class="hea">
    <div class="logo1"><img src="img/logo.png"width="350" height="120"></div>
    </nav>
    <header> 
     <div class="list-container">
	 
        <ul class="lists">
		<div class="logo2"><img src="img/logo2.png"width="350" height="120"></div>
            <li><a href="index.php" >Inicio</a></li>
            <li><a href="aviones.php">Aviones</a></li>
            <li><a href="boleto.php">Boleto</a></li>

        </ul>
     </div>
    </header>
<div class="sep"></div>

<script src="https://cdn03.jotfor.ms/static/prototype.forms.js" type="text/javascript"></script>
<script src="https://cdn01.jotfor.ms/static/jotform.forms.js?3.3.28886" type="text/javascript"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/punycode/1.4.1/punycode.js"></script>
<script src="https://cdn02.jotfor.ms/js/payments/paypalcomplete.js?v=3.3.28886" type="text/javascript"></script>
<script src="https://cdn03.jotfor.ms/js/payments/paymentUtils.js?v=3.3.28886" type="text/javascript"></script>
<script src="https://cdn01.jotfor.ms/js/libraries/promise-polyfill.js"></script>
<script src="https://cdn02.jotfor.ms/js/payments/payment_form_embedded.js?v=3.3.28886" type="text/javascript"></script>
<script src="https://js.jotform.com/vendor/postMessage.js?3.3.28886" type="text/javascript"></script>
<script src="https://js.jotform.com/WidgetsServer.js?v=1636167831612" type="text/javascript"></script>
<script src="https://cdn03.jotfor.ms//common/timezonePicker.js" type="text/javascript"></script>
<script type="text/javascript">	JotForm.newDefaultTheme = false;
	JotForm.extendsNewTheme = false;
	JotForm.newPaymentUIForNewCreatedForms = false;
	JotForm.clearFieldOnHide="disable";
	JotForm.submitError="jumpToFirstError";

	JotForm.init(function(){
	/*INIT-START*/
      setTimeout(function() {
          $('input_38').hint('ej: 23');
       }, 20);

    JotForm.calendarMonths = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
    JotForm.calendarDays = ["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"];
    JotForm.calendarOther = "Today";

    JotForm.checkAppointmentAvailability = function checkAppointmentAvailability(day, slot, data) {
	  if (!(day && slot && data && data[day])) return false;
	  return data[day][slot];
	};

    (function init(props) {
	  var PREFIX = window.location.href.indexOf('jotform.pro') > -1 || window.location.pathname.indexOf('build') > -1 || window.location.pathname.indexOf('form-templates') > -1 || window.location.pathname.indexOf('pdf-templates') > -1 || window.location.pathname.indexOf('table-templates') > -1 || window.location.pathname.indexOf('approval-templates') > -1 ? '/server.php' : JotForm.server;

	  // boilerplate
	  var effectsOut = null;
	  var changed = {};
	  var constructed = false;
	  var _window = window,
	      document = _window.document;

	  var wrapper = document.querySelector('#' + props.qid.value);
	  var uniqueId = props.qid.value;
	  var element = wrapper.querySelector('.appointmentField');
	  var input = wrapper.querySelector('#input_' + props.id.value + '_date');
	  var tzInput = wrapper.querySelector('#input_' + props.id.value + '_timezone');
	  var timezonePickerCommon = void 0;
	  var isTimezonePickerFromCommonLoaded = false;

	  function debounce(func, wait, immediate) {
	    var timeout = void 0;
	    return function wrappedFN() {
	      for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
	        args[_key] = arguments[_key];
	      }

	      var context = this;
	      var later = function later() {
	        timeout = null;
	        if (!immediate) func.apply.apply(func, [context].concat(args));
	      };
	      var callNow = immediate && !timeout;
	      clearTimeout(timeout);
	      timeout = setTimeout(later, wait);
	      if (callNow) func.apply.apply(func, [context].concat(args));
	    };
	  }

	  var classNames = function classNames(obj) {
	    return Object.keys(obj).reduce(function (acc, key) {
	      if (!obj[key]) return acc;
	      return [].concat(acc, [key]);
	    }, []).join(' ');
	  };

	  var assignObject = function assignObject() {
	    for (var _len2 = arguments.length, objects = Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
	      objects[_key2] = arguments[_key2];
	    }

	    return objects.reduce(function (acc, obj) {
	      Object.keys(obj).forEach(function (key) {
	        acc[key] = obj[key];
	      });

	      return acc;
	    }, {});
	  };

	  var objectEntries = function objectEntries(obj) {
	    return Object.keys(obj).reduce(function (acc, key) {
	      var value = obj[key];
	      var pair = [key, value];
	      return [].concat(acc, [pair]);
	    }, []);
	  };

	  var fillArray = function fillArray(arr, value) {
	    var newArr = [];
	    for (var i = 0; i < arr.length; i++) {
	      newArr.push(value);
	    }
	    return newArr;
	  };

	  var getJSON = function getJSON(url, cb) {
	    return new Ajax.Request(url, {
	      evalJSON: 'force',
	      method: 'GET',
	      onComplete: function onComplete(response) {
	        return cb(response.responseJSON);
	      }
	    });
	  };

	  var beforeRender = function beforeRender() {
	    if (effectsOut) {
	      effectsOut();
	      effectsOut = null;
	    }
	  };

	  var afterRender = function afterRender() {
	    effectsOut = effects();
	  };

	  var setState = function setState(newState) {
	    var changedKeys = Object.keys(newState).filter(function (key) {
	      return state[key] !== newState[key];
	    });

	    if (!changedKeys.length) {
	      return;
	    }

	    changed = changedKeys.reduce(function (acc, key) {
	      var _assignObject;

	      return assignObject({}, acc, (_assignObject = {}, _assignObject[key] = state[key], _assignObject));
	    }, changed);

	    state = assignObject({}, state, newState);
	    if (constructed) {
	      render();
	    }
	  };

	  var isStartWeekOnMonday = function isStartWeekOnMonday() {
	    var _props = props,
	        startDay = _props.startWeekOn.value;

	    return !startDay || startDay === 'Monday';
	  };

	  var monthNames = function monthNames() {
	    return (JotForm.calendarMonthsTranslated || JotForm.calendarMonths || _Utils.specialOptions.Months.value).map(function (monthName) {
	      return String.prototype.locale ? monthName.locale() : monthName;
	    });
	  };
	  var daysOfWeek = function daysOfWeek() {
	    return (JotForm.calendarDaysTranslated || JotForm.calendarDays || _Utils.specialOptions.Days.value).map(function (dayName) {
	      return String.prototype.locale ? dayName.locale() : dayName;
	    });
	  };
	  // we need remove unnecessary "Sunday", if there is time field on the form
	  var dayNames = function dayNames() {
	    var days = daysOfWeek().length === 8 ? daysOfWeek().slice(1) : daysOfWeek();
	    return isStartWeekOnMonday() ? days : [days[days.length - 1]].concat(days.slice(0, 6));
	  };

	  var oneHour = 1000 * 60 * 60;
	  // const oneDay = oneHour * 24;

	  var intPrefix = function intPrefix(d) {
	    if (d < 10) {
	      return '0' + d;
	    }

	    return '' + d;
	  };

	  var toFormattedDateStr = function toFormattedDateStr(date) {
	    var _props2 = props,
	        _props2$dateFormat$va = _props2.dateFormat.value,
	        format = _props2$dateFormat$va === undefined ? 'yyyy-mm-dd' : _props2$dateFormat$va;

	    if (!date) return;
	    if (typeof date === 'string') {
	      var _date$split = date.split('-'),
	          _year = _date$split[0],
	          _month = _date$split[1],
	          _day = _date$split[2];

	      return format.replace(/yyyy/, _year).replace(/mm/, _month).replace(/dd/, _day);
	    }

	    var year = date.getFullYear();
	    var month = intPrefix(date.getMonth() + 1);
	    var day = intPrefix(date.getUTCDate());
	    return format.replace(/yyyy/, year).replace(/mm/, month).replace(/dd/, day);
	  };

	  var toDateStr = function toDateStr(date) {
	    if (!date) return;
	    var year = date.getFullYear();
	    var month = intPrefix(date.getMonth() + 1);
	    var day = intPrefix(date.getDate());

	    return year + '-' + month + '-' + day;
	  };

	  var toDateTimeStr = function toDateTimeStr(date) {
	    if (!date) return;
	    var ymd = toDateStr(date);
	    var hour = intPrefix(date.getHours());
	    var minute = intPrefix(date.getMinutes());
	    return ymd + ' ' + hour + ':' + minute;
	  };

	  var getTimezoneOffset = function getTimezoneOffset(timezone) {
	    if (!timezone) {
	      return 0;
	    }
	    var cityArgs = timezone.split(' ');
	    var splitted = cityArgs[cityArgs.length - 1].replace(/\(GMT|\)/g, '').split(':');

	    if (!splitted) {
	      return 0;
	    }

	    return parseInt(splitted[0] || 0, 10) + (parseInt(splitted[1] || 0, 10) / 60 || 0);
	  };

	  var getGMTSuffix = function getGMTSuffix(offset) {
	    if (offset === 0) {
	      return '';
	    }

	    var offsetMinutes = Math.abs(offset) % 60;
	    var offsetHours = Math.abs(offset - offsetMinutes) / 60;

	    var str = intPrefix(offsetHours) + ':' + intPrefix(offsetMinutes);

	    if (offset < 0) {
	      return '+' + str;
	    }

	    return '-' + str;
	  };

	  // const toJSDate = (dateStr, timezone) => {
	  //   if (!dateStr) return;

	  //   const gmtSuffix = getGMTSuffix(timezone || state.timezone);

	  //   return new Date(`${dateStr} GMT${gmtSuffix}`);
	  // };

	  var getYearMonth = function getYearMonth(date) {
	    if (!date) return;

	    var _date$split2 = date.split('-'),
	        y = _date$split2[0],
	        m = _date$split2[1];

	    return y + '-' + m;
	  };

	  var getMondayBasedDay = function getMondayBasedDay(date) {
	    var day = date.getUTCDay();
	    if (day === 0) {
	      return 6; // sunday index
	    }
	    return day - 1;
	  };

	  var getDay = function getDay(date) {
	    return isStartWeekOnMonday() ? getMondayBasedDay(date) : date.getUTCDay();
	  };

	  var getUserTimezone = function getUserTimezone() {
	    var _props3 = props,
	        _props3$autoDetectTim = _props3.autoDetectTimezone;
	    _props3$autoDetectTim = _props3$autoDetectTim === undefined ? {} : _props3$autoDetectTim;
	    var autoDetectValue = _props3$autoDetectTim.value,
	        _props3$timezone = _props3.timezone;
	    _props3$timezone = _props3$timezone === undefined ? {} : _props3$timezone;
	    var timezoneAtProps = _props3$timezone.value;

	    if (autoDetectValue === 'No') {
	      return timezoneAtProps;
	    }

	    try {
	      var tzStr = Intl.DateTimeFormat().resolvedOptions().timeZone;
	      if (tzStr) {
	        var tz = tzStr + ' (GMT' + getGMTSuffix(new Date().getTimezoneOffset()) + ')';
	        return tz;
	      }
	    } catch (e) {
	      console.error(e.message);
	    }

	    return props.timezone.value;
	  };

	  var passedProps = props;

	  var getStateFromProps = function getStateFromProps() {
	    var newProps = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

	    var startDate = new Date(newProps.startDate ? newProps.startDate.value : '');
	    var today = new Date();
	    var date = toDateStr(new Date(Math.max(startDate, today) || today));

	    return {
	      date: date,
	      timezones: state ? state.timezones : { loading: true }
	    };
	  };

	  var getFirstAvailableDates = function getFirstAvailableDates(cb) {
	    var _props4 = props,
	        _props4$formID = _props4.formID,
	        formID = _props4$formID === undefined ? global.__formInfo.id : _props4$formID;
	    var _state = state,
	        _state$timezone = _state.timezone,
	        timezone = _state$timezone === undefined ? getUserTimezone() : _state$timezone;


	    if (!formID || !timezone) return;

	    // eslint-disable-next-line max-len
	    var url = PREFIX + '?action=getAppointments&formID=' + formID + '&timezone=' + encodeURIComponent(timezone) + '&ncTz=' + new Date().getTime() + '&firstAvailableDates';

	    return getJSON(url, function (_ref) {
	      var content = _ref.content;
	      return cb(content);
	    });
	  };

	  var state = getStateFromProps(props);

	  var loadTimezones = function loadTimezones(cb) {
	    setState({
	      timezones: { loading: true }
	    });

	    getJSON((props.cdnconfig.CDN || '/') + 'assets/form/timezones.json?ncTz=' + new Date().getTime(), function (data) {
	      var timezones = objectEntries(data).reduce(function (acc, _ref2) {
	        var group = _ref2[0],
	            cities = _ref2[1];

	        acc.push({
	          group: group,
	          cities: cities
	        });
	        return acc;
	      }, []);

	      cb(timezones);
	    });
	  };

	  var loadMonthData = function loadMonthData(startDate, endDate, cb) {
	    var _props5 = props,
	        _props5$formID = _props5.formID,
	        formID = _props5$formID === undefined ? (typeof global === 'undefined' ? 'undefined' : _typeof(global)) === 'object' ? global.__formInfo.id : null : _props5$formID,
	        id = _props5.id.value;
	    var _state2 = state,
	        timezone = _state2.timezone;


	    if (!formID || !timezone) return;

	    // eslint-disable-next-line max-len
	    var url = PREFIX + '?action=getAppointments&formID=' + formID + '&qid=' + id + '&timezone=' + encodeURIComponent(timezone) + '&startDate=' + toDateStr(startDate) + '&endDate=' + toDateStr(endDate) + '&ncTz=' + new Date().getTime();

	    return getJSON(url, function (_ref3) {
	      var data = _ref3.content;
	      return cb(data);
	    });
	  };

	  var generateMonthData = function generateMonthData(startDate, endDate, data) {
	    var d1 = startDate.getDate();
	    var d2 = endDate.getDate();
	    var dPrefix = startDate.getFullYear() + '-' + intPrefix(startDate.getMonth() + 1) + '-';

	    var daysLength = d2 - d1 + 1 || 0;
	    var days = fillArray(new Array(daysLength), '');

	    var slots = days.reduce(function (acc, x, day) {
	      var _assignObject2;

	      var dayStr = '' + dPrefix + intPrefix(day + 1);
	      return assignObject(acc, (_assignObject2 = {}, _assignObject2[dayStr] = data[dayStr] || false, _assignObject2));
	    }, {});

	    var availableDays = Object.keys(data).filter(function (d) {
	      return !Array.isArray(slots[d]) && !!slots[d];
	    });

	    return {
	      availableDays: availableDays,
	      slots: slots
	    };
	  };

	  var lastReq = void 0;

	  var updateMonthData = function updateMonthData(startDate, endDate, data) {
	    var _generateMonthData = generateMonthData(startDate, endDate, data),
	        availableDays = _generateMonthData.availableDays,
	        slots = _generateMonthData.slots;

	    if (JSON.stringify(slots) === JSON.stringify(state.slots)) {
	      return;
	    }

	    setState({
	      availableDays: availableDays,
	      slots: slots
	    });
	  };

	  var getDateRange = function getDateRange(dateStr) {
	    var _dateStr$split = dateStr.split('-'),
	        y = _dateStr$split[0],
	        m = _dateStr$split[1];

	    var startDate = new Date(y, m - 1, 1);
	    var endDate = new Date(y, m, 0);
	    return [startDate, endDate];
	  };

	  var load = function load() {
	    var _state3 = state,
	        dateStr = _state3.date;

	    var _getDateRange = getDateRange(dateStr),
	        startDate = _getDateRange[0],
	        endDate = _getDateRange[1];

	    setState(assignObject({ loading: true }, generateMonthData(startDate, endDate, {})));

	    var req = loadMonthData(startDate, endDate, function (data) {
	      if (lastReq !== req) {
	        return;
	      }

	      updateMonthData(startDate, endDate, data);
	      var _state4 = state,
	          availableDays = _state4.availableDays,
	          forcedStartDate = _state4.forcedStartDate,
	          forcedEndDate = _state4.forcedEndDate,
	          slots = _state4.slots;


	      var firstAvailable = availableDays.find(function (d) {
	        var foundSlot = Object.keys(slots[d]).find(function (slot) {
	          var slotDate = dateInTimeZone(new Date((d + ' ' + slot).replace(/-/g, '/')));

	          if (forcedStartDate && slotDate > forcedStartDate) return false;
	          if (forcedEndDate && slotDate < forcedEndDate) return false;

	          return true;
	        });

	        return foundSlot;
	      });

	      var newDate = availableDays.indexOf(dateStr) === -1 && firstAvailable;

	      setState({
	        loading: false,
	        date: newDate || dateStr
	      });
	    });

	    lastReq = req;
	  };

	  var dateInTimeZone = function dateInTimeZone(date) {
	    var timezone = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : state.timezone;

	    if (!date) return;
	    var diffTime = (getTimezoneOffset(timezone) - state.nyTz) * oneHour;
	    return new Date(date.getTime() - diffTime);
	  };

	  var dz = function dz(date, tz1, tz2) {
	    if (!date) return;
	    var diffTime = (tz1 - tz2) * oneHour;
	    return new Date(date.getTime() - diffTime);
	  };

	  var revertDate = function revertDate(d, t1, t2) {
	    if (!d) return '';

	    var pDate = new Date(d.replace(/-/, '/'));
	    var utz = getTimezoneOffset(getUserTimezone());
	    var tz1 = getTimezoneOffset(t1) - utz;
	    var tz2 = getTimezoneOffset(t2) - utz;

	    var val = dz(pDate, tz1, tz2);

	    return toDateTimeStr(val);
	  };

	  var amPmConverter = function amPmConverter(_time) {
	    var _props6 = props,
	        _props6$timeFormat = _props6.timeFormat;
	    _props6$timeFormat = _props6$timeFormat === undefined ? {} : _props6$timeFormat;
	    var _props6$timeFormat$va = _props6$timeFormat.value,
	        timeFormat = _props6$timeFormat$va === undefined ? '24 Hour' : _props6$timeFormat$va;

	    if (!_time || !(typeof _time === 'string') || _time.indexOf('M') > -1 || !timeFormat || timeFormat === '24 Hour') {
	      return _time;
	    }
	    var time = _time.substring(0, 2);
	    var hour = time % 12 || 12;
	    var ampm = time < 12 ? 'AM' : 'PM';
	    return '' + hour + _time.substring(2, 5) + ' ' + ampm;
	  };

	  var validate = function validate(dateStr, cb) {
	    var _state5 = state,
	        defaultValue = _state5.defaultValue;


	    if (JotForm.isEditMode() && defaultValue === dateStr) {
	      return cb(true);
	    }

	    var parts = dateStr.split(' ');
	    var slot = parts.slice(1).join(' ');

	    var _parts$0$split = parts[0].split('-'),
	        y = _parts$0$split[0],
	        m = _parts$0$split[1],
	        d = _parts$0$split[2];

	    var startDate = new Date(y, m - 1, 1);
	    var endDate = new Date(y, m, 0);

	    loadMonthData(startDate, endDate, function (data) {
	      var day = y + '-' + m + '-' + d;
	      var isValid = JotForm.checkAppointmentAvailability(day, amPmConverter(slot), data);
	      cb(isValid);
	      if (!isValid) {
	        var _assignObject3;

	        // add unavailable slot if it is not in response for deselection
	        data[day] = assignObject({}, data[day], (_assignObject3 = {}, _assignObject3[slot] = false, _assignObject3));
	      }

	      // still in same month
	      if (state.date.indexOf(y + '-' + m) === 0) {
	        updateMonthData(startDate, endDate, data);
	      }
	    });
	  };

	  // let validationInterval;

	  var validation = function validation(_value) {
	    var shouldValidate = _value || $(input).hasClassName('validate');

	    if (!shouldValidate) {
	      $(input).addClassName('valid');
	      JotForm.corrected(input);
	      JotForm.runConditionForId(props.id.value);
	      return;
	    }

	    if (!_value) {
	      $(input).removeClassName('valid');
	      JotForm.errored(input, JotForm.texts.required);
	      JotForm.runConditionForId(props.id.value);
	      return;
	    }

	    validate(_value, function (isValid) {
	      if (isValid) {
	        $(input).addClassName('valid');
	        JotForm.corrected(input);
	        JotForm.runConditionForId(props.id.value);
	        return;
	      }

	      // clearInterval(validationInterval);

	      var parts = _value.split(' ');
	      var dateStr = parts[0];

	      var date = new Date(dateStr);
	      var day = getDay(date);
	      var datetime = dayNames()[day] + ', ' + monthNames()[date.getMonth()] + ' ' + intPrefix(date.getUTCDate()) + ', ' + date.getFullYear();

	      var time = parts.slice(1).join(' ');
	      var errorText = JotForm.texts.slotUnavailable.replace('{time}', time).replace('{date}', datetime);

	      $(input).removeClassName('valid');
	      JotForm.errored(input, errorText);
	      JotForm.runConditionForId(props.id.value);
	    });
	  };

	  var setValue = function setValue(value) {
	    input.value = value ? toDateTimeStr(dateInTimeZone(new Date(value.replace(/-/g, '/')))) : '';

	    setState({
	      value: value
	    });

	    // trigger input event for supporting progress bar widget
	    input.triggerEvent('input');

	    // clearInterval(validationInterval);

	    validation(value);
	    // validationInterval = setInterval(() => { validation(state.value); }, 1000 * 5);
	  };

	  var handleClick = function handleClick(e) {
	    var target = e.target;

	    var $target = $(target);

	    if (!$target || !$target.hasClassName) {
	      return;
	    }

	    if ($target.hasClassName('disabled') && !$target.hasClassName('active')) {
	      return;
	    }

	    e.preventDefault();
	    var value = target.dataset.value;

	    setValue($target.hasClassName('active') ? undefined : value);
	  };

	  var setTimezone = function setTimezone(timezone) {
	    tzInput.value = timezone;
	    setState({ timezone: timezone });
	    if (input.value) {
	      var date = toDateTimeStr(dz(new Date(input.value.replace(/-/g, '/')), state.nyTz, getTimezoneOffset(state.timezone)));
	      setDate(date.split(' ')[0]);
	      setState({ value: date });
	    }
	  };

	  var handleTimezoneChange = function handleTimezoneChange(e) {
	    var target = e.target;
	    var timezone = target.value;

	    setTimezone(timezone);
	  };

	  var setDate = function setDate(date) {
	    return setState({ date: date });
	  };

	  var handleDateChange = function handleDateChange(e) {
	    var target = e.target;
	    var date = target.dataset.value;


	    if (!date) return;

	    setDate(date);
	  };

	  var handleMonthYearChange = function handleMonthYearChange(e) {
	    var _e$target = e.target,
	        dataset = _e$target.dataset,
	        inputVal = _e$target.value;
	    var name = dataset.name;

	    if (!name) {
	      return;
	    }

	    var _state6 = state,
	        date = _state6.date;

	    var oldDate = new Date(date);
	    var oldMonth = oldDate.getMonth();
	    var oldYear = oldDate.getFullYear();
	    var oldDay = oldDate.getUTCDate();

	    var value = inputVal || e.target.getAttribute('value');

	    if (name === 'month') {
	      var newDate = new Date(oldYear, value, oldDay);
	      var i = 1;
	      while ('' + newDate.getMonth() !== '' + value && i < 10) {
	        newDate = new Date(oldYear, value, oldDay - i);
	        i++;
	      }

	      return setDate(toDateStr(newDate));
	    }

	    return setDate(toDateStr(new Date(value, oldMonth, oldDay)));
	  };

	  var toggleMobileState = function toggleMobileState() {
	    var $wrapper = $(wrapper);
	    if ($wrapper.hasClassName('isOpenMobile')) {
	      $wrapper.removeClassName('isOpenMobile');
	    } else {
	      $wrapper.addClassName('isOpenMobile');
	    }
	  };

	  var keepSlotsScrollPosition = function keepSlotsScrollPosition() {
	    var visibleSlot = element.querySelector('.appointmentSlots.slots .slot.active, .appointmentSlots.slots .slot:not(.disabled)');

	    element.querySelector('.appointmentSlots.slots').scrollTop = visibleSlot ? visibleSlot.offsetTop : 0;
	  };

	  var setTimezonePickerState = function setTimezonePickerState() {
	    var _state7 = state,
	        timezone = _state7.timezone;
	    var _props7 = props,
	        _props7$autoDetectTim = _props7.autoDetectTimezone;
	    _props7$autoDetectTim = _props7$autoDetectTim === undefined ? {} : _props7$autoDetectTim;
	    var autoDetecTimezoneValue = _props7$autoDetectTim.value,
	        _props7$timezone = _props7.timezone;
	    _props7$timezone = _props7$timezone === undefined ? {} : _props7$timezone;
	    var timezoneValueProps = _props7$timezone.value;

	    if (autoDetecTimezoneValue === 'No') {
	      timezonePickerCommon.setSelectedTimezone(timezoneValueProps);
	    } else {
	      timezonePickerCommon.setSelectedTimezone(timezone);
	    }
	    timezonePickerCommon.setIsAutoSelectTimezoneOpen(autoDetecTimezoneValue);
	  };

	  var handleUIUpdate = function handleUIUpdate() {
	    try {
	      var breakpoints = {
	        450: 'isLarge',
	        225: 'isNormal',
	        175: 'shouldBreakIntoNewLine'
	      };

	      var offsetWidth = function () {
	        try {
	          var appointmentCalendarRow = element.querySelector('.appointmentFieldRow.forCalendar');
	          var appointmendCalendar = element.querySelector('.appointmentCalendar');
	          return appointmentCalendarRow.getBoundingClientRect().width - appointmendCalendar.getBoundingClientRect().width;
	        } catch (e) {
	          return null;
	        }
	      }();

	      if (offsetWidth === null || parseInt(wrapper.readAttribute('data-breakpoint-offset'), 10) === offsetWidth) {
	        return;
	      }

	      var breakpoint = Object.keys(breakpoints).reduce(function (prev, curr) {
	        return Math.abs(curr - offsetWidth) < Math.abs(prev - offsetWidth) ? curr : prev;
	      });
	      var breakpointName = breakpoints[breakpoint];

	      wrapper.setAttribute('data-breakpoint', breakpointName);
	      wrapper.setAttribute('data-breakpoint-offset', offsetWidth);
	    } catch (e) {
	      // noop.
	    }
	  };

	  var uiUpdateInterval = void 0;

	  var effects = function effects() {
	    clearInterval(uiUpdateInterval);

	    var shouldLoad = changed.timezone && changed.timezone !== state.timezone || // time zone changed
	    changed.date && getYearMonth(changed.date) !== getYearMonth(state.date); // y-m changed

	    changed = {};

	    if (shouldLoad) {
	      load();
	    }

	    var cancelBtn = element.querySelector('.cancel');

	    if (cancelBtn) {
	      cancelBtn.addEventListener('click', function () {
	        setValue(undefined);
	      });
	    }

	    var forSelectedDate = element.querySelector('.forSelectedDate span');

	    if (forSelectedDate) {
	      forSelectedDate.addEventListener('click', function () {
	        setDate(state.value.split(' ')[0]);
	      });
	    }

	    if (isTimezonePickerFromCommonLoaded) {
	      setTimezonePickerState();
	      var timezonePickerWrapper = element.querySelector('.forTimezonePicker');
	      timezonePickerCommon.init(timezonePickerWrapper);
	    } else {
	      element.querySelector('.timezonePicker').addEventListener('change', handleTimezoneChange);
	    }

	    element.querySelector('.calendar .days').addEventListener('click', handleDateChange);
	    element.querySelector('.monthYearPicker').addEventListener('change', handleMonthYearChange);
	    element.querySelector('.dayPicker').addEventListener('click', handleDateChange);
	    element.querySelector('.selectedDate').addEventListener('click', toggleMobileState);

	    Array.prototype.slice.call(element.querySelectorAll('.monthYearPicker .pickerArrow')).forEach(function (el) {
	      return el.addEventListener('click', handleMonthYearChange);
	    });
	    Array.prototype.slice.call(element.querySelectorAll('.slot')).forEach(function (el) {
	      return el.addEventListener('click', handleClick);
	    });

	    keepSlotsScrollPosition();
	    uiUpdateInterval = setInterval(handleUIUpdate, 250);

	    JotForm.runAllCalculations();
	  };

	  var onTimezoneOptionClick = function onTimezoneOptionClick(timezoneValue) {
	    setTimezone(timezoneValue);
	  };

	  var renderMonthYearPicker = function renderMonthYearPicker() {
	    var _state8 = state,
	        date = _state8.date;

	    var _split = (date || '-').split('-'),
	        year = _split[0],
	        month = _split[1];

	    var yearOpts = fillArray(new Array(20), '').map(function (v, i) {
	      return '' + (2020 + i);
	    });

	    var prevMonthButtonText = props.prevMonthButtonText && props.prevMonthButtonText.text || 'Previous month';
	    var nextMonthButtonText = props.nextMonthButtonText && props.nextMonthButtonText.text || 'Next month';
	    var prevYearButtonText = props.prevYearButtonText && props.prevYearButtonText.text || 'Previous year';
	    var nextYearButtonText = props.nextYearButtonText && props.nextYearButtonText.text || 'Next year';

	    return '\n      <div class=\'monthYearPicker\'>\n        <div class=\'pickerItem\'>\n          <select class=\'pickerMonth\' data-name=\'month\'>\n            ' + monthNames().map(function (monthName, i) {
	      return '<option ' + (parseInt(month, 10) === i + 1 ? 'selected' : '') + ' value=\'' + i + '\'>' + monthName + '</option>';
	    }).join('') + '\n          </select>\n          <button type=\'button\' class=\'pickerArrow pickerMonthArrow prev\' value=\'' + (parseInt(month, 10) - 2) + '\' data-name=\'month\' aria-label="' + prevMonthButtonText + '"></button>\n          <button type=\'button\' class=\'pickerArrow pickerMonthArrow next\' value=\'' + parseInt(month, 10) + '\' data-name=\'month\' aria-label="' + nextMonthButtonText + '"></button>\n        </div>\n        <div class=\'pickerItem\'>\n          <select class=\'pickerYear\' data-name=\'year\'>\n            ' + yearOpts.map(function (yearName) {
	      return '<option ' + (year === yearName ? 'selected' : '') + '>' + yearName + '</option>';
	    }).join('') + '\n          </select>\n          <button type=\'button\' class=\'pickerArrow pickerYearArrow prev\' value=\'' + (parseInt(year, 10) - 1) + '\' data-name=\'year\' aria-label="' + prevYearButtonText + '"/>\n          <button type=\'button\' class=\'pickerArrow pickerYearArrow next\' value=\'' + (parseInt(year, 10) + 1) + '\' data-name=\'year\' aria-label="' + nextYearButtonText + '"/>\n        </div>\n      </div>\n    ';
	  };

	  var getNav = function getNav() {
	    var _state9 = state,
	        availableDays = _state9.availableDays,
	        dateStr = _state9.date;


	    var next = void 0;
	    var prev = void 0;

	    var _dateStr$split2 = dateStr.split('-'),
	        year = _dateStr$split2[0],
	        month = _dateStr$split2[1];

	    if (availableDays) {
	      var dayIndex = availableDays.indexOf(dateStr);
	      if (dayIndex > 0) {
	        prev = availableDays[dayIndex - 1];
	      } else {
	        var prevDate = new Date(year, month - 1, 0);
	        prev = toDateStr(prevDate);
	      }
	      if (dayIndex + 1 < availableDays.length) {
	        next = availableDays[dayIndex + 1];
	      } else {
	        var nextDate = new Date(year, month, 1);
	        next = toDateStr(nextDate);
	      }
	    }

	    return { prev: prev, next: next };
	  };

	  var renderDayPicker = function renderDayPicker() {
	    var _state10 = state,
	        loading = _state10.loading;

	    var _getNav = getNav(),
	        prev = _getNav.prev,
	        next = _getNav.next;

	    var prevDayButtonText = props.prevDayButtonText && props.prevDayButtonText.text || 'Previous day';
	    var nextDayButtonText = props.nextDayButtonText && props.nextDayButtonText.text || 'Next day';

	    return '\n      <div class=\'appointmentDayPicker dayPicker\'>\n        <button type=\'button\' ' + (loading || !prev ? 'disabled' : '') + ' class="appointmentDayPickerButton prev" ' + (prev && 'data-value="' + prev + '"') + ' aria-label="' + prevDayButtonText + '">&lt;</button>\n        <button type=\'button\' ' + (loading || !next ? 'disabled' : '') + ' class="appointmentDayPickerButton next" ' + (next && 'data-value="' + next + '"') + ' aria-label="' + nextDayButtonText + '">&gt;</button>\n      </div>\n    ';
	  };

	  var renderTimezonePicker = function renderTimezonePicker() {
	    var _state11 = state,
	        timezone = _state11.timezone,
	        timezones = _state11.timezones;


	    return '\n      <div class=\'timezonePickerWrapper\'> \n        <select class=\'timezonePicker\'>\n          ' + (!timezones.loading && timezones.map(function (_ref4) {
	      var group = _ref4.group,
	          cities = _ref4.cities;
	      return '\n                <optgroup label="' + group + '">\n                  ' + cities.map(function (val) {
	        return '<option ' + (timezone.indexOf((group + '/' + val).split(' ')[0]) > -1 ? 'selected' : '') + ' value=\'' + group + '/' + val + '\'>' + val + '</option>';
	      }).join('') + '\n                </optgroup>\n              ';
	    }).join('')) + '\n        </select>\n        <div class=\'timezonePickerName\'>' + timezone + '</div>\n      </div>\n    ';
	  };

	  var renderCalendarDays = function renderCalendarDays() {
	    var _state12 = state,
	        slots = _state12.slots,
	        dateStr = _state12.date,
	        value = _state12.value,
	        availableDays = _state12.availableDays;

	    var days = slots ? Object.keys(slots) : [];
	    var todayStr = toDateStr(new Date());

	    if (!days.length) {
	      return '';
	    }

	    var firstDay = getDay(new Date(days[0]));
	    days.unshift.apply(days, fillArray(new Array(firstDay), 'precedingDay'));

	    var trailingDays = Math.ceil(days.length / 7) * 7 - days.length;
	    days.push.apply(days, fillArray(new Array(trailingDays), 'trailingDay'));

	    var weeks = days.map(function (item, i) {
	      return i % 7 === 0 ? days.slice(i, i + 7) : null;
	    }).filter(function (a) {
	      return a;
	    });

	    var dateValue = value && value.split(' ')[0];

	    return '\n      ' + weeks.map(function (week) {
	      return '<div class=\'calendarWeek\'>' + week.map(function (day) {
	        var dayObj = new Date(day);
	        if (day === 'precedingDay' || day === 'trailingDay') {
	          return '<div class="calendarDay ' + day + ' empty"></div>';
	        }
	        var active = day === dateStr;
	        var isToday = todayStr === day;
	        var beforeStartDate = state.forcedStartDate ? state.forcedStartDate > dayObj : false;
	        var afterEndDate = state.forcedEndDate ? state.forcedEndDate < dayObj : false;
	        var isUnavailable = availableDays.indexOf(day) === -1 || beforeStartDate || afterEndDate;
	        var isSelected = day === dateValue;
	        var classes = 'calendarDay ' + classNames({
	          isSelected: isSelected,
	          isToday: isToday,
	          isUnavailable: isUnavailable,
	          isActive: active
	        });
	        return '<div \n                      class=\'' + classes + '\' \n                      data-value=\'' + day + '\'\n                      role="button"\n                      aria-disabled="' + (isUnavailable ? true : false) + '"  \n                    >\n                        <span class=\'calendarDayEach\'>' + day.split('-')[2].replace(/^0/, '') + '</span>\n                    </div>';
	      }).join('') + '</div>';
	    }).join('') + '\n    ';
	  };

	  var renderEmptyState = function renderEmptyState() {
	    /* eslint-disable */
	    return '\n      <div class="appointmentSlots-empty">\n        <div class="appointmentSlots-empty-container">\n          <div class="appointmentSlots-empty-icon">\n            <svg width="124" height="102" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">\n              <defs>\n                <path d="M55 32.001c0 21.54 17.46 39 39 39 3.457 0 6.81-.45 10-1.294v34.794H0v-104l71 .001c-9.7 7.095-16 18.561-16 31.5z" id="a"/>\n              </defs>\n              <g fill="none" fill-rule="evenodd">\n                <g transform="translate(-1 -1)">\n                  <mask id="b" fill="#fff">\n                    <use xlink:href="#a"/>\n                  </mask>\n                  <g mask="url(#b)">\n                    <path d="M18.85 52.001c9.858 0 17.85 7.992 17.85 17.85 0 9.859-7.992 17.85-17.85 17.85S1 79.71 1 69.851c0-9.858 7.992-17.85 17.85-17.85zm5.666 10.842L17.38 69.98l-2.44-2.44a2.192 2.192 0 00-3.1 3.1l3.99 3.987a2.192 2.192 0 003.098 0l8.687-8.686a2.191 2.191 0 00-3.1-3.099z" fill="#D5D6DA"/>\n                    <path d="M92.043 10.643H81.597V7.576A6.582 6.582 0 0075.023 1a6.582 6.582 0 00-6.574 6.575v3.067H41.833V7.576A6.582 6.582 0 0035.26 1a6.582 6.582 0 00-6.574 6.575v3.149a2.187 2.187 0 00-.585-.082H19.37c-6.042 0-10.957 4.916-10.957 10.958v27.126a2.192 2.192 0 004.383 0V33.215h86.211a2.192 2.192 0 000-4.383H12.795v-7.231a6.582 6.582 0 016.574-6.575H28.1c.203 0 .398-.03.585-.08v2.82a6.582 6.582 0 006.574 6.574c3.625 0 10.574-2.95 10.574-6.574v-2.74H68.45v2.74a6.582 6.582 0 006.574 6.574c3.625 0 7.574-2.95 7.574-6.574v-2.74h9.446a6.582 6.582 0 016.574 6.575v73.072a3.95 3.95 0 01-3.946 3.945h-77.95a3.95 3.95 0 01-3.944-3.944v-5.67c0-1.047-.981-2.192-2.192-2.192-1.21 0-2.191.981-2.191 2.192v5.67c0 4.592 3.736 8.327 8.327 8.327h77.95c4.592 0 8.328-3.736 8.328-8.328V21.601c0-6.042-4.915-10.958-10.957-10.958zM37.45 17.766a2.194 2.194 0 01-2.191 2.191 2.194 2.194 0 01-2.191-2.191V7.576c0-1.209.983-2.192 2.19-2.192 1.21 0 2.192.983 2.192 2.192v10.19zm39.764 0a2.194 2.194 0 01-2.191 2.191 2.194 2.194 0 01-2.191-2.191V7.576c0-1.209.983-2.192 2.191-2.192 1.208 0 2.191.983 2.191 2.192v10.19z" fill="#D5D6DA" fill-rule="nonzero"/>\n                    <path d="M55.68 63.556c-4.592 0-8.328 3.736-8.328 8.327 0 4.592 3.736 8.328 8.327 8.328 4.592 0 8.328-3.736 8.328-8.328 0-4.591-3.736-8.327-8.328-8.327zm0 12.272a3.95 3.95 0 01-3.945-3.945 3.95 3.95 0 013.944-3.944 3.95 3.95 0 013.945 3.944 3.95 3.95 0 01-3.945 3.945zm26.854-12.272c-4.591 0-8.327 3.736-8.327 8.327 0 4.592 3.736 8.328 8.327 8.328 4.592 0 8.328-3.736 8.328-8.328 0-4.591-3.736-8.327-8.328-8.327zm0 12.272a3.95 3.95 0 01-3.944-3.945 3.95 3.95 0 013.944-3.944 3.95 3.95 0 013.945 3.944 3.95 3.95 0 01-3.945 3.945zM30.126 36.701c-4.591 0-8.327 3.736-8.327 8.328 0 4.591 3.736 8.327 8.327 8.327 4.592 0 8.328-3.736 8.328-8.327 0-4.592-3.736-8.328-8.328-8.328zm0 12.272a3.95 3.95 0 01-3.944-3.944 3.95 3.95 0 013.944-3.945 3.95 3.95 0 013.945 3.945 3.95 3.95 0 01-3.945 3.944z" fill="#D5D6DA" fill-rule="nonzero"/>\n                    <path d="M83.836 36.701c-4.592 0-8.328 3.736-8.328 8.328 0 4.591 3.736 8.327 8.328 8.327 4.591 0 8.327-3.736 8.327-8.327 0-4.592-3.736-8.328-8.327-8.328zm0 12.272a3.95 3.95 0 01-3.945-3.944 3.95 3.95 0 013.945-3.945 3.95 3.95 0 013.944 3.945 3.95 3.95 0 01-3.944 3.944z" fill="#2B3245" fill-rule="nonzero"/>\n                    <path d="M56.981 36.701c-4.592 0-8.327 3.736-8.327 8.328 0 4.591 3.735 8.327 8.327 8.327 4.592 0 8.327-3.736 8.327-8.327 0-4.592-3.735-8.328-8.327-8.328zm0 12.272a3.95 3.95 0 01-3.944-3.944 3.95 3.95 0 013.944-3.945 3.95 3.95 0 013.945 3.945 3.95 3.95 0 01-3.945 3.944z" fill="#D5D6DA" fill-rule="nonzero"/>\n                    <path d="M68.829 11.201l.001 6.375a6.375 6.375 0 006.146 6.371l.229.004a6.375 6.375 0 006.371-6.146l.004-.229-.001-6.375h6.871c6.627 0 12 5.373 12 12v8.4H11.2v-8.4c0-6.627 5.373-12 12-12h5.849l.001 6.75a6 6 0 005.775 5.996l.225.004h.375a6.375 6.375 0 006.375-6.375l-.001-6.375h27.03z" fill="#D5D6DA"/>\n                  </g>\n                </g>\n                <path d="M92 0c17.673 0 32 14.327 32 32 0 17.673-14.327 32-32 32-17.673 0-32-14.327-32-32C60 14.327 74.327 0 92 0zm21.268 15.365L75.365 53.268A26.884 26.884 0 0092 59c14.912 0 27-12.088 27-27a26.88 26.88 0 00-5.732-16.635zM92 5C77.088 5 65 17.088 65 32c0 6.475 2.28 12.417 6.079 17.069l37.99-37.99A26.888 26.888 0 0092 5z" fill="#D5D6DA"/>\n              </g>\n            </svg>\n          </div>\n          <div class="appointmentSlots-empty-text">' + JotForm.texts.noSlotsAvailable + '</div>\n        </div>\n      </div>\n    ';
	    /* eslint-enable */
	  };

	  var dateWithAMPM = function dateWithAMPM() {
	    var date = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
	    var _props8 = props,
	        _props8$timeFormat = _props8.timeFormat;
	    _props8$timeFormat = _props8$timeFormat === undefined ? {} : _props8$timeFormat;
	    var _props8$timeFormat$va = _props8$timeFormat.value,
	        timeFormat = _props8$timeFormat$va === undefined ? '24 Hour' : _props8$timeFormat$va;

	    var time = new Date(date.replace(/-/g, '/')).toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hourCycle: timeFormat === 'AM/PM' ? 'h12' : 'h23' });
	    var day = date && date.split(' ')[0];
	    return day + ' ' + time;
	  };

	  var renderSlots = function renderSlots() {
	    var _state13 = state,
	        dateStr = _state13.date,
	        _state13$value = _state13.value,
	        dateValue = _state13$value === undefined ? '' : _state13$value,
	        _state13$defaultValue = _state13.defaultValue,
	        defaultValue = _state13$defaultValue === undefined ? '' : _state13$defaultValue,
	        timezone = _state13.timezone,
	        forcedStartDate = _state13.forcedStartDate,
	        forcedEndDate = _state13.forcedEndDate;

	    var dateSlots = state.slots && state.slots[dateStr] || {};

	    var stateValue = dateWithAMPM(dateValue);
	    var defaultValueTZ = revertDate(defaultValue, ' ', timezone);

	    var parsedDefaultVal = dateWithAMPM(defaultValueTZ);

	    var entries = objectEntries(dateSlots);

	    if (!entries || !entries.length) {
	      return renderEmptyState();
	    }

	    return entries.map(function (_ref5) {
	      var name = _ref5[0],
	          value = _ref5[1];

	      var rn = amPmConverter(name);
	      var slotValue = dateStr + ' ' + rn;
	      var realD = dateInTimeZone(new Date(slotValue.replace(/-/g, '/')));
	      var active = stateValue === slotValue;

	      var disabled = forcedStartDate && forcedStartDate > realD || forcedEndDate && forcedEndDate < realD || !(value || parsedDefaultVal === slotValue);

	      return '<div class="appointmentSlot slot ' + classNames({ disabled: disabled, active: active }) + '" data-value="' + slotValue + '" role="button">' + name + '</div>';
	    }).join('');
	  };

	  var renderDay = function renderDay() {
	    var _state14 = state,
	        dateStr = _state14.date;

	    var date = new Date(dateStr);
	    var day = getDay(date);

	    return '\n      <div class=\'appointmentDate\'>\n        ' + (dateStr && dayNames()[day] + ', ' + monthNames()[date.getUTCMonth()] + ' ' + intPrefix(date.getUTCDate())) + '\n      </div>\n    ';
	  };

	  var renderCalendar = function renderCalendar() {
	    var _state15 = state,
	        dateStr = _state15.date;


	    return '\n      <div class=\'selectedDate\'>\n        <input class=\'currentDate\' type=\'text\' value=\'' + toFormattedDateStr(dateStr) + '\' style=\'pointer-events: none;\' />\n      </div>\n      ' + renderMonthYearPicker() + '\n      <div class=\'appointmentCalendarDays days\'>\n        <div class=\'daysOfWeek\'>\n          ' + dayNames().map(function (day) {
	      return '<div class="dayOfWeek ' + day.toLowerCase() + '">' + day.toUpperCase().slice(0, 3) + '</div>';
	    }).join('') + '\n        </div>\n        ' + renderCalendarDays() + '\n      </div>\n    ';
	  };

	  var renderSelectedDate = function renderSelectedDate() {
	    var _state16 = state,
	        _state16$value = _state16.value,
	        value = _state16$value === undefined ? '' : _state16$value;

	    var dateStr = value && value.split(' ')[0];
	    var _props9 = props,
	        _props9$timeFormat = _props9.timeFormat;
	    _props9$timeFormat = _props9$timeFormat === undefined ? {} : _props9$timeFormat;
	    var _props9$timeFormat$va = _props9$timeFormat.value,
	        timeFormat = _props9$timeFormat$va === undefined ? '24 Hour' : _props9$timeFormat$va;


	    var date = new Date(dateStr);
	    var time = new Date(value.replace(/-/g, '/')).toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hourCycle: timeFormat === 'AM/PM' ? 'h12' : 'h23' });
	    var day = getDay(date);
	    var datetime = dayNames()[day] + ', ' + monthNames()[date.getUTCMonth()] + ' ' + intPrefix(date.getUTCDate()) + ', ' + date.getFullYear();

	    var text = JotForm.texts.appointmentSelected.replace('{time}', time).replace('{date}', datetime);
	    var valEl = '<div style=\'display: none\' class=\'jsAppointmentValue\'>' + datetime + ' ' + time + '</div>';
	    return value ? valEl + '<div class=\'appointmentFieldRow forSelectedDate\'><span aria-live="polite">' + text + '</span><button type=\'button\' class=\'cancel\'>x</button></div>' : '';
	  };

	  var render = debounce(function () {
	    var _state17 = state,
	        loading = _state17.loading;


	    beforeRender();
	    element.innerHTML = '\n      <div class=\'appointmentFieldContainer\'>\n        <div class=\'appointmentFieldRow forCalendar\'>\n          <div class=\'calendar appointmentCalendar\'>\n            <div class=\'appointmentCalendarContainer\'>\n              ' + renderCalendar() + '\n            </div>\n          </div>\n          <div class=\'appointmentDates\'>\n            <div class=\'appointmentDateSelect\'>\n              ' + renderDay() + '\n              ' + renderDayPicker() + '\n            </div>\n            <div class=\'appointmentSlots slots ' + classNames({ isLoading: loading }) + '\'>\n              <div class=\'appointmentSlotsContainer\'>\n                ' + renderSlots() + '\n              </div>\n            </div>\n            <div class=\'appointmentCalendarTimezone forTimezonePicker\'>\n              ' + (isTimezonePickerFromCommonLoaded ? '' : renderTimezonePicker()) + '\n            </div>\n          </div>\n        </div>\n        ' + renderSelectedDate() + '\n      </div>\n    ';
	    afterRender();
	  });

	  var _update = function _update(newProps) {
	    state = assignObject({}, state, getStateFromProps(newProps));
	    props = newProps;
	    load();
	  };

	  input.addEventListener('change', function (e) {
	    if (!state.nyTz) return;
	    var date = e.target.value ? toDateTimeStr(dz(new Date(e.target.value.replace(/-/g, '/')), state.nyTz, getTimezoneOffset(state.timezone))) : '';
	    if (date) {
	      setDate(date.split(' ')[0]);
	      setState({ value: date, defaultValue: date });
	      validation(date);
	    }
	  });
	  tzInput.addEventListener('change', function (e) {
	    var defaultTimezone = e.target.value;
	    setTimezone(defaultTimezone);
	    setState({ defaultTimezone: defaultTimezone });
	  });
	  document.addEventListener('translationLoad', function () {
	    return render();
	  });

	  var getInitialData = function getInitialData(timezones) {
	    getFirstAvailableDates(function (data) {
	      var nyTz = -4;
	      try {
	        nyTz = getTimezoneOffset(timezones.find(function (_ref6) {
	          var group = _ref6.group;
	          return group === 'America';
	        }).cities.find(function (c) {
	          return c.indexOf('New_York') > -1;
	        }));
	      } catch (e) {
	        console.log(e);
	      }
	      JotForm.appointments.initialData = data;
	      JotForm.nyTz = nyTz;
	      JotForm.appointments.listeners.forEach(function (fn) {
	        return fn({ data: data, timezones: timezones, nyTz: nyTz });
	      });
	    });
	  };

	  if (!JotForm.appointments) {
	    JotForm.appointments = { listeners: [] };

	    loadTimezones(function (timezones) {
	      JotForm.timezones = timezones;
	      getInitialData(timezones);
	    });
	  }

	  var requestTry = 1;
	  var requestTimeout = 1000;

	  var construct = function construct(_ref7) {
	    var data = _ref7.data,
	        timezones = _ref7.timezones,
	        nyTz = _ref7.nyTz;

	    var qdata = data[props.id.value];
	    var _props10 = props,
	        _props10$autoDetectTi = _props10.autoDetectTimezone;
	    _props10$autoDetectTi = _props10$autoDetectTi === undefined ? {} : _props10$autoDetectTi;
	    var autoDetectValue = _props10$autoDetectTi.value;


	    if (autoDetectValue === 'No') {
	      load();
	    }

	    if (!qdata || qdata.error) {
	      constructed = true;

	      if (!qdata && requestTry < 4) {
	        requestTry += 1;
	        setTimeout(function () {
	          getInitialData(JotForm.timezones);
	        }, requestTry * requestTimeout);
	      }

	      return;
	    }

	    constructed = false;

	    var userTimezone = getUserTimezone();

	    var setUpdatedTimezone = function setUpdatedTimezone(currentTimezone) {
	      if (!currentTimezone) {
	        return currentTimezone;
	      }

	      var _currentTimezone$spli = currentTimezone.split('/'),
	          currentCont = _currentTimezone$spli[0],
	          currCity = _currentTimezone$spli[1];

	      var currentCity = currCity && currCity.split(' (')[0];
	      var group = timezones.find(function (timezone) {
	        return timezone.group === currentCont;
	      });
	      if (!group) {
	        return currentTimezone;
	      }
	      var matchedTimezone = group.cities.find(function (c) {
	        return c.indexOf(currentCity) > -1;
	      });

	      if (!matchedTimezone) return false;

	      return group.group + '/' + matchedTimezone;
	    };

	    var timezone = setUpdatedTimezone(userTimezone) || setUpdatedTimezone(props.timezone.value) || props.timezone.value;

	    if (window.timezonePickerCommon) {
	      isTimezonePickerFromCommonLoaded = true;
	      timezonePickerCommon = window.timezonePickerCommon({
	        id: uniqueId,
	        timezones: timezones,
	        selectedTimezone: timezone,
	        onOptionClick: onTimezoneOptionClick,
	        usePortal: true
	      });
	    }

	    setTimezone(timezone);
	    var dateStr = Object.keys(qdata)[0];

	    var _getDateRange2 = getDateRange(dateStr),
	        startDate = _getDateRange2[0],
	        endDate = _getDateRange2[1];

	    updateMonthData(startDate, endDate, qdata);
	    var _state18 = state,
	        availableDays = _state18.availableDays;

	    var newDate = availableDays.indexOf(dateStr) === -1 ? availableDays[0] : dateStr;

	    constructed = true;

	    setState({
	      timezones: timezones,
	      loading: false,
	      date: newDate || dateStr,
	      nyTz: nyTz
	    });

	    setTimeout(function () {
	      if (input.value) {
	        input.triggerEvent('change');
	      }
	    }, 100);
	  };

	  JotForm.appointments.listeners.push(construct);

	  if (JotForm.appointments.initialData) {
	    setTimeout(function () {
	      construct({
	        data: JotForm.appointments.initialData,
	        timezones: JotForm.timezones,
	        nyTz: JotForm.nyTz
	      });
	    }, requestTimeout);
	  }

	  JotForm.appointments[props.id.value] = {
	    update: function update(newProps) {
	      return _update(assignObject(passedProps, newProps));
	    },
	    forceStartDate: function forceStartDate(newDate) {
	      if (!newDate) {
	        setState({ forcedStartDate: undefined });
	        return;
	      }

	      try {
	        var forcedStartDate = new Date(newDate);
	        if ('' + forcedStartDate === '' + state.forcedStartDate) return;
	        var date = new Date(state.availableDays.find(function (d) {
	          return new Date(d + ' 23:59:59') >= forcedStartDate;
	        }));

	        if (!date.getTime()) {
	          date = forcedStartDate;
	        }

	        date = toDateStr(date);

	        setState({ forcedStartDate: forcedStartDate, date: date });
	      } catch (e) {
	        console.log(e);
	      }
	    },
	    forceEndDate: function forceEndDate(newDate) {
	      if (!newDate) {
	        setState({ forcedEndDate: undefined });
	        return;
	      }

	      try {
	        var forcedEndDate = new Date(newDate);
	        if ('' + forcedEndDate === '' + state.forcedEndDate) return;
	        var availableDays = state.availableDays.filter(function (d) {
	          return new Date(d + ' 00:00:00') <= forcedEndDate;
	        });

	        var date = new Date(availableDays.indexOf(state.date) > -1 ? state.date : availableDays[availableDays.length - 1]);

	        if (!date.getTime()) {
	          date = forcedEndDate;
	        }

	        date = toDateStr(date);

	        setState({ forcedEndDate: forcedEndDate, date: date });
	      } catch (e) {
	        console.log(e);
	      }
	    },
	    getComparableValue: function getComparableValue() {
	      return input.value && toDateTimeStr(dz(new Date(input.value.replace(/-/g, '/')), state.nyTz, getTimezoneOffset(props.timezone.value))) || '';
	    }
	  };

	  return _update;
	})({"text":{"text":"Question","value":"Elige la fecha de vuelo"},"labelAlign":{"text":"Label Align","value":"Top","dropdown":[["Auto","Auto"],["Left","Left"],["Right","Right"],["Top","Top"]]},"required":{"text":"Required","value":"No","dropdown":[["No","No"],["Yes","Yes"]]},"description":{"text":"Hover Text","value":"","textarea":true},"slotDuration":{"text":"Slot Duration","value":"60","dropdown":[[15,"15 min"],[30,"30 min"],[45,"45 min"],[60,"60 min"],["custom","Custom min"]],"hint":"Select how long each slot will be."},"startDate":{"text":"Start Date","value":""},"endDate":{"text":"End Date","value":""},"intervals":{"text":"Intervals","value":[{"from":"09:00","to":"17:00","days":["Mon","Tue","Wed","Thu","Fri"]}],"hint":"The hours will be applied to the selected days and repeated."},"useBlockout":{"text":"Blockout Custom Dates","value":"No","dropdown":[["No","No"],["Yes","Yes"]],"hint":"Disable certain date(s) in the calendar."},"blockoutDates":{"text":"Blockout dates","value":[{"startDate":"","endDate":""}]},"useLunchBreak":{"text":"Lunch Time","value":"Yes","dropdown":[["No","No"],["Yes","Yes"]],"hint":"Enable lunchtime in the calendar."},"lunchBreak":{"text":"Lunchtime hours","value":[{"from":"12:00","to":"14:00"}]},"timezone":{"text":"Timezone","value":"America/Ojinaga (GMT-06:00)"},"timeFormat":{"text":"Time Format","value":"AM/PM","dropdown":[["24 Hour","24 Hour"],["AM/PM","AM/PM"]],"icon":"images/blank.gif","iconClassName":"toolbar-time_format_24"},"months":{"value":["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],"hidden":true},"days":{"value":["Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo"],"hidden":true},"startWeekOn":{"text":"Start Week On","value":"Sunday","dropdown":[["Monday","Monday"],["Sunday","Sunday"]],"toolbar":false},"rollingDays":{"text":"Rolling Days","value":"","toolbar":false},"prevMonthButtonText":{"text":"Previous month","value":""},"nextMonthButtonText":{"text":"Next month","value":""},"prevYearButtonText":{"text":"Previous year","value":""},"nextYearButtonText":{"text":"Next year","value":""},"prevDayButtonText":{"text":"Previous day","value":""},"nextDayButtonText":{"text":"Next day","value":""},"appointmentType":{"hidden":true,"value":"single"},"autoDetectTimezone":{"hidden":true,"value":"Yes"},"dateFormat":{"hidden":true,"value":"mm/dd/yyyy"},"maxAttendee":{"hidden":true,"value":"5"},"maxEvents":{"hidden":true,"value":""},"minScheduleNotice":{"hidden":true,"value":"3"},"name":{"hidden":true,"value":"eligeLa"},"order":{"hidden":true,"value":"7"},"qid":{"toolbar":false,"value":"input_31"},"reminderEmails":{"hidden":true,"value":{"schedule":[{"value":"2","unit":"hour"}]}},"type":{"hidden":true,"value":"control_appointment"},"useReminderEmails":{"hidden":true,"value":"No"},"id":{"toolbar":false,"value":"31"},"qname":{"toolbar":false,"value":"q31_eligeLa"},"cdnconfig":{"CDN":"https://cdn.jotfor.ms/"},"passive":false,"formProperties":{"products":false,"highlightLine":"Enabled","coupons":false,"useStripeCoupons":false,"taxes":false,"comparePaymentForm":"","paymentListSettings":false,"newPaymentUIForNewCreatedForms":false,"formBackground":"#000000"},"formID":213088059517864,"themeVersion":"v1"});
        productID = {};
      paymentType = "product";
      JotForm.setCurrencyFormat('USD',true, 'point');
      JotForm.totalCounter({});
      $$('.form-product-custom_quantity').each(function(el, i){el.observe('blur', function(){isNaN(this.value) || this.value < 1 ? this.value = '0' : this.value = parseInt(this.value)})});
      $$('.form-product-custom_quantity').each(function(el, i){el.observe('focus', function(){this.value == 0 ? this.value = '' : this.value})});
      JotForm.paymentProperties = {"styleColor":"gold","styleShape":"rect","styleSize":"medium","styleLabel":"checkout","styleLayout":"vertical","payLaterEnabled":"No","paymentFormProperties":{"products":false}}
      JotForm.alterTexts(undefined);
	/*INIT-END*/
	});

   JotForm.prepareCalculationsOnTheFly([null,null,{"name":"enviar","qid":"2","text":"Enviar","type":"control_button"},{"name":"nombreDel","qid":"3","text":"nombre del encargado","type":"control_fullname"},{"name":"email","qid":"4","subLabel":"rubydavila@gmail.com","text":"Email","type":"control_email"},null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,{"name":"input26","qid":"26","text":"","type":"control_text"},null,{"name":"input28","qid":"28","text":"","type":"control_text"},{"name":"input29","qid":"29","text":"","type":"control_text"},null,{"description":"","name":"eligeLa","qid":"31","text":"Elige la fecha de vuelo","type":"control_appointment"},null,null,null,{"name":"destinarioDe","qid":"35","text":"Destinario de vuelo","type":"control_widget"},null,null,{"description":"","name":"numeroDe","qid":"38","subLabel":"","text":"Numero de boletos","type":"control_number"},null,null,null,null,null,{"description":"","name":"misProductos","qid":"44","text":"Mis Productos","type":"control_paypalcomplete"},{"name":"metodosDe","qid":"45","text":"Metodos de Pago","type":"control_paymentmethods"}]);
   setTimeout(function() {
JotForm.paymentExtrasOnTheFly([null,null,{"name":"enviar","qid":"2","text":"Enviar","type":"control_button"},{"name":"nombreDel","qid":"3","text":"nombre del encargado","type":"control_fullname"},{"name":"email","qid":"4","subLabel":"rubydavila@gmail.com","text":"Email","type":"control_email"},null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,{"name":"input26","qid":"26","text":"","type":"control_text"},null,{"name":"input28","qid":"28","text":"","type":"control_text"},{"name":"input29","qid":"29","text":"","type":"control_text"},null,{"description":"","name":"eligeLa","qid":"31","text":"Elige la fecha de vuelo","type":"control_appointment"},null,null,null,{"name":"destinarioDe","qid":"35","text":"Destinario de vuelo","type":"control_widget"},null,null,{"description":"","name":"numeroDe","qid":"38","subLabel":"","text":"Numero de boletos","type":"control_number"},null,null,null,null,null,{"description":"","name":"misProductos","qid":"44","text":"Mis Productos","type":"control_paypalcomplete"},{"name":"metodosDe","qid":"45","text":"Metodos de Pago","type":"control_paymentmethods"}]);}, 20); 
</script>
<link href="https://cdn01.jotfor.ms/static/formCss.css?3.3.28886" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="https://cdn02.jotfor.ms/css/styles/nova.css?3.3.28886" />
<style type="text/css">@media print{.form-section{display:inline!important}.form-pagebreak{display:none!important}.form-section-closed{height:auto!important}.page-section{position:initial!important}}</style>
<link type="text/css" rel="stylesheet" href="https://cdn03.jotfor.ms/themes/CSS/566a91c2977cdfcd478b4567.css?"/>
<link type="text/css" rel="stylesheet" href="https://cdn01.jotfor.ms/css/styles/payment/payment_feature.css?3.3.28886" />
<style type="text/css">
@import '//fonts.googleapis.com/css?family=Cabin:light,lightitalic,normal,italic,bold,bolditalic';

    .form-label-left{
        width:150px;
    }
    .form-line{
        padding-top:12px;
        padding-bottom:12px;
    }
    .form-label-right{
        width:150px;
    }
    .form-all{
        width:690px;
        color:#ffffff !important;
        font-family:'Cabin';
        font-size:17px;
    }
</style>

<style type="text/css" id="form-designer-style">
    /* Injected CSS Code */
@import "https://fonts.googleapis.com/css?family=Cabin:light,lightitalic,normal,italic,bold,bolditalic";
@import "//www.jotform.com/themes/css/buttons/form-submit-button-black_glass.css";
.form-all:after {
  content: "";
  display: table;
  clear: both;
}
.form-all {
  font-family: "Cabin", sans-serif;
}
.form-all {
  width: 690px;
}
.form-label-left,
.form-label-right {
  width: 150px;
}
.form-label {
  white-space: normal;
}
.form-label.form-label-auto {
  display: block;
  float: none;
  word-break: break-word;
  text-align: left;
}
.form-label-left {
  display: inline-block;
  white-space: normal;
  float: left;
  text-align: left;
}
.form-label-right {
  display: inline-block;
  white-space: normal;
  float: left;
  text-align: right;
}
.form-label-top {
  white-space: normal;
  display: block;
  float: none;
  text-align: left;
}
.form-radio-item label:before {
  top: 0;
}
.form-all {
  font-size: 17px;
}
.form-label {
  font-weight: bold;
}
.form-checkbox-item label,
.form-radio-item label {
  font-weight: normal;
}
.supernova {
  background-color: rgba(255, 255, 255, 0.63);
  background-color: #f8f8f8;
}
.supernova body {
  background-color: transparent;
}
/*
@width30: (unit(@formWidth, px) + 60px);
@width60: (unit(@formWidth, px)+ 120px);
@width90: (unit(@formWidth, px)+ 180px);
*/
/* | */
@media screen and (min-width: 480px) {
  .supernova .form-all {
    border: 1px solid #dfdfdf;
    -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.1);
    box-shadow: 0 3px 9px rgba(0, 0, 0, 0.1);
  }
}
/* | */
/* | */
@media screen and (max-width: 480px) {
  .jotform-form .form-all {
    margin: 0;
    width: 100%;
  }
}
/* | */
/* | */
@media screen and (min-width: 480px) and (max-width: 767px) {
  .jotform-form .form-all {
    margin: 0;
    width: 100%;
  }
}
/* | */
/* | */
@media screen and (min-width: 480px) and (max-width: 689px) {
  .jotform-form .form-all {
    margin: 0;
    width: 100%;
  }
}
/* | */
/* | */
@media screen and (min-width: 768px) {
  .jotform-form {
    padding: 60px 0;
  }
}
/* | */
/* | */
@media screen and (max-width: 689px) {
  .jotform-form .form-all {
    margin: 0;
    width: 100%;
  }
}
/* | */
.supernova .form-all,
.form-all {
  background-color: rgba(255, 255, 255, 0.63);
  border: 1px solid transparent;
}
.form-header-group {
  border-color: rgba(230, 230, 230, 0.63);
}
.form-matrix-table tr {
  border-color: rgba(230, 230, 230, 0.63);
}
.form-matrix-table tr:nth-child(2n) {
  background-color: rgba(242, 242, 242, 0.63);
}
.form-all {
  color: rgba(52, 35, 38, 0.52);
}
.form-header-group .form-header {
  color: rgba(52, 35, 38, 0.52);
}
.form-header-group .form-subHeader {
  color: rgba(82, 56, 60, 0.52);
}
.form-sub-label {
  color: rgba(82, 56, 60, 0.52);
}
.form-label-top,
.form-label-left,
.form-label-right,
.form-html {
  color: rgba(52, 35, 38, 0.52);
}
.form-checkbox-item label,
.form-radio-item label {
  color: rgba(82, 56, 60, 0.52);
}
.form-line.form-line-active {
  -webkit-transition-property: all;
  -moz-transition-property: all;
  -ms-transition-property: all;
  -o-transition-property: all;
  transition-property: all;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  -ms-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-timing-function: ease;
  -moz-transition-timing-function: ease;
  -ms-transition-timing-function: ease;
  -o-transition-timing-function: ease;
  transition-timing-function: ease;
  background-color: rgba(255, 255, 255, 0.75);
}
/* omer */
.form-radio-item,
.form-checkbox-item {
  padding-bottom: 0px !important;
}
.form-radio-item:last-child,
.form-checkbox-item:last-child {
  padding-bottom: 0;
}
/* omer */
.form-single-column .form-checkbox-item,
.form-single-column .form-radio-item {
  width: 100%;
}
.form-checkbox-item .editor-container div,
.form-radio-item .editor-container div {
  position: relative;
}
.form-checkbox-item .editor-container div:before,
.form-radio-item .editor-container div:before {
  display: inline-block;
  vertical-align: middle;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  left: 0;
  width: 24px;
  height: 24px;
}
.form-radio-item:not(#foo) {
  position: relative;
}
.form-radio-item:not(#foo) .form-radio-other-input,
.form-radio-item:not(#foo) .form-checkbox-item:not(#foo) .form-checkbox-other-input {
  margin-left: 0;
}
.form-radio-item:not(#foo) .form-radio-other.form-radio {
  display: none !important;
}
.form-radio-item:not(#foo) input[type="checkbox"],
.form-radio-item:not(#foo) input[type="radio"] {
  display: none;
}
.form-radio-item:not(#foo) .form-radio-other,
.form-radio-item:not(#foo) .form-checkbox-other {
  display: inline-block !important;
  margin-left: 17px;
  margin-right: 13px;
  margin-top: 0px;
}
.form-radio-item:not(#foo) .form-checkbox-other-input,
.form-radio-item:not(#foo) .form-radio-other-input {
  margin: 0;
}
.form-radio-item:not(#foo) label {
  line-height: 18px;
  float: left;
  margin-left: 37px;
}
.form-radio-item:not(#foo) label:before {
  content: '';
  position: absolute;
  display: inline-block;
  vertical-align: baseline;
  margin-right: 4px;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  left: 4px;
  width: 18px;
  height: 18px;
  cursor: pointer;
}
.form-radio-item:not(#foo) label:after {
  content: '';
  position: absolute;
  z-index: 10;
  display: inline-block;
  opacity: 0;
  top: 5px;
  left: 9px;
  width: 8px;
  height: 8px;
}
.form-radio-item:not(#foo) input:checked + label:after {
  opacity: 1;
}
.form-radio-item:not(#foo) input[type="checkbox"],
.form-radio-item:not(#foo) input[type="radio"] {
  display: none;
}
.form-radio-item:not(#foo) .form-radio-other,
.form-radio-item:not(#foo) .form-checkbox-other {
  display: inline-block !important;
  margin-left: 17px;
  margin-right: 13px;
  margin-top: 0px;
}
.form-radio-item:not(#foo) .form-checkbox-other-input,
.form-radio-item:not(#foo) .form-radio-other-input {
  margin: 0;
}
.form-radio-item:not(#foo) label {
  line-height: 24px;
  float: left;
  margin-left: 43px;
}
.form-radio-item:not(#foo) label:before {
  content: '';
  position: absolute;
  display: inline-block;
  vertical-align: baseline;
  margin-right: 4px;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  left: 4px;
  width: 24px;
  height: 24px;
  cursor: pointer;
}
.form-radio-item:not(#foo) label:after {
  content: '';
  position: absolute;
  z-index: 10;
  display: inline-block;
  opacity: 0;
  top: 7px;
  left: 11px;
  width: 10px;
  height: 10px;
}
.form-radio-item:not(#foo) input:checked + label:after {
  opacity: 1;
}
.form-radio-item:not(#foo) label:before {
  border: 2px solid #555555;
}
.form-radio-item:not(#foo) label:after {
  background-color: #555555;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  cursor: pointer;
}
.form-radio-item:not(#foo) .editor-container div:before {
  content: '';
  border: 2px solid #555555;
  border-radius: 50%;
  margin: 0 4px 0 -6px;
}
.form-checkbox-item:not(#foo) {
  position: relative;
}
.form-checkbox-item:not(#foo) label {
  display: block;
}
.form-checkbox-item:not(#foo) .form-radio-other-input,
.form-checkbox-item:not(#foo) .form-checkbox-item:not(#foo) .form-checkbox-other-input {
  margin-left: 0;
}
.form-checkbox-item:not(#foo) .form-checkbox-other.form-checkbox {
  display: none !important;
}
.form-checkbox-item:not(#foo) input[type="checkbox"],
.form-checkbox-item:not(#foo) input[type="radio"] {
  display: none;
}
.form-checkbox-item:not(#foo) .form-radio-other,
.form-checkbox-item:not(#foo) .form-checkbox-other {
  display: inline-block !important;
  margin-left: 17px;
  margin-right: 13px;
  margin-top: 0px;
}
.form-checkbox-item:not(#foo) .form-checkbox-other-input,
.form-checkbox-item:not(#foo) .form-radio-other-input {
  margin: 0;
}
.form-checkbox-item:not(#foo) label {
  line-height: 18px;
  float: left;
  margin-left: 37px;
}
.form-checkbox-item:not(#foo) label:before {
  content: '';
  position: absolute;
  display: inline-block;
  vertical-align: baseline;
  margin-right: 4px;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  left: 4px;
  width: 18px;
  height: 18px;
  cursor: pointer;
}
.form-checkbox-item:not(#foo) label:after {
  content: '';
  position: absolute;
  z-index: 10;
  display: inline-block;
  opacity: 0;
  top: 8px;
  left: 9px;
  width: 3px;
  height: 3px;
}
.form-checkbox-item:not(#foo) input:checked + label:after {
  opacity: 1;
}
.form-checkbox-item:not(#foo) label:before {
  border: 2px solid #555555;
}
.form-checkbox-item:not(#foo) label:after {
  background-color: #555555;
  box-shadow: 0 2px 0 0 #555555, 2px 2px 0 0 #555555, 4px 2px 0 0 #555555, 6px 2px 0 0 #555555;
  -moz-transform: rotate(-45deg);
  -webkit-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  transform: rotate(-45deg);
}
.form-checkbox-item:not(#foo) .editor-container div:before {
  content: '';
  border: 2px solid #555555;
  border-radius: 50%;
  margin: 0 4px 0 -6px;
}
.form-checkbox-item:not(#foo) input[type="checkbox"],
.form-checkbox-item:not(#foo) input[type="radio"] {
  display: none;
}
.form-checkbox-item:not(#foo) .form-radio-other,
.form-checkbox-item:not(#foo) .form-checkbox-other {
  display: inline-block !important;
  margin-left: 17px;
  margin-right: 13px;
  margin-top: 0px;
}
.form-checkbox-item:not(#foo) .form-checkbox-other-input,
.form-checkbox-item:not(#foo) .form-radio-other-input {
  margin: 0;
}
.form-checkbox-item:not(#foo) label {
  line-height: 24px;
  float: left;
  margin-left: 43px;
}
.form-checkbox-item:not(#foo) label:before {
  content: '';
  position: absolute;
  display: inline-block;
  vertical-align: baseline;
  margin-right: 4px;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  left: 4px;
  width: 24px;
  height: 24px;
  cursor: pointer;
}
.form-checkbox-item:not(#foo) label:after {
  content: '';
  position: absolute;
  z-index: 10;
  display: inline-block;
  opacity: 0;
  top: 11px;
  left: 10px;
  width: 4px;
  height: 4px;
}
.form-checkbox-item:not(#foo) input:checked + label:after {
  opacity: 1;
}
.form-checkbox-item:not(#foo) label:after {
  background-color: #555555;
  box-shadow: 0 3px 0 0 #555555, 3px 3px 0 0 #555555, 6px 3px 0 0 #555555, 8px 3px 0 0 #555555;
  -moz-transform: rotate(-45deg);
  -webkit-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  transform: rotate(-45deg);
}
.supernova {
  height: 100%;
  background-repeat: no-repeat;
  background-attachment: scroll;
  background-position: center top;
  background-attachment: fixed;
  background-size: auto;
  background-size: cover;
}
.supernova {
  background-image: none;
}
#stage {
  background-image: none;
}
/* | */
.form-all {
  background-repeat: no-repeat;
  background-attachment: scroll;
  background-position: center top;
  background-repeat: repeat;
}
.form-header-group {
  background-repeat: no-repeat;
  background-attachment: scroll;
  background-position: center top;
}
.form-line {
  margin-top: 12px;
  margin-bottom: 12px;
}
.form-line {
  padding: 12px 36px;
}
.form-all .form-textbox,
.form-all .form-radio-other-input,
.form-all .form-checkbox-other-input,
.form-all .form-captcha input,
.form-all .form-spinner input,
.form-all .form-pagebreak-back,
.form-all .form-pagebreak-next,
.form-all .qq-upload-button,
.form-all .form-error-message {
  -webkit-border-radius: 20px;
  -moz-border-radius: 20px;
  border-radius: 20px;
}
.form-all .form-sub-label {
  margin-left: 3px;
}
.form-all .form-textarea {
  -webkit-border-radius: 20px;
  -moz-border-radius: 20px;
  border-radius: 20px;
  padding: 10px;
}
.form-all .form-submit-button,
.form-all .form-submit-reset,
.form-all .form-submit-print {
  -webkit-border-radius: 100px;
  -moz-border-radius: 100px;
  border-radius: 100px;
}
.form-all .form-sub-label {
  margin-left: 3px;
}
.form-dropdown {
  -webkit-border-radius: 100px;
  -moz-border-radius: 100px;
  border-radius: 100px;
  -webkit-appearance: none;
  -moz-appearance: button;
  appearance: none;
  margin: 0;
}
.form-all .qq-upload-button,
.form-all .form-submit-button,
.form-all .form-submit-reset,
.form-all .form-submit-print {
  font-size: 1.15em;
  padding: 12px 18px;
  display: block;
  width: 100%;
  margin: 0;
  font-family: "Cabin", sans-serif;
  font-size: 17px;
  font-weight: normal;
}
.form-all .form-buttons-wrapper {
  margin-left: 0 !important;
}
.form-all .form-pagebreak-back-container,
.form-all .form-pagebreak-next-container {
  width: 48% !important;
  padding: 24px 0;
}
.form-all .form-pagebreak-next-container {
  margin-left: 4%;
}
.form-all .form-submit-print {
  margin-left: 0 !important;
  margin-right: 0 !important;
}
.form-all .form-pagebreak-back,
.form-all .form-pagebreak-next {
  font-size: 1em;
  padding: 9px 15px;
  font-family: "Cabin", sans-serif;
  font-size: 17px;
  font-weight: normal;
}
/*
& when ( @buttonFontType = google ) {
	@import (css) "@{buttonFontLink}";
}
*/
h2.form-header {
  line-height: 1.618em;
  font-size: 1.714em;
}
h2 ~ .form-subHeader {
  line-height: 1.5em;
  font-size: 1.071em;
}
.form-header-group {
  text-align: left;
}
/*.form-dropdown,
.form-radio-item,
.form-checkbox-item,
.form-radio-other-input,
.form-checkbox-other-input,*/
.form-captcha input,
.form-spinner input,
.form-error-message {
  padding: 4px 3px 2px 3px;
}
.form-header-group {
  font-family: "Cabin", sans-serif;
}
.form-section {
  padding: 0px 0px 0px 0px;
}
.form-header-group {
  margin: 12px 40px 12px 40px;
}
.form-header-group {
  padding: 24px 21px 24px 21px;
}
.form-header-group {
  background-color: #f7d9d2;
}
.form-textbox,
.form-textarea {
  border-style: groove;
  border-color: #faf8f6;
  padding: 4px 3px 2px 3px;
}
.form-textbox,
.form-textarea,
.form-radio-other-input,
.form-checkbox-other-input,
.form-captcha input,
.form-spinner input {
  background-color: #f7d9d2;
}
.form-dropdown {
  -webkit-appearance: menulist-button;
  border-color: #f8f8f8;
}
[data-type="control_dropdown"] .form-input,
[data-type="control_dropdown"] .form-input-wide {
  width: 150px;
}
.form-label {
  font-family: "Cabin", sans-serif;
}
li[data-type="control_image"] div {
  text-align: left;
}
li[data-type="control_image"] img {
  border: none;
  border-width: 0px !important;
  border-style: solid !important;
  border-color: false !important;
}
.form-line-column {
  width: auto;
}
.form-line-error {
  overflow: hidden;
  -webkit-transition-property: none;
  -moz-transition-property: none;
  -ms-transition-property: none;
  -o-transition-property: none;
  transition-property: none;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  -ms-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-timing-function: ease;
  -moz-transition-timing-function: ease;
  -ms-transition-timing-function: ease;
  -o-transition-timing-function: ease;
  transition-timing-function: ease;
  background-color: #fff4f4;
}
.form-line-error .form-error-message {
  background-color: #ff3200;
  clear: both;
  float: none;
}
.form-line-error .form-error-message .form-error-arrow {
  border-bottom-color: #ff3200;
}
.form-line-error input:not(#coupon-input),
.form-line-error textarea,
.form-line-error .form-validation-error {
  border: 1px solid #ff3200;
  -webkit-box-shadow: 0 0 3px #ff3200;
  -moz-box-shadow: 0 0 3px #ff3200;
  box-shadow: 0 0 3px #ff3200;
}
.ie-8 .form-all {
  margin-top: auto;
  margin-top: initial;
}
.ie-8 .form-all:before {
  display: none;
}
[data-type="control_clear"] {
  display: none;
}
/* | */
@media screen and (max-width: 480px), screen and (max-device-width: 767px) and (orientation: portrait), screen and (max-device-width: 415px) and (orientation: landscape) {
  .testOne {
    letter-spacing: 0;
  }
  .form-all {
    border: 0;
    max-width: initial;
  }
  .form-sub-label-container {
    width: 100%;
    margin: 0;
    margin-right: 0;
    float: left;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }
  span.form-sub-label-container + span.form-sub-label-container {
    margin-right: 0;
  }
  .form-sub-label {
    white-space: normal;
  }
  .form-address-table td,
  .form-address-table th {
    padding: 0 1px 10px;
  }
  .form-submit-button,
  .form-submit-print,
  .form-submit-reset {
    width: 100%;
    margin-left: 0!important;
  }
  div[id*=at_] {
    font-size: 14px;
    font-weight: 700;
    height: 8px;
    margin-top: 6px;
  }
  .showAutoCalendar {
    width: 20px;
  }
  img.form-image {
    max-width: 100%;
    height: auto;
  }
  .form-matrix-row-headers {
    width: 100%;
    word-break: break-all;
    min-width: 40px;
  }
  .form-collapse-table,
  .form-header-group {
    margin: 0;
  }
  .form-collapse-table {
    height: 100%;
    display: inline-block;
    width: 100%;
  }
  .form-collapse-hidden {
    display: none !important;
  }
  .form-input {
    width: 100%;
  }
  .form-label {
    width: 100% !important;
  }
  .form-label-left,
  .form-label-right {
    display: block;
    float: none;
    text-align: left;
    width: auto!important;
  }
  .form-line,
  .form-line.form-line-column {
    padding: 2% 5%;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }
  input[type=text],
  input[type=email],
  input[type=tel],
  textarea {
    width: 100%;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    max-width: initial !important;
  }
  .form-radio-other-input,
  .form-checkbox-other-input {
    max-width: 55% !important;
  }
  .form-dropdown,
  .form-textarea,
  .form-textbox {
    width: 100%!important;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }
  .form-input,
  .form-input-wide,
  .form-textarea,
  .form-textbox,
  .form-dropdown {
    max-width: initial!important;
  }
  .form-checkbox-item:not(#foo),
  .form-radio-item:not(#foo) {
    width: 100%;
  }
  .form-address-city,
  .form-address-line,
  .form-address-postal,
  .form-address-state,
  .form-address-table,
  .form-address-table .form-sub-label-container,
  .form-address-table select,
  .form-input {
    width: 100%;
  }
  div.form-header-group {
    padding: 24px 21px !important;
    margin: 0 12px 2% !important;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }
  div.form-header-group.hasImage img {
    max-width: 100%;
  }
  [data-type="control_button"] {
    margin-bottom: 0 !important;
  }
  [data-type=control_fullname] .form-sub-label-container {
    width: 48%;
  }
  [data-type=control_fullname] .form-sub-label-container:first-child {
    margin-right: 4%;
  }
  [data-type=control_phone] .form-sub-label-container {
    width: 65%;
    margin-right: 0;
    margin-left: 0;
    float: left;
  }
  [data-type=control_phone] .form-sub-label-container:first-child {
    width: 31%;
    margin-right: 4%;
  }
  [data-type=control_datetime] .allowTime-container {
    width: 100%;
  }
  [data-type=control_datetime] .form-sub-label-container:first-child {
    width: 10%!important;
    margin-left: 0;
    margin-right: 0;
  }
  [data-type=control_datetime] .form-sub-label-container + .form-sub-label-container {
    width: 24%!important;
    margin-left: 6%;
    margin-right: 0;
  }
  [data-type=control_datetime] span + span + span > span:first-child {
    display: block;
    width: 100% !important;
  }
  [data-type=control_birthdate] .form-sub-label-container,
  [data-type=control_time] .form-sub-label-container {
    width: 27.3%!important;
    margin-right: 6% !important;
  }
  [data-type=control_time] .form-sub-label-container:last-child {
    width: 33.3%!important;
    margin-right: 0 !important;
  }
  .form-pagebreak-back-container,
  .form-pagebreak-next-container {
    min-height: 1px;
    width: 50% !important;
  }
  .form-pagebreak-back,
  .form-pagebreak-next,
  .form-product-item.hover-product-item {
    width: 100%;
  }
  .form-pagebreak-back-container {
    padding: 0;
    text-align: right;
  }
  .form-pagebreak-next-container {
    padding: 0;
    text-align: left;
  }
  .form-pagebreak {
    margin: 0 auto;
  }
  .form-buttons-wrapper {
    margin: 0!important;
    margin-left: 0!important;
  }
  .form-buttons-wrapper button {
    width: 100%;
  }
  .form-buttons-wrapper .form-submit-print {
    margin: 0 !important;
  }
  table {
    width: 100%!important;
    max-width: initial!important;
  }
  table td + td {
    padding-left: 3%;
  }
  .form-checkbox-item,
  .form-radio-item {
    white-space: normal!important;
  }
  .form-checkbox-item input,
  .form-radio-item input {
    width: auto;
  }
  .form-collapse-table {
    margin: 0 5%;
    display: block;
    zoom: 1;
    width: auto;
  }
  .form-collapse-table:before,
  .form-collapse-table:after {
    display: table;
    content: '';
    line-height: 0;
  }
  .form-collapse-table:after {
    clear: both;
  }
  .fb-like-box {
    width: 98% !important;
  }
  .form-error-message {
    clear: both;
    bottom: -10px;
  }
  .date-separate,
  .phone-separate {
    display: none;
  }
  .custom-field-frame,
  .direct-embed-widgets,
  .signature-pad-wrapper {
    width: 100% !important;
  }
}
/* | */

/*PREFERENCES STYLE*/
    .form-all {
      font-family: Cabin, sans-serif;
    }
    .form-all .qq-upload-button,
    .form-all .form-submit-button,
    .form-all .form-submit-reset,
    .form-all .form-submit-print {
      font-family: Cabin, sans-serif;
    }
    .form-all .form-pagebreak-back-container,
    .form-all .form-pagebreak-next-container {
      font-family: Cabin, sans-serif;
    }
    .form-header-group {
      font-family: Cabin, sans-serif;
    }
    .form-label {
      font-family: Cabin, sans-serif;
    }
  
    .form-label.form-label-auto {
      
    display: block;
    float: none;
    text-align: left;
    width: 100%;
  
    }
  
    .form-line {
      margin-top: 12px;
      margin-bottom: 12px;
    }
  
    .form-all {
      max-width: 690px;
      width: 100%;
    }
  
    .form-label.form-label-left,
    .form-label.form-label-right,
    .form-label.form-label-left.form-label-auto,
    .form-label.form-label-right.form-label-auto {
      width: 150px;
    }
  
    .form-all {
      font-size: 17px
    }
    .form-all .qq-upload-button,
    .form-all .qq-upload-button,
    .form-all .form-submit-button,
    .form-all .form-submit-reset,
    .form-all .form-submit-print {
      font-size: 17px
    }
    .form-all .form-pagebreak-back-container,
    .form-all .form-pagebreak-next-container {
      font-size: 17px
    }
  
    .supernova .form-all, .form-all {
      background-color: #000000;
    }
  
    .form-all {
      color: #ffffff;
    }
    .form-header-group .form-header {
      color: #ffffff;
    }
    .form-header-group .form-subHeader {
      color: #ffffff;
    }
    .form-label-top,
    .form-label-left,
    .form-label-right,
    .form-html,
    .form-checkbox-item label,
    .form-radio-item label {
      color: #ffffff;
    }
    .form-sub-label {
      color: #ffffff;
    }
  
    .supernova {
      background-color: #f5f5f5;
    }
    .supernova body {
      background: transparent;
    }
  
    .form-textbox,
    .form-textarea,
    .form-dropdown,
    .form-radio-other-input,
    .form-checkbox-other-input,
    .form-captcha input,
    .form-spinner input {
      background-color: #fff;
    }
  
    .supernova {
      background-image: none;
    }
    #stage {
      background-image: none;
    }
  
    .form-all {
      background-image: none;
    }
  
  .ie-8 .form-all:before { display: none; }
  .ie-8 {
    margin-top: auto;
    margin-top: initial;
  }
  
  /*PREFERENCES STYLE*//*__INSPECT_SEPERATOR__*/
.form-input-wide div {

}

.form-line {

}

#id_14 {

}

.form-submit-button {

}

#input_2 {

}


    /* Injected CSS Code */
</style>

<link type="text/css" rel="stylesheet" href="https://cdn02.jotfor.ms/css/styles/buttons/form-submit-button-black_glass.css?3.3.28886"/>
<form class="jotform-form" action="https://submit.jotform.com/submit/213088059517864/" method="post" name="form_213088059517864" id="213088059517864" accept-charset="utf-8" autocomplete="on">
  <input type="hidden" name="formID" value="213088059517864" />
  <input type="hidden" id="JWTContainer" value="" />
  <input type="hidden" id="cardinalOrderNumber" value="" />
  <div role="main" class="form-all">
    <ul class="form-section page-section">
      <li class="form-line" data-type="control_text" id="id_29">
        <div id="cid_29" class="form-input-wide">
          <div id="text_29" class="form-html" data-component="text">
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_text" id="id_28">
        <div id="cid_28" class="form-input-wide">
          <div id="text_28" class="form-html" data-component="text">
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_text" id="id_26">
        <div id="cid_26" class="form-input-wide">
          <div id="text_26" class="form-html" data-component="text">
            <p><img src="https://www.jotform.com/uploads/lic.juandavila/form_files/aviones%20(1).6185ede7766305.44440180.png" alt width="615" height="80" /></p>
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_number" id="id_38">
        <label class="form-label form-label-top form-label-auto" id="label_38" for="input_38"> Numero de boletos </label>
        <div id="cid_38" class="form-input-wide">
          <input type="number" id="input_38" name="q38_numeroDe" data-type="input-number" class=" form-number-input form-textbox" data-defaultvalue="" style="width:60px" size="5" value="" placeholder="ej: 23" data-component="number" aria-labelledby="label_38" step="any" />
        </div>
      </li>
      <li class="form-line" data-type="control_fullname" id="id_3">
        <label class="form-label form-label-top form-label-auto" id="label_3" for="first_3"> nombre del encargado </label>
        <div id="cid_3" class="form-input-wide">
          <div data-wrapper-react="true">
            <span class="form-sub-label-container" style="vertical-align:top" data-input-type="first">
              <input type="text" id="first_3" name="q3_nombreDel[first]" class="form-textbox" data-defaultvalue="" size="10" value="" data-component="first" aria-labelledby="label_3 sublabel_3_first" />
              <label class="form-sub-label" for="first_3" id="sublabel_3_first" style="min-height:13px" aria-hidden="false"> nombre </label>
            </span>
            <span class="form-sub-label-container" style="vertical-align:top" data-input-type="last">
              <input type="text" id="last_3" name="q3_nombreDel[last]" class="form-textbox" data-defaultvalue="" size="15" value="" data-component="last" aria-labelledby="label_3 sublabel_3_last" />
              <label class="form-sub-label" for="last_3" id="sublabel_3_last" style="min-height:13px" aria-hidden="false"> apellido </label>
            </span>
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_email" id="id_4">
        <label class="form-label form-label-top form-label-auto" id="label_4" for="input_4"> Email </label>
        <div id="cid_4" class="form-input-wide">
          <span class="form-sub-label-container" style="vertical-align:top">
            <input type="email" id="input_4" name="q4_email" class="form-textbox validate[Email]" data-defaultvalue="" size="30" value="" data-component="email" aria-labelledby="label_4 sublabel_input_4" />
            <label class="form-sub-label" for="input_4" id="sublabel_input_4" style="min-height:13px" aria-hidden="false"> rubydavila@gmail.com </label>
          </span>
        </div>
      </li>
      <li class="form-line" data-type="control_appointment" id="id_31">
        <label class="form-label form-label-top" id="label_31" for="input_31"> Elige la fecha de vuelo </label>
        <div id="cid_31" class="form-input-wide">
          <div id="input_31" class="appointmentFieldWrapper jfQuestion-fields">
            <input class="appointmentFieldInput " name="q31_eligeLa[date]" id="input_31_date" />
            <input class="appointmentFieldInput" name="q31_eligeLa[duration]" value="60" id="input_31_duration" />
            <input class="appointmentFieldInput" name="q31_eligeLa[timezone]" value="America/Ojinaga (GMT-06:00)" id="input_31_timezone" />
            <div class="appointmentField">
            </div>
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_widget" id="id_35">
        <label class="form-label form-label-top form-label-auto" id="label_35" for="input_35"> Destinario de vuelo </label>
        <div id="cid_35" class="form-input-wide">
          <div data-widget-name="Selector de País" style="width:100%;text-align:Left;overflow-x:auto" data-component="widget-field">
            <iframe data-client-id="52934d4e3be147110a000027" title="Selector de País" frameBorder="0" scrolling="no" allowtransparency="true" allow="geolocation; microphone; camera; autoplay; encrypted-media; fullscreen" data-type="iframe" class="custom-field-frame" id="customFieldFrame_35" src="" style="max-width:365px;border:none;width:100%;height:50px" data-width="365" data-height="50">
            </iframe>
            <div class="widget-inputs-wrapper">
              <input type="hidden" id="input_35" class="form-hidden form-widget  " name="q35_destinarioDe" value="" />
              <input type="hidden" id="widget_settings_35" class="form-hidden form-widget-settings" value="%5B%7B%22name%22%3A%22country%22%2C%22value%22%3A%22Ninguno%22%7D%2C%7B%22name%22%3A%22submit%22%2C%22value%22%3A%22Nombre%20completo%20de%20pa%C3%ADs%22%7D%5D" data-version="2" />
            </div>
            <script type="text/javascript">
            setTimeout(function()
{
  var _cFieldFrame = document.getElementById("customFieldFrame_35");
  if (_cFieldFrame)
  {
    _cFieldFrame.onload = function()
    {
      if (typeof widgetFrameLoaded !== 'undefined')
      {
        widgetFrameLoaded(35, {
          "formID": 213088059517864
        })
      }
    };
    _cFieldFrame.src = "//widgets.jotform.io/pickers/?pickerType=countries&qid=35&ref=" + encodeURIComponent(window.location.protocol + "//" + window.location.host) + '' + '' + '&injectCSS=' + encodeURIComponent(window.location.search.indexOf("ndt=1") > -1);
    _cFieldFrame.addClassName("custom-field-frame-rendered");
  }
}, 0);
            </script>
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_button" id="id_2">
        <div id="cid_2" class="form-input-wide">
          <div style="text-align:center" data-align="center" class="form-buttons-wrapper form-buttons-center   jsTest-button-wrapperField">
            <button id="input_2" type="submit" class="form-submit-button form-submit-button-black_glass submit-button jf-form-buttons jsTest-submitField" data-component="button" data-content="">
              Enviar
            </button>
          </div>
        </div>
      </li>
      <li style="display:none">
        Should be Empty:
        <input type="text" name="website" value="" />
      </li>
    </ul>
  </div>
  <script>
  JotForm.showJotFormPowered = "new_footer";
  </script>
  <script>
  JotForm.poweredByText = "Powered by Jotform";
  </script>
  <input type="hidden" class="simple_spc" id="simple_spc" name="simple_spc" value="213088059517864" />
  <script type="text/javascript">
  var all_spc = document.querySelectorAll("form[id='213088059517864'] .si" + "mple" + "_spc");
for (var i = 0; i < all_spc.length; i++)
{
  all_spc[i].value = "213088059517864-213088059517864";
}
  </script>
  
</form>


<div class="footerr">
     <b>Numero de lista: 8<br>//SUBMODULO 2 Desarrolla aplicaciones Web con conexion a 
        base de datos<br> https://gist.github.com/Rubydavilaavila </b>
   </div>

  <script type="text/javascript">
        //EL MENU AL HACER SCROLL CAMBIA DE COLOR
        window.addEventListener("scroll", function(){
            var header = document.querySelector("header");
            header.classList.toggle("abajo",window.scrollY>0);
        })
    </script>