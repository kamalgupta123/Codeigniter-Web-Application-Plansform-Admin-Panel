<div class="main-panel">
        <div class="content-wrapper">
          <h1>Add you Blog</h1>
          <hr>
          <?php echo $error; ?>
            <form>
             <input type='hidden' name='description' id="desc">
               <!-- <div class="form-group">
               <label for="image">Enter Image : </label>
                 <input style="border:1px solid black;" id="image" type="file" name="userfile" class="form-control"><br><br>
                 </div> -->
                 <div class="form-group">
                 <label for="heading">Enter The heading for the blog: </label>
                 <input type="text" style="border:1px solid black;" id="heading" name="heading" class="form-control"><br><br>
                 </div>
                 <div class="form-group">
                 <label for="text">Enter The description for the blog: </label>
                 <textarea class="editable" id="text" name="text" class="form-control"></textarea><br><br>
                 </div>
                 <div class="form-group">
                 <label for="date">Enter Date : </label>
                 <input  style="border:1px solid black;" id="date" type="date" name="date" class="form-control"><br><br>
                 </div>
                 <input type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">
            </form>
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
      var data=new FormData();
      // var files = $('[type="file"]').get(0).files;
      // if (files.length > 0) {
        // data.append("file", files[0]);
        data.append("heading", heading);
        data.append("date", date);
        data.append("ajax",ajax);
        data.append("description",editor.serialize()[editor.elements[0].id].value);
      // }
      $.ajax({
       url:"<?php echo site_url('Admin/newBlogUpload');?>",
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