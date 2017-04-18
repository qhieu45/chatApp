function searchUser() {
    return new Promise((resolve, reject) => {
        var url;
        url = "../inc/load_users.php";
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
    }

    )
}

function loadUser() {
    var container = document.getElementById("otherUsers");
    while (container.firstChild) {
		container.removeChild(container.firstChild);
	}
    searchUser().then((data) => {
        if (!data) return;
        data.forEach(user => {
            var li = document.createElement("li");
            var a = document.createElement("a");
            a.setAttribute("href", "#");
            a.className = "inner";
            var imgDiv = document.createElement("div");
            imgDiv.className = "li-img";
            var img = document.createElement("img");
            img.setAttribute("src", "http://hidrusmx.com/wp-content/uploads/2016/06/photo.gif");
            img.setAttribute("alt", "profile picture");
            imgDiv.appendChild(img);
            var textDiv = document.createElement("div");
            textDiv.className = "li-text";
            var h4 = document.createElement("h4");
            h4.className = "li-head";
            h4.innerHTML = `${user.username}`;
            var input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("value", `${user.userId}`);
            var p = document.createElement("p");
            p.className = "li-sub";
            p.innerHTML = `${user.lastMessage}`;
            h4.appendChild(input);
            textDiv.appendChild(h4);
            textDiv.appendChild(p);
            a.appendChild(imgDiv);
            a.appendChild(textDiv);
            li.appendChild(a);
            container.appendChild(li);
        });
    }).catch(function (err) {
        console.error('Augh, there was an error!', err);
    });
}