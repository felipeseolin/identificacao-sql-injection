$(document).ready(function () {

    addbuttonListener();

    function addbuttonListener() {
        $mainBtn = $("#main-btn");

        $mainBtn.click(function () {
            const $siteInput = $("#input-website");
            const website = $siteInput.val();
            if (website) {
                ajaxGet(website);
            } else {
                alert("Deve ser digitado uma URL no campo abaixo");
            }
        });
    }

    function ajaxGet(website) {
        $.ajax({
            method: "GET",
            cache: false,
            url: website,
            success: function (result) {
                successResponseGet(result);
            },
            error: function (error) {
                errorResponseGet(error);
            },
        });
    }

    function ajaxPost() {

    }

    function errorResponseGet(error) {
        $("#resultado h2").show();
        $("#resultado #error").show();
        alert("Ocorreu um erro, não foi possível testar para este website.");
    }

    function successResponseGet(result) {
        const forms = $(result).find("form");
        const inputs = $(result).find("input");
        const buttons = $(result).find("input");

        console.log(form);
        $("#resultado h2").show();
        const $alert = $("#resultado #success");
        $alert.show();
    }
    
    function clearFields() {

    }

});