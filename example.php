
<!DOCTYPE html>
<html>
      
<head>
    <title>
        How to call PHP function
        on the click of a Button ?
    </title>
</head>
  
<body style="text-align:center;">
      
    <h1 style="color:green;">
        GeeksforGeeks
    </h1>
      
    <h4>
        How to call PHP function
        on the click of a Button ?
    </h4>
      
    <?php
        if(array_key_exists('button1', $_POST)) {
            echo $_POST['mark1'];
            button1();
            
        }
        else if(array_key_exists('button2', $_POST)) {
            button2();
        }
        function button1() {
            echo "This is Button1 that is selected";
        }
        function button2() {
            echo "This is Button2 that is selected";
        }
    ?>
  
    <form method="post">
        <select class="dropdown" name="mark1">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="submit" name="button1"
                class="button" value="Button1" />
          
        <input type="submit" name="button2"
                class="button" value="Button2" />
    </form>
</head>
  
</html>