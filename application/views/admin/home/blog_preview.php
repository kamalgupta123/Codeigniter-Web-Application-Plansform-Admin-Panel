<div class="main-panel">
        <div class="content-wrapper">
          <h1>Here is your Preview</h1>
          <hr>
          <div>
           <?php
             foreach($results as $row) {
            ?>
               <div><?php echo $row->title; ?></div>
               <div><?php echo $row->description;?></div>
               <div><?php echo $row->created_on;?></div>
            <?php
             }
            ?>
          </div>
        </div>
      </div>