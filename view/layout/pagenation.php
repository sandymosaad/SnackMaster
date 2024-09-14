



<div class="pagination">


    <a href="?page-nr=1">First</a>

    <?php
    ### Previous
        if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1){
            ?> <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>">Previous</a> <?php
        }
        else{
            ?> <a>Previous</a>	<?php
        }
    ?>


    <div class="page-numbers">


        <?php
        if(!isset($_GET['page-nr'])){
              ?> <a class="active" href="?page-nr=1">1</a> <?php
              $count_from = 2;
           }else{
              $count_from = 1;
           }
        
            for ($num = $count_from; $num <= $pages; $num++) {
               if($num == $_GET['page-nr']) {
                  ?> <a class="active" href="?page-nr=<?php echo $num ?>"><?php echo $num ?></a> <?php
               }else{
                  ?> <a href="?page-nr=<?php echo $num ?>"><?php echo $num ?></a> <?php
               }
            }
         ?>
    </div>



   <?php 
   ### Next
      if(isset($_GET['page-nr'])){
         if($_GET['page-nr'] >= $pages){
            ?> <a>Next</a> <?php
         }else{
            ?> <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>">Next</a> <?php
         }
      }else{
         ?> <a href="?page-nr=2">Next</a> <?php
      }
   ?>

   	   <!-- Go to the last page -->
          <a href="?page-nr=<?php echo $pages ?>">Last</a>


</div>
