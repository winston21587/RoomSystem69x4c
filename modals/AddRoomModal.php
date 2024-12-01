<div style="display:none" class="AdminModal" id="AdminModal" >
    <button onclick="closeAddRoom()" >Close Modal</button>

    <form method="POST"  >
        <input type="text" name="RoomName" placeholder="Enter Room Name" >
        <select name="department" id="department">
            <option value="CCS">CSS</option>
            <option value="CLA">CLA</option>
            <option value="CSM">CSM</option>
            <option value="Engineering">Engineering</option>
        </select>
        <input type="submit" name="submit" >
    </form>
</div>