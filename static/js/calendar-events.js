
var update_calendar = function() {

  var d = new Date();
  var year = d.getUTCFullYear();
  var month = d.getUTCMonth() + 1;
  var day = d.getUTCDate();
  var dateString = year+"-"month+"-"+day+"T0:00:00Z"
  var cal_URL = "https://www.googleapis.com/calendar/v3/calendars/csescholarsum@gmail.com/events?maxResults=15&timeMin="+dateString+"&key=AIzaSyAMdAKe1QdTiRUpW8oLZAfkLTGzz3NhUfM"


  $.ajax({
     type: "GET",
     dataType: "json",
     url: cal_URL,
     data: getOptions,
     cache: false,
     success: function (data,textStatus) {
        console.log(data);
     },
     error: function(e,f,g) {}
  });


};

update_calendar()
