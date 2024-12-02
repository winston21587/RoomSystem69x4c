$(document).ready(function () {

    $('#departmentSelect').on('change', function() {
        // console.log('Click event triggered');
        const deptSelect = $(this).val();
        
            $.ajax({
                url: '../tables/Admin.ShowRooms.php',
                method: 'GET', 
                data: { dept: deptSelect },
                success: function (response) {
                   
                    $('#RoomForDept').html(response);
                },
                error: function (xhr, status, error) {
                  
                    console.error('Error:', error);
                    $('#RoomForDept').html('<p>Failed to load table. Please try again.</p>');
                }
            });
        
    });
        
    $('.EditRoom').on('click', function() {
        const RoomID = $(this).data('id');
        const room = $(this).data('room');
        const dept = $(this).data('dept');
        const status = $(this).data('status');

        $.ajax({
            url: '../modals/Admin.edit.php',
            method: 'GET', 
            data: { id: RoomID,
                    roomname : room ,
                    department : dept,
                    status : status
             },
            success: function (response) {
                $(".ModalManageBody").html(response);
                $(".ManageModal").fadeIn(); 
              },
              error: function () {
                $(".ModalManageBody").html("<p>Error loading data</p>");
                $(".ManageModal").fadeIn();
              }
        });
    });

    $('.DeleteRoom').on('click', function() {
        const RoomID = $(this).data('id');
        const room = $(this).data('room');
        const dept = $(this).data('dept');
        const status = $(this).data('status');

        $.ajax({
            url: '../modals/Admin.delete.php',
            method: 'GET', 
            data: { id: RoomID,
                    roomname : room ,
                    department : dept,
                    status : status
             },
            success: function (response) {
                $(".ModalManageBody").html(response);
                $(".ManageModal").fadeIn(); 
              },
              error: function () {
                $(".ModalManageBody").html("<p>Error loading data</p>");
                $(".ManageModal").fadeIn();
              }
        });
    });


        $(".closeRoomManage").on('click',function() {
            $(".ManageModal").fadeOut();
          });
});