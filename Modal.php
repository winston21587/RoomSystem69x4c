<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add/Rent Room Modal</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<!-- Button to Open Modal -->
<button id="openModalBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
    Add/Rent Room
</button>

<!-- Modal -->
<div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
    <div class="bg-gray-800 text-gray-100 rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-xl font-bold mb-4 text-center">Add/Rent Room</h2>
        <form action="process_room.php" method="POST" id="roomForm" class="space-y-4">
            <!-- Room Name -->
            <div>
                <label for="roomName" class="block text-sm font-medium text-gray-300">Room Name</label>
                <input type="text" name="room_name" id="roomName" class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-gray-200 placeholder-gray-400 focus:ring-2 focus:ring-blue-500" placeholder="Enter room name" required>
            </div>

            <!-- Room Type -->
            <div>
                <label for="roomType" class="block text-sm font-medium text-gray-300">Room Type</label>
                <select name="room_type" id="roomType" class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-gray-200 focus:ring-2 focus:ring-blue-500" required>
                    <option value="Sample">Single</option>
                    <option value="Sample2">Double</option>
                    <option value="Sample3">Suite</option>
                </select>
            </div>

            <!-- Room Price -->
            <div>
                <label for="Duration" class="block text-sm font-medium text-gray-300">Duration</label>
                <input type="number" name="Duration" id="Duration" class="w-full px-4 py-2 border border-gray-600 rounded-lg bg-gray-700 text-gray-200 placeholder-gray-400 focus:ring-2 focus:ring-blue-500" placeholder="Duration" required>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-2">
                <button type="button" id="closeModalBtn" class="px-4 py-2 bg-gray-600 text-gray-100 rounded-lg hover:bg-gray-500">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Select modal and buttons
        const modal = document.getElementById('modal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');

        // Open Modal
        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        // Close Modal
        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Close modal when clicking outside
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
</body>
</html>
