$(document).ready(function () {

    $(".Addsched").click(function () {
      const roomId = $(this).data("bg");
      $.ajax({
        url: "../modals/RoomSchedules.php", 
        method: "POST",
        data: { bg: roomId }, 
        success: function (response) {
          $("#modalBody").html(response);
          $("#customModal").fadeIn(); 
        },
        error: function () {
          $("#modalBody").html("<p>Error loading data</p>");
          $("#customModal").fadeIn();
        }
      });
    });
  
    
    $("#closeModal").click(function () {
      $("#customModal").fadeOut();
    });


    $("#timeForm").submit(function (event) {

        const TimeOutValue = $("#timeOut").val();
        const roomId = $(".Addsched").data("bg");

        if (TimeOutValue && roomId) {
            $.ajax({
                url: "../modals/RoomSchedules.php",
                method: "POST",
                data: { 
                    time: TimeOutValue,
                    bg: roomId
                },
                success: function (response) {

                    $("#modalBody").html(response);
                    $("#customModal").fadeIn();
                },
                error: function () {
                    alert("Error submitting the form.");
                }
            });
        } else {
            alert("Error, Please select a time and a room.");
        }
    });
  });