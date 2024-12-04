$(document).ready(function () {

    
    $('#departmentSelect').on('change', function(e) {
        // console.log('Click event triggered');
        const deptSelect = $(this).val();
        console.log(deptSelect);
        displayRoomTable(deptSelect);
        e.preventDefault();
        
    });

    function displayRoomTable(deptSelect){
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
    };
        

    $('.DeleteRoom').on('click', function() {
        const btnID = $(this).data('id');

        $.ajax({
            url: '../modals/Admin.delete.html',
            method: 'GET', 
            success: function (response) {
                $(".ModalManageBody").html(response);
                $(".ManageModal").fadeIn(); 
                $('#deleteTrue').on('click', function(){
                    console.log('button deleted' + btnID);
                    $.ajax({
                        url: '../Func/deleteRoom.php',
                        method: 'GET', 
                        data: { id: btnID },
                        success: function (response) {
                            $(".ManageModal").fadeOut();
                            window.location.href = window.location.href;

                          },
                          error: function () {
                            $(".ModalManageBody").html("<p>Error deleting data</p>");
                          }
                    });
                });
                $('#deleteFalse').on('click', function(){
                    console.log('button not deleted');
                    window.location.href = window.location.href;
                });
              },
              error: function () {
                $(".ModalManageBody").html("<p>Error loading data</p>");
                $(".ManageModal").fadeIn();
              }
        });
    });



    $('.EditRoom').on('click', function() {
        const RoomID = $(this).data('id');
        const room = $(this).data('room');
        const dept = $(this).data('dept');
        $.ajax({
            url: '../modals/Admin.edit.php',
            method: 'GET', 
            data: { id: RoomID,
                roomname : room ,
                department : dept},
                success: function (response) {
                    $(".ModalManageBody").html(response);
                    $(".ManageModal").fadeIn(); 
                    // const dept = 'bruh';
                    //console.log(nameval);
                    $('form').on('submit', function(){
                        const room = $('#nameEdit').val();
                        // const status = $('#statusEdit').val();
                        const dept = $('#deptEdit').val();
                        $.ajax({
                            url: '../Func/editRoom.php',
                            method: 'GET', 
                            data: { id: RoomID,
                                roomname : room ,
                                department : dept},
                            success: function (response) {
                            $(".ManageModal").fadeOut();
                            window.location.href = window.location.href;

                        },
                            error: function () {
                            $(".ModalManageBody").html("<p>Error updating the data</p>");
                      }
                    });
                });
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

    $('.checkSched').on('click', function() {
        const RoomID = $(this).data('id');
        // schedForRoom
        $.ajax({
            url: '../tables/sched.table.php',
            method: 'GET', 
            data: { id: RoomID },   
            success: function (response) {
                $('#schedForRoom').html(response);
            },
            error: function (xhr, status, error) {
              
                console.error('Error:', error);
                $('#RoomForDept').html('<p>Failed to load table. Please try again.</p>');
            }
        });
        $('#schedInsert').on('click', function(){
            $.ajax({
                url: '../modals/Admin.sched.php',
                method: 'GET', 
                success: function (response) {
                    $(".ModalManageBody").html(response);
                    $(".ManageModal").fadeIn(); 
                }
            });
        });
    });
});