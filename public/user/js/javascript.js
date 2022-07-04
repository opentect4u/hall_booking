

var roomAdultSelect = document.getElementById("roomAdultSelect");
var hotel_traveller_selection = document.getElementById("hotel_traveller_selection");


roomAdultSelect.onclick = function(){
    
if(hotel_traveller_selection.style.display === "none"){
hotel_traveller_selection.style.display = 'block';
} else {
hotel_traveller_selection.style.display = 'none';
}

}
