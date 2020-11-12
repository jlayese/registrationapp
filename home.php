<?php
include "config.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
   header('Location: index.php');
}

$query = "SELECT * FROM datatable ORDER BY id DESC";  
$res = mysqli_query($con, $query);  

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Camps Site</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/home.css">
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="brand">
                <a href="" class="logo">Math Camps</a>
            </div>
            <nav class="navbar">
                <ul>
                    <li><a href="" class="active">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<section class="hometest" id="home">
    <div class="container">

        <div class="row">
            <div class="section-title text-center">
                <h1>Data Table</h1>
            </div>
        </div>

        <div class="row">

            <div class="home-content">
             
                    <!-- <form name="form1" action="" method="POST">
                        <input type="text" id="addname" placeholder="Add new name">
                        <input type="text" id="addcity" placeholder="Add new city">
                        <input type="button" id="btn" value="ADD" placeholder="Add new city" onclick="insertdata()">
                    </form> -->
               
                    <div class="disp_data" id="disp_data">
                        <table>
                            <tr>
                                <th><a class="column_sort" id="id" data-order="desc" href="#">ID</a></th>  
                                <th><a class="column_sort" id="firstname" data-order="desc" href="#">First Name</a></th>  
                                <th><a class="column_sort" id="lastname" data-order="desc" href="#">Last Name</a></th>  
                                <th><a class="column_sort" id="email" data-order="desc" href="#">Email</a></th>  
                                <th><a class="column_sort" id="datereg" data-order="desc" href="#">Date Registered</a></th> 
                                <th><a class="column_sort" id="timereg" data-order="desc" href="#">Time Registered</a></th> 
                            </tr>

                            <?php  while($row = mysqli_fetch_array($res)) { ?>
                             
                            <tr>  
                               <td><?php echo $row["id"]; ?></td>  
                               <td><?php echo $row["firstname"]; ?></td>  
                               <td><?php echo $row["lastname"]; ?></td>  
                               <td><?php echo $row["email"]; ?></td>  
                               <td><?php echo $row["datereg"]; ?></td>  
                               <td><?php echo $row["timereg"]; ?></td>  
                            </tr>  
                            
                            <?php  }  ?> 

                        </table>
                    </div>
               
            </div>

        </div>
    </div>
</section>

</body>
</html>

<script>
   $(document).ready(function(){
    $(document).on('click', '.column_sort', function(){  
            let column_name = $(this).attr("id");  
            let order = $(this).data("order");
            let action = 'display'  
            let arrow = '';  
            console.log(order)
           //glyphicon glyphicon-arrow-up  
           //glyphicon glyphicon-arrow-down  
            if(order == 'desc')  
            {  
                 arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>';  
            }  
            else  
            {  
                 arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>';  
            }  
        $.ajax({
            type: 'POST',
            url: 'datacrud.php', 
            data:{column_name: column_name, order: order, action: action},
            success: function(data){
              //console.log(response)
                $('#disp_data').html(data);  
                $('#'+column_name+'').append(arrow);  
            //$("#disp_data").html(response);
            },
        
        });
        });
   })
    
</script>