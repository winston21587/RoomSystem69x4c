$(document).ready(function () {

  $(".dp-btn").click(function () {
    const bgId = $(this).data("bg");
    $.ajax({
      url: "../modals/roomTesting.php", // PHP file that generates modal content
      method: "GET",
      data: { bg: bgId }, // Pass user ID to the server
      success: function (response) {
        $("#modalBody").html(response); // Insert the response into the modal
        $("#customModal").fadeIn(); // Show the modal
      },
      error: function () {
        $("#modalBody").html("<p>Error loading data</p>");
        $("#customModal").fadeIn();
      }
    });
  });

  // Close the modal
  $("#closeModal").click(function () {
    $("#customModal").fadeOut();
  });

  $(".check-room").click(function () {
    const dataId = $(this).data('id');
    window.location.href = `../main/useRoom.php?id=${dataId}`;
  });

});