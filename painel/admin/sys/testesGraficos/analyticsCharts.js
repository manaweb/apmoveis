function getVisitorChartData(result) {
  var entries = result.feed.getEntries();
  var returningVisitors = [];
  var newVisitors = [];
  var days = [];
  var maxReturningVisitors = 0;
  var maxNewVisitors = 0;

  for (var i = 0, entry; entry = entries[i]; ++i) {
    var visType = entry.getValueOf('ga:visitorType');
    var numVisits = entry.getValueOf('ga:visits');
    var day = parseInt(entry.getValueOf('ga:day'), 10);

    // At the beginning of each day, check if data was missing for previous
    // day.  Insert "0" in appropriate visitor's array as necessary, using
    // fillToSameSize helper method.
    if (!days.length) {
      days.push(day);
    } else {
      var lastDay = days[days.length - 1];
      if (day != lastDay) {
        days.push(day);
        fillToSameSize(newVisitors, returningVisitors);
      }
    }

    if (visType == 'New Visitor') {
      newVisitors.push(numVisits);
      maxNewVisitors = Math.max(maxNewVisitors, numVisits);
    } else {
      returningVisitors.push(numVisits);
      maxReturningVisitors = Math.max(maxReturningVisitors, numVisits);
    }
  }
  fillToSameSize(newVisitors, returningVisitors);

  return {
    'returningVisitors': returningVisitors,
    'newVisitors': newVisitors,
    'maxNewVisitors': maxNewVisitors,
    'maxReturningVisitors': maxReturningVisitors,
    'days': days
  };
}

function fillToSameSize(firstArray, secondArray) {
  if (firstArray.length < secondArray.length) {
    firstArray.push(fillValue);
  } else if (secondArray.length < firstArray.length) {
    secondArray.push(fillValue);
  }
}


function getChartObj() {
  var params_ = {
    'chs': '', // Image Dimensions
    'chtt': '', // Title
    'chxt': '', // Axes
    'chts': '', // Title Style
    'cht': '', // Chart type
    'chd': '', // Data
    'chdl': '', // Legend
    'chco': '', // Colors
    'chbh': '', // Width and spacing
    'chxl': '', // Axis Labels
    'chds': '', // Scaling
    'chxr': '', // Axis Scaling
    'chm': ''   // Chart Markers
  };
  var baseURL_ = 'https://chart.googleapis.com/chart';

  function getParams_() {
    return params_;
  }

  function getParam_(key) {
    return params_[key];
  }

  function setParam_(key, val) {
    if (params_[key] !== undefined) {
      params_[key] = val;
    }
  }

  function setParams_(obj) {
    for (key in obj) {
      setParam_(key, obj[key]);
    }
  }

  /**
   * Given a base URL and an array of parameters, construct the complete URL.
   * @return {string} The complete URL for the chart.
  */
  function getURL_() {
    paramArray = [];
    for (key in params_) {
      if (params_[key]) {
        pairStr = [key, params_[key]].join('=');
        paramArray.push(pairStr);
      }
    }
    paramStr = paramArray.join('&');
    url = [baseURL_, paramStr].join('?');
    return url;
  }

  return {
    'getParam': getParam_,
    'getParams': getParams_,
    'setParam': setParam_,
    'setParams': setParams_,
    'getURL': getURL_
  };
}


function getBarChart(chartData) {

  var chart = getChartObj();
  var returningVisitorsStr = chartData.returningVisitors.join();
  var newVisitorsStr = chartData.newVisitors.join();
  var maxValue = chartData.maxReturningVisitors + chartData.maxNewVisitors;

  scaleData = getScaleData(maxValue);

  // Set chart meta-data
  chart.setParams({
    'chs': '500x150', //Image dimensions
    'chxt': 'x,y', //Axes
    'chts': '000000,15', //Title Style
    'cht': 'bvs', //Chart Type (Bar, Vertical, Stacked)
    'chco': 'a3d5f7,389ced', //Colors
    'chbh': 'a,5,20', //Width & Spacing
    'chm': 'N,FF0000,-1,,12', //Markers
    'chtt': 'Visitors+By+Type', //Title
    'chdl': 'Returning+Visitors|New+Visitors', //Legend
    'chd': 't:' + returningVisitorsStr + '|' + newVisitorsStr, //Chart Data
    'chxl': '0:|' + chartData.days.join('|'), //Axis Labels
    'chds': '0,' + scaleData[0], //Scaling
    'chxr': '1,0,' + scaleData[0] + ',' + scaleData[1] //Axis Scaling
  });

  return chart;
}


function getScaleData(currMax) {
  var result = [0, 0];
  // Determine order of magnitude (number of digits left of decimal).
  var magnitude = Math.log(currMax) / Math.LN10;
  magnitude = Math.ceil(magnitude);

  var newMax = Math.pow(10, magnitude);
  if (newMax / 5 > currMax) {
    newMax = newMax / 5;
  }
  while (newMax > (currMax * 2)) {
    newMax = newMax / 2;
  }

  var step = newMax / 5;
  result[0] = newMax;
  result[1] = step;
  return result;
}

function getPieChart(chartData) {
  var chart = getChartObj();
  var newVisitors = getArraySum(chartData.newVisitors);
  var returningVisitors = getArraySum(chartData.returningVisitors);

  chartData.maxValue = returningVisitors + newVisitors;

  chart.setParams({
    'chs': '500x150', //Image dimensions
    'chts': '000000,15', //Title Style
    'cht': 'p3', //Chart Type
    'chco': 'a3d5f7,389ced', //Colors
    'chtt': 'Visitors+By+Type', //Title
    'chdl': 'Returning+Visitors|New+Visitors', //Legend
    'chd': 't:' + returningVisitors + ',' + newVisitors, //Chart Data
    'chl': returningVisitors + '|' + newVisitors, //Labels
    'chds': '0,' + chartData.maxValue //Max Value
  });

  return chart;
}

//Helper method to get the sum of values in an array.
function getArraySum(input) {
  var total = 0;
  for (var i = 0; i < input.length; i++) {
    total += input[i];
  }
  return total;
}

function getURL_() {
    paramArray = [];
    for (key in params_) {
      if (params_[key]) {
        pairStr = [key, params_[key]].join('=');
        paramArray.push(pairStr);
      }
    }
    paramStr = paramArray.join('&');
    url = [baseURL_, paramStr].join('?');
    return url;
  }
  
function drawChart(parentElementId, url) {
  document.getElementById(parentElementId).innerHTML +=
      '<img src="' + url + '" /></br />';
}

