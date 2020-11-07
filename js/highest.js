
window.onload = function () {
    buttonListener();
};

function buttonListener() {
var submitBtnListener = document.getElementById("searchHighest");

submitBtnListener.addEventListener("click", validateForm);
}
    
function validateForm(event1) {
    event1.preventDefault();
    var psle = $("#psleScore").val();
    var submit = $("#searchHighest").val();
    
    
    $("#form-table").load("process_highest.php", {
        psleScore: psle,
        searchSubmit: submit
    });
}


//    $(document).ready(function() {
//        $("form").submit(function(event){
//            event.preventDefault();
//            var psle = $("#psleScore").val();
//            var submit = $("#searchSubmit").val();
//            $(".form-table").load("test.php", {
//                psleScore: psle,
//                searchSubmit: submit
//            });
//        });  
//    });


