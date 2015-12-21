
var update_calendar = function() {

  var d = new Date();
  var year = d.getUTCFullYear();
  var month = d.getUTCMonth() + 1;
  var day = d.getUTCDate();
  var dateString = year + "-" + month+"-"+day+"T0:00:00Z";
  var cal_URL = "https://www.googleapis.com/calendar/v3/calendars/csescholarsum@gmail.com/events?maxResults=15&timeMin="+dateString+"&key=AIzaSyAMdAKe1QdTiRUpW8oLZAfkLTGzz3NhUfM";


  $.ajax({
     type: "GET",
     dataType: "json",
     url: cal_URL,
    //  data: getOptions,
     cache: false,
     success: function (data,textStatus) {
        for(var i = 0; i < data["items"].length; i++){
          var to_add = document.createElement("div");
          var title = document.createElement("h3");

          title.innerHTML =  data["items"][i]["summary"] ;
          to_add.appendChild(title);

          var datetime = document.createElement("h3");
          var location = document.createElement("h3");
          var desc = document.createElement("p");

          console.log($('#cal'));
          $('#cal').append(to_add);

        }
     },
     error: function(e,f,g) {}
  });


};

update_calendar();
