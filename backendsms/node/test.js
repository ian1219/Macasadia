var fetch = require('node-fetch');

function sendmessagetoresidents(){
	var headers = {
		"content-type": "application/json",
		"Encryption": "XgTeIxQLUiv3lOSl8cXNkt4bxIGFjbzl"
	};

	(async () => {
	  try {

		const response = await fetch('http://127.0.0.1/macasadia/api/uni_handler.php?type=send_water_data&pid=1&level=3&feet=6.0',{ method: 'GET', headers: headers})
		const json = await response.json()

		//console.log(json.url);
		console.log(json);
	  } catch (error) {
		console.log(error.response.body);
	  }
	})();
}
sendmessagetoresidents();