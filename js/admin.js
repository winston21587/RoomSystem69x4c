$(document).ready(function () {

    
    // $('#departmentSelect').on('change', function(e) {
    //     // console.log('Click event triggered');
    //     const deptSelect = $(this).val();
    //     console.log(deptSelect);
    //     displayRoomTable(deptSelect);
    //     e.preventDefault();
        
    // });

    // function displayRoomTable(deptSelect){
    //     $.ajax({
    //         url: '../tables/Admin.ShowRooms.php',
    //         method: 'GET', 
    //         data: { dept: deptSelect },
    //         success: function (response) {
    //             $('#RoomForDept').html(response);
    //         },
    //         error: function (xhr, status, error) {
              
    //             console.error('Error:', error);
    //             $('#RoomForDept').html('<p>Failed to load table. Please try again.</p>');
    //         }
    //     });
    // };
        

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
        // console.log("ASs");
        // window.location.href = window.location.href;
        const RoomID = $(this).data('id');
        const NameOfRoom = $(this).data('name');
        $('.ScheduleText').html(" Schedules for " + NameOfRoom);
        
        $.ajax({
            url: '../tables/sched.table.php',
            method: 'GET', 
            data: { id: RoomID},   
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
                data: { id: RoomID,
                    name: NameOfRoom
                 },
                success: function (response) {
                    $(".ModalManageBody").html(response);
                    $(".ManageModal").fadeIn(); 
                }
            });
        });
    });

    $('.RoomTable').DataTable({
        paging: true,
        searching: true,
        lengthMenu: [5, 10, 25, 50],
        stateSave: true,
        "bDestroy": true
    });

    $('.FacultyDepartment').on("change", function (){
        const selectedValue = $(this).val();
        console.log("value: " + selectedValue);
        $.ajax({
            url: '../tables/ShowRooms.php',
            method: 'GET',
            data: { id: selectedValue
             },
            success: function (response) {
                $(".RoomDept").html(response);
                
                $('.RoomDepartSelected').on("change", function (){
                    const RoomID = $(this).val();
                    // console.log(RoomID + " = roomid");
                    $.ajax({
                        url: '../tables/sched.faculty.php',
                        method: 'GET', 
                        data: { id: RoomID },
                        success: function (response) {
                            $("#schedForRoom").html(response);
                            $('.requestBTN').on('click', function (){
                                const sender = $(this).data('name');
                                const SchedID = $(this).data('id');
                                $.ajax({
                                    url: '../modals/requestComfirmation.php',
                                    method: 'GET', 
                                    data: { dept: selectedValue },
                                    success: function (response){
                                        $(".ModalManageBody").html(response);
                                        $(".ManageModal").fadeIn(); 
                                        $('#facultyName').on('change', function (){
                                            const facultyID = $(this).val();
                                            console.log("dacul idi is: " + facultyID);
                                        
                                        $('#RequestAproved').on("click", function (){
                                            // alert("request Sent");

                                                        $.ajax({
                                                            url: '../Func/requestSender.php',
                                                            method: 'GET',
                                                            data: { facultyID: facultyID,
                                                                    sender : sender,
                                                                    SchedID : SchedID
                                                             },
                                                            success: function (response) {
                                                                console.log("sent: " + facultyID + " " + sender + " " + SchedID );     
                                                window.location.href = window.location.href;

                                                            }
                                                        });
                                                    });
                                                } )
                                            $('#RequestDenied').on("click", function (){
                                                window.location.href = window.location.href;
                                            })

                                    }
                                })

                            });
                        }
                    });
                });

            }
        });
    });

    $('.AcceptRequestBTN').on("click", function (){
        const requestID = $(this).data('id');
        $.ajax({
            url: '../modals/RequestResponse.php',
            method: 'GET', 
            success: function (response) {
                $(".ModalManageBody").html(response);
                $(".ManageModal").fadeIn(); 
                $('#statusRequest').on("change", function (){
                    const response = $(this).val();
                    $('#requestResponse').on('click', function (){
                        // console.log(response)
                        $.ajax({
                            url: '../Func/aproveReq.php',
                            method: 'GET', 
                            data: { idRequest: requestID,
                                status: response
                            },
                            success: function (response){
                                // $(".ManageModal").fadeOut();
                                window.location.href = window.location.href;
                            }
                        });
                    });
                });
            }
        });
      
    });
});