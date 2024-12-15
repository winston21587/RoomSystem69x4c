
<?php
    require_once "../class/adminClass.php";
    require_once "../Func/clean.php";

    $Admin = new Admin();
    if(isset($_GET['id'])){
        $id = clean($_GET['id']);
        $start = clean($_GET['start']);
        $end = clean($_GET['end']);
        $day = clean($_GET['day']);
        $sub = clean($_GET['sub']);
        $prof = clean($_GET['prof']);
        $year = clean($_GET['year']);
        $sem = clean($_GET['sem']);
        
    }

?>
<div id="editRoom" class=" items-start bg-slate-200 p-5">
<form class="flex flex-col justify-center" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        <select name="day" id="dayOfWeek">
            <option <?= ($day == 'monday') ? 'selected' : '' ?>  value="monday">monday</option>
            <option <?= ($day == 'tuesday') ? 'selected' : '' ?>  value="tuesday">tuesday</option>
            <option <?= ($day == 'wednesday') ? 'selected' : '' ?>  value="wednesday">wednesday</option>
            <option <?= ($day == 'thursday') ? 'selected' : '' ?>  value="thursday">thursday</option>
            <option <?= ($day == 'friday') ? 'selected' : '' ?>  value="friday">friday</option>
            <option <?= ($day == 'saturday') ? 'selected' : '' ?>  value="saturday">saturday</option>
            <option <?= ($day == 'sunday') ? 'selected' : '' ?>  value="sunday">sunday</option>
        </select>
        <input type="time" name="start" value="<?= $start ?>"  >
        <input type="time" name="end"   value="<?= $end ?>" > 
        <select name="sub">
            <?php foreach($Admin->getSub() as $s): ?>
                <option <?= ($sub == $s['SubName'] ) ? 'selected' : '' ?> value="<?= $s['id'] ?>"> <?= $s['SubName'] ?></option>
            <?php endforeach; ?> 
        </select>
        <select 
                name="prof" 
                id="profid" 
                class="w-full mt-2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            >  
                <?php foreach($Admin->getProf() as $c): ?>
                    <option <?= ($prof == $c['name'] ) ? 'selected' : '' ?> value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                <?php endforeach; ?>
            </select>

            <select name="sem" id="semester">
                <option <?= ($sem == '1st_semester' ) ? 'selected' : '' ?> value="1st_semester">1st-semester</option>
                <option <?= ($sem == '2nd_semester' ) ? 'selected' : '' ?> value="2nd_semester">2nd-semester</option>
            </select>
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" min="1900" max="2099" step="1" value="<?= $year ?>">
    
                    <input type="submit" name="submit" value="Editsched">
        </form>
</div>