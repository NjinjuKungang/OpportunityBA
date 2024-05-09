<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OpportunityBA MySql DB</title>
</head>
<body>
    <div>
        <?php
            if(DB::connnection()->getPdo()){
                echo "Successfully Connected to Database ".DB::connection()->getDatabase()
            }
        ?>
    </div>
</body>
</html>