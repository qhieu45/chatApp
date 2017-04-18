$("#otherUsers").on("click", "li", function () {
	$(this).attr("selected", "selected");
	$(this).siblings().removeAttr("selected");
	$(this).parent().attr("value", $(this).find('input[type="hidden"]').val());
	loadMessage($('#otherUsers').attr("value"));
})

function searchMessage(value) {
	return new Promise((resolve, reject) => {
		if (value == undefined) {
			document.getElementById("chatlog").innerHTML = "";
			resolve();
		}
		var url;
		url = "../inc/chat_backend.php?q=" + value;
		$.ajax({
			type: "GET",
			url: url,
			success: (data) => {
				resolve(JSON.parse(data));
			},
			error: (err) => {
				reject(Error('Message didn\'t load successfully; error code:' + err));
			}
		});
	})
}

function loadMessage(value) {
	var container = document.getElementById("chatlog");
	var ul = document.createElement("ul");
	while (container.firstChild) {
		container.removeChild(container.firstChild);
	}
	searchMessage(value).then((data) => {
		if (!data) return;
		data.forEach(message => {
			var li = document.createElement("li");
			var img = document.createElement("img");
			img.setAttribute("src", "http://hidrusmx.com/wp-content/uploads/2016/06/photo.gif");
			img.setAttribute("alt", "profile picture");
			var div = document.createElement("div");
			div.className = "message";
			div.innerText = `${message.chatMessage}`;
			li.appendChild(img);
			li.appendChild(div);
			ul.appendChild(li);
		});
	}).catch(function (err) {
		console.error('Augh, there was an error!', err);
	});
	container.appendChild(ul);
}