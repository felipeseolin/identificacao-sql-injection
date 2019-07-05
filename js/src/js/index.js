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
        // let xhr = new XMLHttpRequest();
        // xhr.onreadystatechange = function () {
        //     if (this.readyState === 4 && this.status === 200) {
        //         let response = JSON.parse(this.responseText);
        //         renderPosts(response);
        //     }
        // }
        // xhr.open("GET", "https://cors-anywhere.herokuapp.com/"+ website);
        // xhr.setRequestHeader("Accept", 'application/json');
        // xhr.send();
        $.ajax({
            method: "GET",
            cache: false,
            crossDomain: true,
            xhrFields: {
                withCredentials: true
            },
            url: website,
            data: 'json',
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