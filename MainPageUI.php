<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Availability</title>
    <style>
        .btn {
            display: inline-block;
            padding: 40px;
            font-size: 1.2rem;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.5), rgba(255, 255, 240, 0.5));
            background-size: cover;
            background-position: center;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .btn[data-bg] {
            background-image: url('./assets/placeholder.jpg');
        }

        .btn[data-bg="CCS"] { background-image: url('./assets/ccs.jpg'); }
        .btn[data-bg="CSM"] { background-image: url('./assets/csm.jpg'); }
        .btn[data-bg="Engineering"] { background-image: url('./assets/coe.jpg'); }
        .btn[data-bg="CLA"] { background-image: url('./assets/cla.jpg'); }
        .btn[data-bg="Nursing"] { background-image: url('./assets/nursing.jpg'); }
        .btn[data-bg="Architecture"] { background-image: url('./assets/archi.jpg'); }
        .btn[data-bg="CCJE"] { background-image: url('./assets/ccje.jpg'); }
        .btn[data-bg="CHE"] { background-image: url('./assets/che.jpg'); }
        .btn[data-bg="COA"] { background-image: url('./assets/coa.jpg'); }
        .btn[data-bg="COAIS"] { background-image: url('./assets/coais.jpg'); }
        .btn[data-bg="COFAES"] { background-image: url('./assets/cofaes.jpg'); }
        .btn[data-bg="COL"] { background-image: url('./assets/col.jpg'); }
        .btn[data-bg="COM"] { background-image: url('./assets/com.jpg'); }
        .btn[data-bg="CPADS"] { background-image: url('./assets/cpads.jpg'); }
        .btn[data-bg="CSSPE"] { background-image: url('./assets/csspe.jpg'); }
        .btn[data-bg="CSWCD"] { background-image: url('./assets/cswcd.jpg'); }
        .btn[data-bg="CTE"] { background-image: url('./assets/cte.jpg'); }

        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-content h3 {
            margin-bottom: 20px;
        }

        .modal-content button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background: #007bff;
            color: white;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .modal-content button:hover {
            background: #0056b3;
        }
    </style>
    <script>
        function openModal(buildingName) {
            const modal = document.getElementById('dynamicModal');
            const modalContent = document.getElementById('modalContent');

            modalContent.innerHTML = `<h3>${buildingName}</h3><p>Loading rooms for ${buildingName}...</p>`;
            
            fetch(`fetch_rooms.php?building=${buildingName}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const roomList = data.map(
                            room => `<li>${room.name} - Status: ${room.status}</li>`
                        ).join('');
                        modalContent.innerHTML = `
                            <h3>${buildingName}</h3>
                            <ul>${roomList}</ul>
                        `;
                    } else {
                        modalContent.innerHTML = `<h3>${buildingName}</h3><p>No rooms available.</p>`;
                    }
                })
                .catch(error => {
                    modalContent.innerHTML = `<h3>${buildingName}</h3><p>Error loading rooms.</p>`;
                    console.error('Error fetching room data:', error);
                });

            modal.style.display = 'flex';
        }

        function closeModal() {
            const modal = document.getElementById('dynamicModal');
            modal.style.display = 'none';
        }
    </script>
</head>
<body>
    <h1>Select Building</h1>
    <div class="button-group">
        <button class="btn" data-bg="CCS" onclick="openModal('CCS')">CCS</button>
        <button class="btn" data-bg="CSM" onclick="openModal('CSM')">CSM</button>
        <button class="btn" data-bg="Engineering" onclick="openModal('Engineering')">Engineering</button>
        <button class="btn" data-bg="CLA" onclick="openModal('CLA')">CLA</button>
        <button class="btn" data-bg="Nursing" onclick="openModal('Nursing')">Nursing</button>
        <button class="btn" data-bg="Architecture" onclick="openModal('Architecture')">Architecture</button>
        <button class="btn" data-bg="CCJE" onclick="openModal('CCJE')">CCJE</button>
        <button class="btn" data-bg="CHE" onclick="openModal('CHE')">CHE</button>
        <button class="btn" data-bg="COA" onclick="openModal('COA')">COA</button>
        <button class="btn" data-bg="COAIS" onclick="openModal('COAIS')">COAIS</button>
        <button class="btn" data-bg="COFAES" onclick="openModal('COFAES')">COFAES</button>
        <button class="btn" data-bg="COL" onclick="openModal('COL')">COL</button>
        <button class="btn" data-bg="COM" onclick="openModal('COM')">COM</button>
        <button class="btn" data-bg="CPADS" onclick="openModal('CPADS')">CPADS</button>
        <button class="btn" data-bg="CSSPE" onclick="openModal('CSSPE')">CSSPE</button>
        <button class="btn" data-bg="CSWCD" onclick="openModal('CSWCD')">CSWCD</button>
        <button class="btn" data-bg="CTE" onclick="openModal('CTE')">CTE</button>
    </div>

    <div id="dynamicModal" class="modal">
        <div class="modal-content">
            <div id="modalContent"></div>
            <button onclick="closeModal()">Close</button>
        </div>
    </div>
</body>
</html>
