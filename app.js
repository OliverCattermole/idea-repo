var expanded = true;
window.onload = function(){
    if (window.innerWidth < 768) {  collapseall(); }
}
window.onresize = function() {
    if (window.innerWidth < 768) {  collapseall(); }
}
function expand(panelheading){
	var body = panelheading.parentNode.querySelector(".panel-body");
	if (body.classList.contains("hidden")){
		body.classList.remove("hidden");
	}
	else {
		body.classList.add("hidden");
	}
}

function expandcollapseall(){
    if (expanded){ 
        collapseall(); 
    }
    else { 
        expandall(); 
    }
}
function expandall(){
    var bodies = document.getElementsByClassName("panel-body");
    for (var i = bodies.length - 1; i >= 0; i--) {
    		bodies[i].classList.remove("hidden");
    }
    expanded = true;
}
function collapseall(){ 
    var bodies = document.getElementsByClassName("panel-body");
    for (var i = bodies.length - 1; i >= 0; i--) {
    		bodies[i].classList.add("hidden");
    }
    expanded = false;
}

