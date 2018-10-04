function hideShow() {
    var x = document.getElementById("hide");
    if (x.style.display === "none") {
        x.style.display = "block";
        $("i").removeClass('glyphicon glyphicon-chevron-down').addClass('glyphicon glyphicon-chevron-up');
    } else {
        x.style.display = "none";
        $("i").removeClass('glyphicon glyphicon-chevron-up').addClass('glyphicon glyphicon-chevron-down');
    }
}

jQuery(document).ready(function($){
    $("#company").select2({
    placeholder: "Entreprise(s) désirée(s) ..."
});

$("#localisation").select2({
    placeholder: "Localisation(s) désirée(s) ..."
})

$("#technology").select2({
    placeholder: "Technologie(s) utilisée(s) ..."
})

$("#promotion").select2({
    placeholder: "Année(s) du stage ..."
})
})


