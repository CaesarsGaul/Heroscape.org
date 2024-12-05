function _displayAnnouncementSection() {
	var parentDiv = document.getElementById("Announcement");
	parentDiv.innerHTML = "";
	parentDiv.appendChild(createH4({innerHTML: "Make Announcement"}));
	parentDiv.appendChild(createTextarea({
		id: "announcementTextarea"
	}));
	parentDiv.appendChild(createButton({
		innerHTML: "Announce!",
		type: "button",
		onclick: "_makeAnnouncement()"
	}));
	parentDiv.appendChild(createButton({
		innerHTML: "Clear",
		type: "button",
		onclick: "_clearAnnouncement()"
	}));
}

function _makeAnnouncement() {
	if (confirm("Make Announcement?")) {
		var textarea = document.getElementById("announcementTextarea");
		const announcement = textarea.value; 
		_emitAnnouncement(announcement);
		textarea.value = "";
	}
}

function _clearAnnouncement() {
	if (confirm("Clear?")) {
		document.getElementById("announcementTextarea").value = "";
	}
}