var checkConfirm = function () {
    var pI = $("#password-input");
    var cI = $("#confirm-input");
    if(pI.val() == cI.val()){
        cI.css("border","1px solid green");
    }
    else {
        cI.css("border","1px solid red");
    }
};

var checkPassword = function () {
    var pI = $("#password-input");
    if(pI.val().length < 4){
        pI.css("border","1px solid red");
    }
    else {
        pI.css("border","1px solid green");
    }
};