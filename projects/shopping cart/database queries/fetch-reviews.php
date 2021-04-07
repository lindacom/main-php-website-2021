<?php 

$connect = mysqli_connect("host", "user", "password", "database");


$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM reviews
  WHERE description LIKE '%".$search."%'
  ";
}

// (SELECT * FROM reviews ORDER BY reviewId DESC)
 
else
{
 $query = "

SELECT *,COUNT(*)
FROM reviews   
GROUP BY booktitle
ORDER BY booktitle ASC
;
";
}
$result = mysqli_query($connect, $query);


if(mysqli_num_rows($result) > 0) {
 $output .= '
<div class="container1">

     ';
 while ($row = mysqli_fetch_array($result))
 {
  $output .= '

<div class="item">
<h3> This book has '.$row["COUNT(*)"].' comment(s)</h3>
                   <h3>  '.$row["booktitle"].'</h3>
                   <p>Comment number -  '.$row["reviewId"].'</p>
   
                   <p>Review - '.$row["description"].'</p>
                   <p>Posted -  '.$row["date"].'</p>
                  

<hr />  

</div>




  

  ';

 }


 echo $output;




}

   

else
{
 echo 'Data Not Found';
}

?>  

