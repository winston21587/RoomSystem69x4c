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
        const floor = $(this).data('floor');
        const type = $(this).data('type');
        const building = $(this).data('building');
        $.ajax({
            url: '../modals/Admin.edit.php',
            method: 'GET', 
            data: { id: RoomID,
                roomname : room ,
                department : dept,
                floor : floor,
                RoomType : type,
                building : building
                },
                success: function (response) {
                    $(".ModalManageBody").html(response);
                    $(".ManageModal").fadeIn(); 

                //     $('form').on('submit', function(){
                //         const room = $('#nameEdit').val();
                //         const dept = $('#deptEdit').val();
                //         const floorEdit = $('#Roomfloor').val();
                //         const RTypeEdit = $('#RoomType').val();
                //         const buildingEdit = $('#RoomBuilding').val();
                //         $.ajax({
                //             url: '../Func/editRoom.php',
                //             method: 'GET', 
                //             data: { id: RoomID,
                //                 roomname : room ,
                //                 department : dept,
                //                 floor : floorEdit,
                //                 RoomType : RTypeEdit,
                //                 building : buildingEdit},
                //             success: function (response) {
                //             $(".ManageModal").fadeOut();
                //             window.location.href = window.location.href;

                //         },
                //             error: function () {
                //             $(".ModalManageBody").html("<p>Error updating the data</p>");
                //       }
                //     });
                // });
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
        const NameOfRoom = $(this).data('name');
        $('.ScheduleText').html(" Schedules for " + NameOfRoom);
        
        $.ajax({
            url: '../tables/sched.table.php',
            method: 'GET', 
            data: { id: RoomID},   
            success: function (response) {
                $('#schedForRoom').html(response);

            $('#schedInsert').on('click', function(){
            $.ajax({
                url: '../modals/Admin.sched.php',
                method: 'GET', 
                data: { id: RoomID,
                    name: NameOfRoom,
                    roomid: RoomID
                 },
                success: function (response) {
                    $(".ModalManageBody").html(response);
                    $(".ManageModal").fadeIn(); 
                }
            });
        });
            }
            
        });
        



        
        
    });

    $('.RoomTable').DataTable({
        paging: true,
        searching: true,
        lengthMenu: [5, 10, 25, 50],
        stateSave: true,
        "bDestroy": true
    });

    $('.SchedTable').DataTable({
        paging: true,
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
                                const SchedID = $(this).data('id');
                                const nameofReqto = $(this).data('send');
                                const reqto = $(this).data('reqto');
                                const facID = $(this).data('facid');
                                console.log(facID);
                                
                                $.ajax({
                                    url: '../modals/requestComfirmation.php',
                                    method: 'GET', 
                                    data: {
                                            requestTo : nameofReqto,
                                     },
                                    success: function (response){
                                        $(".ModalManageBody").html(response);
                                        $(".ManageModal").fadeIn(); 
                                        $('#RequestAproved').on("click", function (){
                                            const dateOfUse = $('#DateOfUse').val();
                                            requestBy = facID;
                                            console.log(dateOfUse + ' . dateofuse');
                                            console.log(requestBy + ' . requestby');
                                            console.log(SchedID + ' . scheduleid');
                                            console.log(reqto + ' . request to');

                                                        $.ajax({
                                                            url: '../Func/requestSender.php',
                                                            method: 'GET',
                                                            data: { 
                                                                    requestTo: reqto,
                                                                    requestBy : requestBy,
                                                                    SchedID : SchedID,
                                                                    dateOfUse: dateOfUse
                                                             },
                                                            success: function (response) {
                                                window.location.href = window.location.href;

                                                            }
                                                        });
                                                    });
                                                

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

    // const loadTabContent = (url, tabElement) => {
    //     if (!tabElement.data("loaded")) {
    //       $(".requestTable").load(url, function (response, status, xhr) {
    //         if (status === "error") {
    //           $(".requestTable").html(`<p>Error loading content: ${xhr.status} ${xhr.statusText}</p>`);
    //         } else {
    //           tabElement.data("loaded", true);
    //         }
    //       });
    //     }
    //   };
      
    //   const defaultTab = $('.tabBTN.activeTab');
    //   const defaultUrl = defaultTab.data('url');
    //   loadTabContent(defaultUrl, defaultTab);
      
    //   $(".tabBTN").on("click", function () {
    //     const url = $(this).data("url");
    //     $(".tabBTN").removeClass("activeTab border-b-4 border-black/70 rounded");
    //     $(this).addClass("activeTab border-b-4 border-black/70 rounded");
      
    //     if (!$(this).data("loaded")) {
    //       loadTabContent(url, $(this));
    //     } else {
    //       $(".requestTable").html("Content already loaded.");
    //     }
    //   });




    if($('body').hasClass('reloaded')){
        $(".requestTable").load('../tables/inbox.php', function (response, status, xhr) {
            if (status === "error") {
              $(".requestTable").html(`<p>Error loading content: ${xhr.status} ${xhr.statusText}</p>`);
            } else {
              
                $('body').removeClass('reloaded');
            }
        });
    }
    $(".tabBTN").on("click", function () {
        const url = $(this).data("url");
        $(".tabBTN").removeClass("activeTab border-b-4 border-black/70 rounded");
        $(this).addClass("activeTab border-b-4 border-black/70 rounded");

        $(".requestTable").load(url, function (response, status, xhr) {
            if (status === "error") {
              $(".requestTable").html(`<p>Error loading content: ${xhr.status} ${xhr.statusText}</p>`);
            } 
        });
      });




      $('.ScheduleBTN').on('click', function (){
        id = $(this).data("sched");
        console.log(id);
        $.ajax({
            url: '../modals/scheduleInfo.php',
            method: 'GET', 
            data: { id: id },
                success: function (response) {
                    $(".ModalManageBody").html(response);
                    $(".ManageModal").fadeIn(); 
              },
              error: function () {
                $(".ModalManageBody").html("<p>Error loading data</p>");
                $(".ManageModal").fadeIn();
              }
        })
    })
      
      
      
      




});