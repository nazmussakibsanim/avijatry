<?php 
    include "convert_number_encoding.php";
    $pids_arr = $_GET['pids'];
    $qtys_arr = $_GET['qtys'];
    
    $pid_val = explode(',',$pids_arr[0]);
    $qty = explode(',',$qtys_arr[0]);
    
    $totalRow = $_GET['totalRow'];

    $index = 0;

    $totalPair = 0;
    $totalPrice = 0;

    $commsnPerc = $_GET['commission']/100;
    //echo "pack $pack";
    //for ( $carton_no = 1 ; $carton_no <= $pack ; $carton_no++) { 
      //$pack_tag = "total-row$carton_no";
      //$pack_items = $_POST[$pack_tag];
      /*echo "
          <tr> <th> বিবরণ </th>
            <th> পরিমাণ </th>
            <th> দর </th>
          </tr>";*/
          //print_r($pid_val);
      $prePackMeta = [];
      //preparing packMeta
      for ($items = 1 ; $items <= $totalRow ; $items++){
        require_once "conn.php";
        $productMeta = [];
        $pid = trim($pid_val[$index]);
        $inventory_result = mysqli_query($con,"SELECT * FROM inventory WHERE pid = '$pid' LIMIT 1");               
        $inventory = mysqli_fetch_array($inventory_result) ;

        //getting description
        $description = "অবাঞ্ছিত আইডি";
        $genre = '';
              $genre_code = substr($pid, 3,1);
              if ($genre_code == 1) {
                $genre = 'জেঃ' ;
              } else if ($genre_code == 2) {
                $genre = 'লেঃ';
              } else if ($genre_code == 3) {
                $genre = 'সু';
              } else if ($genre_code == 4) {
                $genre = 'বেবি';
              } else{}

              $type_code = substr($pid, 4,2);
              //echo "type code $type_code<br>";
              $type_code = (int)$type_code;
              //echo "type code $type_code<br>";
              $type_result = mysqli_query($con,"SELECT * FROM inventory_config_types WHERE genre = '$genre_code' AND serial_no = '$type_code' LIMIT 1");                
              $type_val = mysqli_fetch_array($type_result) ;
              $type = $type_val['type'];
              //echo "type $type<br>";
              //echo "Affected rows: " . mysqli_affected_rows($con);

        $color_result = mysqli_query($con,"SELECT * FROM inventory_config_colors WHERE serial_no = '$inventory[color]' LIMIT 1");               
        $color = mysqli_fetch_array($color_result) ;
        $color = $color['color'];

        $description = "$genre $type";// $color";
        // if ($description != " "){
        //  echo $description;  
        // } else{
        //  echo 'পাওয়া যায়নি';
        // }
        $qty_val = convertToEnglishNumber($qty[$index]);
        //adding each product for each carton
        $productMeta["pid"] = $pid;
        $productMeta["description"] = $description;
        $productMeta["genre"] = $genre;
        $productMeta["type"] = $type;
        $productMeta["price"] = $inventory["retail_price"];
        $productMeta["qty"] = $qty_val;
        $prePackMeta[] = $productMeta;
        $index++;
      }
      //print_r($prePackMeta);
      //refactoring similar products
      $packMeta = [];
      foreach ($prePackMeta as $first => $prod1) {
        foreach ($prePackMeta as $second => $prod2) {
          if($first<$second && $prod1["genre"] == $prod2["genre"] && $prod1["price"] == $prod2["price"]){
            $prod_types = explode(' + ',$prod1["type"]);
            $type_match = false;
            foreach ($prod_types as $index => $type) {
              if ($type == $prod2["type"]){
                $type_match = true;   
                break;
              }
            }
            //$product_type = $prod1['type'];
            if ($type_match != true){
              $prod1["type"] = "$prod1[type] + $prod2[type]"; //$prod1["type"] <-> $product_type
            }
            //$prod1["type"] = $product_type;
            $prod1["description"] = "$prod1[genre] $prod1[type]";
            $prod1["qty"] = $prod1["qty"]+$prod2["qty"];

            $prePackMeta[$first] = $prod1;
            $prePackMeta[$second] = null;
          }else{}
        }
      }
      foreach ($prePackMeta as $index => $prod) {
        if($prod != null){
          $packMeta[] = $prod;
        }
      }
      foreach ($packMeta as $index => $prod) {
        $index++;
        $subTotalPrice = $prod['qty'] * $prod['price'];

        $totalPrice = $totalPrice + $subTotalPrice;

        $totalPair = $totalPair + $prod['qty'];
        echo "<tr> 
            <td>$index</td>
            <td>$prod[description]</td>
            <td>$prod[qty]</td> 
            <td>$prod[price]</td>
            <td>$subTotalPrice</td> 
            </tr>";
      }
      echo "<tr> 
            <td></td>
            <td></td> 
            <td>=$totalPair</td>
            <td>গায়ের দামে</td> 
            <td>$totalPrice</td>
            </tr>";
      $commsn = $totalPrice*$commsnPerc ;
      $actualPrice = $totalPrice*(1-$commsnPerc) ;
      echo "<tr> 
            <td></td>
            <td></td> 
            <td></td>
            <td>কমিশন</td> 
            <td>$commsn</td>
            </tr>";
      echo "<tr> 
            <td></td>
            <td></td> 
            <td></td>
            <td>কমিশন বাদে</td> 
            <td>$actualPrice</td>
            </tr>";      
    //}
   ?>