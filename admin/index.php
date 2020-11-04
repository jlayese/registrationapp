<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
</head>
<body>
  <div id="disp_data"></div>
  <form name="form1" action="" method="POST">
    <input type="text" id="addname" placeholder="Add new name">
    <input type="text" id="addcity" placeholder="Add new city">
    <input type="button" id="btn" value="ADD" placeholder="Add new city" onclick="insertdata()">
  </form>

  <script>
  
  let xmlhttp = new XMLHttpRequest();

  disp_data();
    function disp_data(){
      //let xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET", "update.php?status=disp", false);
      xmlhttp.send(null);
      document.getElementById("disp_data").innerHTML=xmlhttp.responseText;
    }

    function aa(a){
 
      let nameid = "name" + a;
      let txtnameid = "txtname" + a;
      let name = document.getElementById(nameid).innerHTML;
      document.getElementById(nameid).innerHTML = '<input type ="text" value= "'+name+'" id = "'+txtnameid+'">';

      let cityid = "city" + a;
      let txtcityid = "txtcity" + a;
      let city = document.getElementById(cityid).innerHTML;
          document.getElementById(cityid).innerHTML= '<input type ="text" value= "'+city+'" id = "'+txtcityid+'">';

      let updateid = "update" + a;
      document.getElementById(a).style.visibility="hidden";
      document.getElementById(updateid).style.visibility = "visible";

    }

    function bb(b){
     
      let nameid = "txtname"+b;
      let name = document.getElementById(nameid).value;

      let cityid = "txtcity"+b;
      let city = document.getElementById(cityid).value;

      updatevalue(b,name,city);

      document.getElementById(b).style.visibility = "visible";
      document.getElementById("update"+b).style.visibility="hidden";

      document.getElementById("name"+b).innerHTML = name;
      document.getElementById("city"+b).innerHTML = city;
    }

    function updatevalue(id,name,city){
      //let xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET", "update.php?id="+id+"&name="+name+"&city="+city+"&status=update", false);
      xmlhttp.send(null);
    }

    function deletedata(id){
     // let xmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET", "update.php?id="+id+"&status=delete", false);
      xmlhttp.send(null);
      disp_data();
    }

    function insertdata(){
      let name = document.getElementById('addname').value;
      console.log(name)
      let city = document.getElementById('addcity').value;
      console.log(city)

      xmlhttp.open("GET", "update.php?name="+name+"&city="+city+"&status=insert", false);
      xmlhttp.send(null);

      disp_data();

      document.getElementById('addname').value="";
      document.getElementById('addcity').value="";
    }
  </script>
</body>
</html>