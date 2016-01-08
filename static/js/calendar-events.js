
var update_calendar = function() {

  var d = new Date();
  var year = d.getUTCFullYear();
  var month = d.getUTCMonth() + 1;
  var day = d.getUTCDate();
  var dateString = year + "-" + month+"-"+day+"T0:00:00Z";
  var cal_URL = "https://www.googleapis.com/calendar/v3/calendars/csescholarsum@gmail.com/events?orderBy=startTime&singleEvents=true&maxResults=15&timeMin="+dateString+"&key=AIzaSyAMdAKe1QdTiRUpW8oLZAfkLTGzz3NhUfM";

  console.log(cal_URL);


  $.ajax({
     type: "GET",
     dataType: "json",
     url: cal_URL,
    //  data: getOptions,
     cache: false,
     success: function (data,textStatus) {
      var items = data["items"]
        for(var i = 0; i < items.length; i++){
          var to_add = document.createElement("div");
          var title = document.createElement("h3");

          //Get event title
          title.innerHTML =  items[i]["summary"];
          to_add.appendChild(title);

          var datetime = document.createElement("h4");
          
          var startTime = items[i]["start"]["dateTime"];
          var endTime = items[i]["end"]["dateTime"];
          var date = startTime.substr(0,10);
          startTime = dateTimeParse(startTime);
          endTime = dateTimeParse(endTime);
          date = datePretty(date);
          var totalDateString = date + " " + startTime + " to " + endTime;          
          datetime.innerHTML = totalDateString;
          
          to_add.appendChild(datetime);

          var location = document.createElement("h4");

          location.innerHTML = items[i]["location"];
          to_add.appendChild(location);

          var desc = document.createElement("p");
          desc.innerHTML = items[i]["description"];
          to_add.appendChild(desc);

          console.log($('#cal'));
          $('#cal').append(to_add);

        }
     },
     error: function(e,f,g) {}
  });


};

//returns pretty time in the format of t:tt AM/PM
var dateTimeParse = function(dateTimeStr){

  var time = dateTimeStr.substr(11).substr(0,5);
  var hours = parseInt(time.substr(0,2));
  if(hours > 12){
    return (hours - 12) + time.substr(2) + " PM";
  }
  return time + " AM"
};

//turns year-month-day into day/month
var datePretty = function(dateStr){
  return dateStr.substr(5).replace("-", "/")


};

update_calendar();
