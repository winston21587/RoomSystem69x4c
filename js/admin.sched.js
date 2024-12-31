$(document).ready(function () {

    $('.DeleteSched').on("click", function(){
        const SID = $(this).data('id');
        $.ajax({
            url: '../modals/DeleteSched.php',
            method: 'GET', 
            success: function (response){
                $(".ModalManageBody").html(response);
                $('.ManageModal').removeClass('hidden');
                $(".ManageModal").fadeIn(); 
                $('#deleteSchedTrue').on("click", function (){   
                    console.log(SID);     
                        $.ajax({
                            url: '../Func/deletesched.php',
                            method: 'GET',
                            data: { id: SID},
                            success: function (response) {
                            window.location.href = window.location.href;
                            }
                        });
                    });
        $('#deleteSchedFalse').on("click", function (){
            $(".ManageModal").fadeOut();                   
                 })
            }
        })
    });

    $('.EditSched').on('click', function (){
        const SID = $(this).data('id');
        const day = $(this).data('day');
        const start = $(this).data('start');
        const end = $(this).data('end');
        const sub = $(this).data('sub');
        const prof = $(this).data('prof');
        const sem = $(this).data('sem');
        const year = $(this).data('year');
        console.log(SID);
        
        $.ajax({
            url: '../modals/EditSched.php',
            method: 'GET', 
            data: { id: SID,
                    day: day,
                    sub: sub,
                    start: start,
                    end: end,
                    prof: prof,
                    year, year,
                    sem, sem
                    
            },
            success: function (response){
                $(".ModalManageBody").html(response);
                $('.ManageModal').removeClass('hidden');

                $(".ManageModal").fadeIn(); 

            }
        })
        
    })

})