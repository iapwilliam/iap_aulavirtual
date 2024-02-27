let eChangeAvatar = document.getElementById('changeAvatar');
eChangeAvatar.addEventListener('click', function () {
	console.log("cambiando imagen...");
	var url = WEB_ROOT + "/ajax/new/student.php";
	var data = { opcion: "change-avatar" };

	fetch(url, {
		method: "POST",
		body: JSON.stringify(data),
		headers: {
			"Content-Type": "application/json",
		},
	}).then((res) => res.json())
		.catch((error) => console.error("Error:", error))
		.then((response) => {
			$(".modal-dialog").css({ "max-width": "600px" });
			$("#ajax").modal();
			$("#ajax .modal-content").html(response.html);
		});
});