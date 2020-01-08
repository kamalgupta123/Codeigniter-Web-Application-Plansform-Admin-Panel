<div class="main-panel">
        <div class="content-wrapper">
          <h1>Add you news</h1>
          <hr>
          <?php echo $error; ?>
            <form action="<?php echo base_url();?>Admin/doUpload" method="post" enctype="multipart/form-data">
               <div class="form-group">
               <label for="image">Enter Image : </label>
                 <input style="border:1px solid black;" id="image" type="file" name="userfile" class="form-control"><br><br>
                 </div>
                 <div class="form-group">
                 <label for="heading">Enter The heading for the news: </label>
                 <input type="text" style="border:1px solid black;" id="heading" name="heading" class="form-control"><br><br>
                 </div>
                 <div class="form-group">
                 <label for="text">Enter The Text for the news: </label>
                 <textarea style="border:1px solid black;" id="text" rows="10" cols="100" name="text" class="form-control"></textarea><br><br>
                 </div>
                 <div class="form-group">
                 <label for="date">Enter Date : </label>
                 <input  style="border:1px solid black;" id="date" type="date" name="date" class="form-control"><br><br>
                 </div>
                 <button type="submit" name="submit" value="submit" class="btn btn-primary">Publish</button>
            </form>
        </div>
      </div>