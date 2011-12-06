<script>
    $(function() {
        $('#addPost') 
        .click(function(event){ 
            event.preventDefault();
            event.stopPropagation();
            addPost();
        }); 
    });

    function addPost(){
        $("#PostBody").val($('#postContent').val());
        $("#newPostForm").ajaxSubmit({ 
            success: function(responseText, responseCode) { 
                $( "#postDialog" ).dialog('close');
                document.getElementById("bandBlog").innerHTML = responseText;
                $( "#postDialog:ui-dialog" ).dialog( "destroy" );
                $( "#postDialog" ).dialog({
                    autoOpen: false,
                    height: 600,
                    width: 800,
                    modal: true,
                    close: function() {
                    }
                });
            } 
        }); 
        return false; 
    }

    function editBlog(blogId){
        var data = "id="+ blogId;
        $.ajax({
            type: "post",
            dataType: 'json',
            url: "<?php echo $this->Html->url('/', true); ?>Posts/view/" + blogId,
            data: data,
            success: function(response) {
                $("#PostId").val(response.Post.id)
                $("#PostTitle").val(response.Post.title)
                $("#PostBody").val(response.Post.body)
                $('#postContent').val(response.Post.body);
                $( "#postDialog" ).dialog( "open" );
            },
            error:function (XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
        return false;
    }
    
    function deleteBlog(blogId){
        if (confirm('Are you sure you want to delete this Blog?')) {
            var data = "id="+ blogId;
            $.ajax({
                type: "post",
                url: "<?php echo $this->Html->url('/', true); ?>/Posts/delete/" + blogId,
                data: data,
                success: function(response) {
                    document.getElementById("bandBlog").innerHTML = response;
                    $( "#postDialog:ui-dialog" ).dialog( "destroy" );
                    $( "#postDialog" ).dialog({
                        autoOpen: false,
                        height: 600,
                        width: 800,
                        modal: true,
                        close: function() {
                        }
                    });
                },
                error:function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(textStatus);
                }
            });
        }
        return false;
    }
    
    
    function resetPostForm() {
        $("#PostId").val("")
        $("#PostTitle").val("")
        $("#PostBody").val("")
        $('#postContent').val( '' );

    }

    $(function() {
        $( "#postDialog:ui-dialog" ).dialog( "destroy" );
        $( "#postDialog" ).dialog({
            autoOpen: false,
            height: 600,
            width: 800,
            modal: true,
            close: function() {
            }
        });
    });
</script>

<!-- Blog Dialog-->
<div id="postDialog" title="Blog">
    <div id="postEditArea">
        <?php
        echo $this->element('Posts/post');
        ?>
    </div>
</div>

<a href="#" id="addNewPost" onclick='resetPostForm(); $("#postDialog").dialog( "open" );'>Add Blog</a>

<table cellpadding='0' cellspacing='0' class="dataview" style="border: 1px solid #7D8893;">
    <thead>
        <tr>
            <th>Title</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php foreach ($band['Post'] as $post): ?>
        <tr>
            <td>
                <?php echo $post['title']; ?>
            </td>
            <td width="80px">
                <?php
                echo $this->Js->writeBuffer(array('inline' => 'true'));
                ?>
                <a href="#" id="deleteBlog" onclick="deleteBlog(<?php echo $post['id'] ?>);" class="icon delete" title="Delete Blog" style='margin-left: 10px; width: 16px;'></a>
                <a href="#" id="editBlog" onclick="editBlog(<?php echo $post['id'] ?>);" class="icon edit" title="Edit Blog" style='margin-left: 10px; width: 16px;'></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
