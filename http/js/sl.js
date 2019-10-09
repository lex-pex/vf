document.ondragstart = prevent;
document.onselectstart = prevent;
// document.oncontextmenu = prevent;
function prevent() {return false;}