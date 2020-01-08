<div class="main-panel">
        <div class="content-wrapper">
                <h1>Manage your News</h1>
                <hr>
                 <table border="1"  class="table table-bordered table-hover">
                         <tr>
                              <th>Id</th>
                              <th>Image</th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Dates</th>
                              <th>Edit</th>
                              <th>Delete</th>
                        </tr>
                  <?php
                  
                       foreach($records as $row){ ?>
                          <tr>
                           <td><?php echo $row->id; ?></td>
                           <td class="spacingimage"><img alt="no-image" class="img-thumbnail text-primary img-size" src="<?php echo base_url();?>uploads/news/<?php echo $row->image; ?>"></td>
                           <td><?php echo substr($row->title,0,5); ?></td>
                           <td><?php echo substr($row->description,0,2).".."; ?></td>
                           <td><?php echo $row->dates; ?></td>
                           <td><a href="<?php echo base_url();?>Admin/edit/<?php echo $row->id; ?>">Edit</a></td>
                           <td><a href="<?php echo base_url();?>Admin/delete/<?php echo $row->id; ?>">Delete</a></td>
                           </tr>
                           
                       <?php }
                     ?>
                  </table>
          <?php echo $this->pagination->create_links(); ?>
        </div>
      </div>