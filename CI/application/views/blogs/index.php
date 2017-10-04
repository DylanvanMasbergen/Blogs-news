    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

        <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
        $('#mijnTafel').DataTable();});
    </script>

        
 
    <table id="mijnTafel" class="display">
        <thead>
            <tr>
                <th><strong>Title</strong></th>
                <th><strong>Content</strong></th>
                <th><strong>Action</strong></th>
            </tr>
        </thead>

        <?php foreach ($blogs as $blog): ?>
    
            <tr>
                <td><?php echo $blog['title']; ?></td>
                <td><?php echo $blog['text']; ?></td>
                <td>
                    <a href="<?php echo site_url('blogs/'.$blog['slug']); ?>">View</a> | 
                    <a href="<?php echo site_url('blogs/edit/'.$blog['id']); ?>">Edit</a> | 
                    <a href="<?php echo site_url('blogs/delete/'.$blog['id']); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
