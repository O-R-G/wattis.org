// implement infinite scrolling via ajax
var isWaiting = false;

function loadMore(fetched_ids_arr = []) {
	isWaiting = true;
	if(window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() 
	{
		if(xmlhttp.readyState < 4) 
		{
			// start loading animation
			// startLoad();
			console.log("waiting");
		}
		else if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		{
			// stop loading animation
			// stopLoad();
			if(xmlhttp.responseText)
			{
				// console.log('xmlhttp.responseText = '+xmlhttp.responseText);
				var response = JSON.parse(xmlhttp.responseText);
				if(response.length != 0)
				{
					console.log(response);
					document.querySelector(".homeContainer").innerHTML += response['this_html'];
					return response['current_fetched_ids_arr'];
				}
				else
					isFullyLoaded = true;
				isWaiting = false;
			}
			else
			{
				// no more posts to load
				// 'done' animation
				// animate(68);
			}
		}
	}
	var fetched_ids_arr_str = '[' + fetched_ids_arr.join(',') + ']';

	var requestUrl = "views/random-ajax.php";
	/*
    if(isRandom)
		requestUrl += "?random";
    */

	xmlhttp.open("POST", requestUrl, true);
    // throws an error .local
	// xmlhttp.setRequestHeader( "Content-Type", "application/json" );
	xmlhttp.send(fetched_ids_arr_str);
}
