<div class="main-panel">
        <div class="content-wrapper">
          <h1>Edit you Blog</h1>
          <hr>
          <?php if(isset($results)){
            foreach($results as $row){
              ?>
            <form>
               <!-- <div class="form-group">
                 <img width="100" src="<?php //echo base_url();?>uploads/blogs/<?php //echo $row->imagess;?>"
               </div> -->
               <!-- <div class="form-group">
               <label for="image">Enter Image : </label>
                 <input style="border:1px solid black;" id="image" type="file" name="userfile" class="form-control"><br><br>
                 </div> -->
                 <div class="form-group">
                 <input type="hidden" id="id" data="<?php echo $row->id;?>">
                 <label for="heading">Enter The heading for the blog: </label>
                 <input type="text" style="border:1px solid black;" value="<?php echo $row->title;?>" id="heading" name="heading" class="form-control"><br><br>
                 </div>
                 <div class="form-group">
                 <label for="text">Enter The Text for the blog: </label>
                 <textarea class="editable" style="border:1px solid black;" id="text" rows="10" cols="100" name="text" class="form-control"><?php echo $row->description;?>
                 </textarea><br><br>
                 </div>
                 <div class="form-group">
               <label for="date">Enter Date : </label>
                 <input  style="border:1px solid black;" id="date" type="date" name="date" value="<?php echo substr($row->created_on,0,10);?>"class="form-control"><br><br>
                 </div>
                 <button type="submit" id="submit" name="update" value="update" class="btn btn-primary">Publish</button>
            </form>
            <?php
          }
        }
        ?>
        </div>
      </div>
      <script type="text/javascript">
 var editor = new MediumEditor('.editable');
 $('.editable').mediumInsert({
    editor: editor,
    addons: {
    images: {
    fileUploadOptions: {
      url:'<?php echo base_url()?>assets/upload.php'
         }
       }
     }
    });
  $('.medium-insert-buttons').css('margin-left','60px');
  $('.editable').css({"height":"400px","border":"1px solid black", "background":"white","overflow":"scroll"});
  $(document).ready(function(){
    $("#submit").click(function(){
      var heading=$('#heading').val();
      var date=$('#date').val();
      var ajax='1';
      var id=$('#id').attr('data');
      var data=new FormData();
        data.append("heading", heading);
        data.append("date", date);
        data.append("ajax",ajax);
        data.append("description",editor.serialize()[editor.elements[0].id].value);
      $.ajax({
       url:"<?php echo site_url('Admin/newBlogUpdate');?>",
       type:'POST',
       data:data,
       cache: false,
       contentType: false,
       processData: false,
       success: function(data){
         $('.main-panel').remove();
         $(data).insertAfter('#sidebar');
         }
     });
    return false;
 });
});
  </script>