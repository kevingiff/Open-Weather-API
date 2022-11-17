window.onload = function() {
  if (window.scrollTop!=0) {
    window.scrollTo(0,1);
  }
  loadDBWeather();
}

function id (el) {
  return document.getElementById(el);
}

function toggleDropdown(el){
  id(el).classList.toggle('hidden');
}

function setUTCtoLocalTimeStamp(str){
  //returns a local datetime string

  //create date in UTC
  var split = str.split(' ');
  var newStr = split[0]+"T"+split[1];
  var fd = new Date(newStr+'Z');

  // console.log(fd);
  return fd;
}

function getAsyncData(ajaxurl) { 
  return new Promise(function(resolve, reject) {
      $.ajax({
          url: ajaxurl,
          type: "GET",
          contentType: false,
          processData: false,
          beforeSend: function() {            
          },
          success: function(data) {  
              resolve(data) // Resolve promise and when success
          },
          error: function(err) {
              reject("Error retrieving data from server"+err) // Reject the promise and go to catch()
          }
      });
    });
}

function newTableRow(){

    //create a <tr> element
    var row = document.createElement('tr');

    //style the element
    row.className="border-b transition duration-300 ease-in-out hover:bg-gray-200 font-light whitespace-nowrap text-gray-900";

    //fill the innerHTML with blank columns
    row.innerHTML='<td class="px-6 py-4">°F</td><td class="text-center px-16 py-4"></td>';

    //return the element
    return row;
}

function loadDBWeather(){
  //find the DOM target
  var target = document.body.getElementsByTagName('tbody')[0];
  //remove blank row
  var trs = target.getElementsByTagName('tr');
  trs[0].remove();

  var city = id('currentCity').innerHTML;

  //call db api once to get all records, and add them to the DOM
    getAsyncData('api/getDBWeatherData.inc.php?city='+city).then(function(data) {

    //parse data
      var parsedData = JSON.parse(data);
      var records = parsedData['records'];
      var recordsCheck = records.length;

    //present data

      if (recordsCheck>0) {

        //update the nav bar stats
        var currentCity = parsedData['records'][recordsCheck-1]['city'];
        id('currentCity').innerHTML=currentCity;
        var latestTemp = parsedData['records'][recordsCheck-1]['temperature'];
        id('latestTemp').innerHTML=latestTemp+" °F";
        var latestTime = parsedData['records'][recordsCheck-1]['time_stamp'];
        id('latestTime').innerHTML=latestTime;

        //for each records in db, add a table row
        for (var i = 0; i < recordsCheck; i++) {

          //temperature
          var temp = parsedData['records'][i]['temperature'];
          //timezone offset
          var offset = parsedData['records'][i]['timezone'];
          //timestamp
          var time = parsedData['records'][i]['time_stamp'];
            //convert to local
            var localTime = setUTCtoLocalTimeStamp(time);
            var split = String(localTime).split(" (");
            localTime = split[0]; 

          //create a new row
          var newRow = newTableRow();

          //style the new row if current row count is even
          if ((i % 2) != 0) {
            //even number of rows, add darker color to new row
            newRow.classList.add('bg-gray-100');
          }

          //fill in new data
          if ((temp && time) != null) {
              //there is data, add it to table and nav bar
              var cells = newRow.getElementsByTagName('td');
              //temperature
              cells[0].innerHTML=temp+" °F";
              //timestamp
              cells[1].innerHTML=localTime;
              
          }else{
            //add error message, b/c no data from api return
            console.log('Error reading data record from api call');
          }

          //prepend new row to table
          target.prepend(newRow);

        }

      }

  });
}
function getWeather(){
    //call weather api once, store in db, and append new record to DOM
    getAsyncData('api/getOpenWeatherData.inc.php').then(function(data) {

    //parse data
      var parsedData = JSON.parse(data);
      //temperature
      var temp = parsedData['temperature'];
      //timezone offset
      var offset = parsedData['timezone'];
      //timestamp
      var time = parsedData['time_stamp'];

      //QC test
      // console.log(city);
      // console.log(temp);
      // console.log(time);

    //present data

        //find the DOM target
        var target = document.body.getElementsByTagName('tbody')[0];
        //get current count of rows
        var count = target.getElementsByTagName('tr').length;
        //create a new row
        var newRow = newTableRow();
        //style the new row if current row count is even
        if ((count % 2) == 0) {
            //even number of rows, add darker color to new row
            newRow.classList.add('bg-gray-100');
        }
        //append new row to DOM target
        target.prepend(newRow);

        //fill in new data
        if ((temp && time) != null) {
            //there is data, add it to table and nav bar
            var cells = newRow.getElementsByTagName('td');
            //temperature
            cells[0].innerHTML=temp+" °F";
            //timestamp
            cells[1].innerHTML=time;

            id('latestTemp').innerHTML=temp+" °F";
            id('latestTime').innerHTML=time;
            
        }else{
          //add error message, b/c no data from api return
          console.log('Error reading data from api call');
        }
  });
}
