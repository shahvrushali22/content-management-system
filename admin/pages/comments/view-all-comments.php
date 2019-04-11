<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Post Title</th>
                    <th>Date</th>
                    <th>Approve</th>
                    <th>Unapprove</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include_once ("../includes/functions.php");
                include_once ("../includes/connection.php");
                $resultset = getAllComments();
                while($row = mysqli_fetch_assoc($resultset)){
                    $comment_id = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_author = $row['comment_author'];
                    $comment_email = $row['comment_email'];
                    $comment_content = $row['comment_content'];
                    $comment_status = $row['comment_status'];
                    $comment_date = $row['comment_date'];

                    //FETCH COMMENT_TITLE FROM comm_post_id
                    $post_resultset = getAllPosts("post_id = $comment_post_id");
                    if($post = mysqli_fetch_assoc($post_resultset)){
                        $post_title = $post['post_title'];
                    }else{
                        $post_title = "Something Went Wrong!";
                    }
                    echo<<<COMMENT
<tr>
<td>$comment_id</td>
<td>$comment_author</td>
<td>$comment_content</td>
<td>$comment_email</td>
<td>$comment_status</td>
<td><a>$post_title</a></td>
<td>$comment_date</td>
<td><a href="comments.php?source=approved&comment_id=$comment_id" class="btn btn-info"><span class="fa fa-thumbs-up"></span</a> </td>
<td><a href="comments.php?source=unapproved&comment_id=$comment_id" class="btn btn-danger"><span class="fa fa-thumbs-down"></span></a> </td>
<td><a href="comments.php?source=delete_comments&comment_id=$comment_id" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>

</tr>
COMMENT;

                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>