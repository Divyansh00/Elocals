//executes when submit button clicked in index.php
$("button#submit").click(function() {
    //check whether mobile number is entered or not, if not display error message
    if ($("#mobile").val() == "")
        $("div#ack").html("Please enter the mobile number");
    else{

        $.post($("#myForm").attr("action"), //send post request to the value defined in the action attribute
            $("#myForm").serialize(), //send the data to the server as string
            function(data) { 
                $("div#ack").html(data); //display the response from the server

                if (/\bCashback\b/i.test(data)) { //if the user exists and the response contains 'Cashback' word in it
                    //show the share menu and change the backgound image
                    $("div#share").show();
                    $("div#tweet").load('index.php #tweet');
                    $("div#tweet").show();
                    $("div#bg").load('index.php #bg');
                    $("#bg").css("background-image", "url('images/invite.png')");
                }
                else
                {   //hide the share menu
                    $("div#share").hide();
                    $("div#tweet").hide();
                    $("div#bg").load('index.php #bg');
                    $("#bg").css("background-image", "url('images/elocal_new.jpg')");
                }

            });
        }   

    $("#myForm").submit(function() { 
        return false;  //do not redirect the page when submit is clicked
    });
});

//executes when login button clicked on  login.php
$("button#logmein").click(function() {

    //check if both fields are entered, else display error message
    if ($("#mobile").val() == "" || $("#password").val() == ""){
        $("div#ack").html("Please enter both mobile number and password");
        noRedirect();
    }
    else{
        $.post($("#login").attr("action"),//send post request to the value defined in the action attribute
            $("#login").serializeArray(),//send the data to the server as string
            function(data) {
                $("div#ack").html(data);//display the response from the server

                if(data != 'Incorrect Mobile-no or Password')//checks the reponse of the server
                    window.location = "index.php";   //redirects to main page after successful login
            });
        return false;
    }

    function noRedirect(){
    $("#login").submit(function(event) {
        event.preventDefault(); //prevents the default action of redirecting the page, when submit button is clicked
    });
}
    
});