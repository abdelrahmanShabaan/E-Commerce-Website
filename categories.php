<?php include 'init.php';?>


<div class="container">
    <h1 class="text-center"><?php echo str_replace('','-',$_GET['pagename'])?></h1>
    <div class="row">
    <?php 
      foreach (getItems('Cat_ID',$_GET['pageid']) as $item){
        echo '<div class="col-sm-6 col-md-3>">';
        echo '<div class="thumbnail item-box">';
        echo '<span class="price-tag">' .$item['price'] .  '</span>';
        echo '<img class="img-responsive" src="rab.png" alt="" />';
        echo '<div class="caption">';
        echo '<h3 class="text-center">' .$item['name'] .  '</h3>';
        echo '<p class="text-center">' . $item['description'].  '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

            }             
?>


    </div>
</div>


<?php include $tpl . 'footer.php'; ?>
