<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
        table,th,td{
            border-collapse: collapse;
            border: 1px solid black;
            margin-left: 45px;
        }
        p{
            text-align: left;
            margin-left:65px;
        }
        th{
            background-color: darkgray;
        }
        </style>
  </head>
<body>
<div class="row" style="text-align: center">
    <h2>To do list</h2>
    <h4>ID: {{$profile->id}} &nbsp; &nbsp; Name: {{$profile->name}}</h4>
</div>
<div class="row" style="text-align: center">
<?php
    foreach($datadata as $data){
        $i = 0;
        foreach($data as $value){
            if($i==1){
                echo "<table style='width:90%;text-align: center;';><tr><th>No.</th><th>Detail</th></tr>";
                $j = 1;
                foreach($value as $val){
                    echo "<tr ><td style='width:10%'>".$j."</td><td style='width:90%'>".$val."</td></tr>";
                    $j = $j+1;
                }
                echo "</table>";
            }else{
                echo "<p>".$value."<br></p>";
            }
            $i = $i+1;
        }  
        echo "<br>";
    }
?>
</div>
</body>
</html>
