$(document).ready(function () {

  $(".dp-btn").click(function () {
    const bgId = $(this).data("bg");
    $.ajax({
      url: "../modals/roomTesting.php", 
      method: "GET",
      data: { bg: bgId }, 
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

  $(".check-room").click(function () {
    const dataId = $(this).data('id');
    window.location.href = `../main/useRoom.php?id=${dataId}`;
  });

});