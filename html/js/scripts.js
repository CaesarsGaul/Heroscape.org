var loggedInCookieNames = ["hs_key", "hs_username"];
var cookieNames = ["hs_key", "hs_username"];
const _siteName = "Heroscape.org";

function loggedIn() {
	return cookieExists("hs_key");
}

function redirectToUserPage() {
	window.location.href = "/user?userName="+decodeURIComponent(getCookieValue("hs_username"));
}

const googleAPIsKey = "AIzaSyBFHfaA7c_5YQ5G6GNQWKLAsUxCQOE0FRc";

var _darkMode = false;
window.onload = function () {
	if (getComputedStyle(document.body).backgroundColor != 'rgb(255, 255, 255)') {
		_darkMode = true;
	}
}

function createDate(dateStr) {			
	const parts = dateStr.includes("T")
		? dateStr.split("T")
		: dateStr.split(" ");
	const dateParts = parts[0].split("-");
	
	const year = parseInt(dateParts[0]);
	const monthIndex = parseInt(dateParts[1])-1;
	const day = parseInt(dateParts[2]);
	
	if (parts.length > 1) {
		const timeParts = parts[1].split(":");
		
		const hour = parseInt(timeParts[0]);
		const minute = parseInt(timeParts[1]);
		const second = parseInt(timeParts[2].split("\.")[0]);
	
		return new Date(
			Date.UTC(year, monthIndex, day, 
				hour, minute, second));
	} else {
		return new Date(
			Date.UTC(year, monthIndex, day)
		);
	}
	
	
}

function dateToString(date, utc=true) {
	var year, month, day;
	if (utc) {
		year = date.getUTCFullYear();
		month = date.getUTCMonth() < 9
			? "0"+(date.getUTCMonth()+1)
			: date.getUTCMonth()+1;
		day = date.getUTCDate() <= 9
			? "0"+(date.getUTCDate())
			: date.getUTCDate();
	} else {
		year = date.getFullYear();
		month = date.getMonth() < 9
			? "0"+(date.getMonth()+1)
			: date.getMonth()+1;
		day = date.getDate() <= 9
			? "0"+(date.getDate())
			: date.getDate();
	}
	return year+"-"+month+"-"+day;
}

function datetimeToString(date) {
	const hours = date.getUTCHours() <= 9
		? "0"+date.getUTCHours()
		: date.getUTCHours();
	const minutes = date.getUTCMinutes() <= 9
		? "0"+date.getUTCMinutes()
		: date.getUTCMinutes();
	const seconds = date.getUTCSeconds() <= 9
		? "0"+date.getUTCSeconds()
		: date.getUTCSeconds();
	return dateToString(date) + " " + hours + ":" + minutes + ":" + seconds;
}

function displayTournament(tournament, divId, options=[]) {
	var parentElem = document.getElementById(divId);
						
	var div = createDiv({class: 'tournament'});
	parentElem.appendChild(div);
	
	/*var nameStr = tournament.name;
	if (tournament.convention != null) {
		nameStr += " (" + tournament.convention.name + ")";
	}*/
	
	var link = createA({
		href: "/events/tournament/?Tournament="+tournament.id, 
		innerHTML: tournament.fullDisplayName()});
	
	if (options.includes("showDate")) { // TODO : Put this on a new line 
		link.appendChild(createDiv({
			innerHTML: "(" + dateToString(createDate(tournament.startTime)) + ")"
		}))
	}
	
	
	div.appendChild(link);					
}

function vcInclusive() {
	if (typeof tournament == "object") { // Tournament Builder or Army Submission
		for (let j = 0; j < tournament.tournamentIncludesFigureSetSubGroups.length; j++) {
			const subGroupLink = tournament.tournamentIncludesFigureSetSubGroups[j];
			if (subGroupLink.figureSetSubGroup.name == "VC" && subGroupLink.include) {
				return true;
			}
		}
		return false;
	} else { // Main Builder or PCS Page
		return document.getElementById("VC_checkbox").checked;
	}
}