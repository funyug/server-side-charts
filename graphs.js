if(typeof require !== 'undefined') XLSX = require('xlsx');
var workbook = XLSX.readFile('abc.xlsx');
var webshot = require('webshot');
var options = {
   shotSize: {
    width: 500
  , height: 500
  }
, userAgent: 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_2 like Mac OS X; en-us)'
    + ' AppleWebKit/531.21.20 (KHTML, like Gecko) Mobile/7B298g'
};

var worksheet = workbook.Sheets['weekly_kpis'];
var vendors=[];
for (z in worksheet) {
    /* all keys that do not begin with "!" correspond to cell addresses */
    if(z[0] === '!') continue;
    if(z=z.match(/C[0-9]/g))
    {
      if(worksheet[z].v!='vendor id') {
        vendors[worksheet[z].v]=1;
      }
    }
  }
  var now=new Date();
  for(var prop in vendors) {
      if(vendors.hasOwnProperty(prop)){
          vendorid=prop;
          webshot('localhost/charts/response.php?vendor='+vendorid, 'images/'+vendorid+'_response.png', options, function(err) {
            // screenshot now saved to hello_world.png
          });
          webshot('localhost/charts/rejection.php?vendor='+vendorid, 'images/'+vendorid+'_rejection.png', options, function(err) {
            // screenshot now saved to hello_world.png
          });
          webshot('localhost/charts/orders.php?vendor='+vendorid, 'images/'+vendorid+'_orders.png', options, function(err) {
            // screenshot now saved to hello_world.png
          });
          webshot('localhost/charts/cancelchart.php?vendor='+vendorid, 'images/'+vendorid+'_cancel.png', options, function(err) {
            // screenshot now saved to hello_world.png
          });

      }
  }
