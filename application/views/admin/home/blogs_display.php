<div class="main-panel">
        <div class="content-wrapper">
                <h1>Manage your Blogs</h1>
                <hr>
                 <table border="1"  class="table table-bordered table-hover">
                         <tr>
                              <th>Id</th>
                              <!-- <th>Image</th> -->
                              <th>Title</th>
                              <th>surl</th>
                              <th>CreatedOn</th>
                              <th>Preview</th>
                              <th>Edit</th>
                              <th>Delete</th>
                        </tr>
                  <?php
                       foreach($records as $row){ ?>
                          <tr>
                           <td><?php echo $row->id; ?></td>
                           <!-- <td class="spacingimage"><img alt="no-image" class="img-thumbnail text-primary img-size" src="<?php echo base_url();?>uploads/blogs/<?php echo $row->imagess; ?>"></td> -->
                           <td><?php echo substr($row->title,0,5); ?></td>
                           <td><?php echo substr($row->title,0,5); ?></td>
                           <td><?php echo $row->created_on; ?></td>
                           <td><a class="item-preview" href="javascript:;" data="<?php echo $row->id; ?>" >Preview</a></td>
                           <td><a class="item-edit"  href="<?php echo base_url();?>Admin/editBlog/<?php echo $row->id; ?>" >Edit</a></td>
                           <td><a class="item-delete"  href="<?php echo base_url();?>Admin/deleteBlog/<?php echo $row->id; ?>">Delete</a></td>
                           </tr>
                           
                       <?php }
                     ?>
                  </table>
          <?php echo $this->pagination->create_links(); ?>
        </div>
      </div>
      <!-- <script type="text/javascript">
       $(document).ready(function(){
           $('.item-edit').click(function(){
            var id = $(this).attr('data');
                 $.ajax({
                     type:'ajax',
                     method:'get',
                     url:'<?php //echo base_url();?>Admin/editBlog/',
                     async:false,
                     data:{id:id},
                     success:function(data){
                        $('.main-panel').remove();
                        $(data).insertAfter('#sidebar');
                        var editor = new MediumEditor('.editable');
                        $('.editable').mediumInsert({
                             editor: editor
                        });
                     },
                     error:function(){
                         alert('could not get data from database');
                     }
                 });
                 return false;
           });
           $('.item-delete').click(function(){
              var id=$(this).attr('data');
              $.ajax({
                  type:'ajax',
                  method:'get',
                  url:'<?php //echo base_url();?>Admin/deleteBlog/',
                  async:false,
                  data:{id:id},
                  success:function(data){
                        $('.main-panel').remove();
                        $(data).insertAfter('#sidebar');
                  },
                  error:function(){
                      alert('could not delete from the database');
                  }
              });
              return false;
           });
       });
      </script> -->
      <script type="text/javascript">
       $(document).ready(function(){
           $('.item-preview').click(function(){
            var id = $(this).attr('data');
                 $.ajax({
                     type:'ajax',
                     method:'get',
                     url:'<?php echo base_url();?>Admin/previewBlog',
                     async:false,
                     data:{id:id},
                     success:function(data){
                        $('.main-panel').remove();
                        $(data).insertAfter('#sidebar');
                     },
                     error:function(){
                         alert('could not get data from database');
                     }
                 });
                 return false;
           });
        });
      </script>