$(document).ready(function () {

    $(".addRoomBtn").click(function () {

        $.ajax({
          url: "../modals/Admin.add.php", 
          method: "GET", 
          success: function (response) {
            $("#modalBodyAdmin").html(response);
            $("#customModalAdmin").fadeIn(); 
          },
          error: function () {
            $("#modalBodyAdmin").html("<p>Error loading data</p>");
            $("#customModalAdmin").fadeIn();
          }
        });
      });
    
      
      $("#closeModal").click(function () {
        $("#customModal").fadeOut();
      });
    




});