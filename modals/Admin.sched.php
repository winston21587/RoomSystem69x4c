<div class="schedInsert" >
    <form class="flex flex-col justify-end items-start" method="POST">
        <select name="day" id="dayOfWeek">
            <option value="monday">monday</option>
            <option value="tuesday">tuesday</option>
            <option value="wednesday">wednesday</option>
            <option value="thursday">thursday</option>
            <option value="friday">friday</option>
            <option value="saturday">saturday</option>
            <option value="sunday">sunday</option>
        </select>
        <input type="time" name="start_time">
        <input type="time" name="end_time">
        <input type="text" name="subjects" placeholder="Subject">
        <input class="rounded text-black bg-blue-300 px-4 py-1" type="submit" name="submit" value="Addsched">
    </form>
</div>