<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./roomModal.css">
</head>
<body>
     <h1>Select Department Building</h1>   

     <button class="btn" id="openModal">CCS</button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>
     <button class="btn"></button>

     <div class="modal" id="myModal">
        <div class="modal-content">
            <button id="closeModal">Close</button>
            <div id="modalContent">
                <?php include "./roomTesting.php"?>
            </div>
        </div>
     </div>


    <script src="roomModal.js"></script>
</body>
</html>