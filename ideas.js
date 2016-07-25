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

var expanded = true;
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


function selectallornone(elem){
    var boxes = elem.parentElement.querySelectorAll("input");
    var checked = true;
    var i=0;
    //if we find and unchecked box, set checked to false and exit the loop
    while(checked && i<boxes.length){
        if(!boxes[i].checked){ checked=false; }
        i++;
    }
    //if all the boxes are checked, uncheck them
    if(checked){
        for(var i=0; i<boxes.length; i++){
            boxes[i].checked = false;
        }
    }
    else{
        for(var i=0; i<boxes.length; i++){
            boxes[i].checked = true;
        }
    }
}
