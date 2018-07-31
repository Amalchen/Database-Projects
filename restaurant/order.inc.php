<form action = "<?php echo $currentFile; ?>" method = "GET">
    <select name = "foodType">
        <option>Pasta</option>
        <option>Soup</option>
        <option>Dessert</option>
        <option>Drinks</option>
        <option title = "Fresher than Fresh; Only for today">Specialty</option>  
    </select>
    <input type = "submit" name = "orderFoodType" value = "Order" title = "View menu">
</form>
