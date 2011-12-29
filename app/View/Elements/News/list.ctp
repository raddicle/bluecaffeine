<script>
    
    function getNewsDetailsFromUrl(){
        $.ajax({
            type: "post",
            dataType: 'json',
            url: "<?php echo $this->Html->url('/', true); ?>BandNews/fetchNewsFromURL",
            data: 'newsurl=' + $('#BandNewsNewsurl').val(),
            success: function(response) {

              $("#BandNewsTitle").val($.trim(response.BandNews.title));
              $("#BandNewsDescription").val($.trim(response.BandNews.description));
            },
            error:function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }
    
    $(function() {
        $('#addNews') 
        .click(function(event){ 
            event.preventDefault();
            event.stopPropagation();
            addNews();
        }); 
    });

    function addNews(){
        $("#newBandNewsForm").ajaxSubmit({ 
            success: function(responseText, responseCode) { 
              //alert(responseText);
                $( "#newsDialog" ).dialog('close');
                document.getElementById("bandNews").innerHTML = responseText;
                $( "#newsDialog:ui-dialog" ).dialog( "destroy" );
                $( "#newsDialog" ).dialog({
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

    function editNews(newsId){
        var data = "id="+ newsId;
        $.ajax({
            type: "post",
            dataType: 'json',
            url: "<?php echo $this->Html->url('/', true); ?>BandNews/view/" + newsId,
            data: data,
            success: function(response) {
                $("#BandNewsNewsurl").val(response.BandNews.newsurl);
                $("#BandNewsId").val(response.BandNews.id);
                $("#BandNewsTitle").val(response.BandNews.title);
                $("#BandNewsDescription").val(response.BandNews.description);
                $( "#newsDialog" ).dialog( "open" );
            },
            error:function (XMLHttpRequest, textStatus, errorThrown) {
                alert(textStatus);
            }
        });
        return false;
    }
    
    function deleteNews(newsId){
        if (confirm('Are you sure you want to delete this News?')) {
            var data = "id="+ newsId;
            $.ajax({
                type: "post",
                url: "<?php echo $this->Html->url('/', true); ?>/BandNews/delete/" + newsId,
                data: data,
                success: function(response) {
                    document.getElementById("bandNews").innerHTML = response;
                    $( "#newsDialog:ui-dialog" ).dialog( "destroy" );
                    $( "#newsDialog" ).dialog({
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
    
    
    function resetNewsForm() {
        $("#BandNewsNewsurl").val('');
        $("#BandNewsId").val("")
        $("#BandNewsTitle").val("")
        $("#BandNewsDescription").val("")

    }

    $(function() {
        $( "#newsDialog:ui-dialog" ).dialog( "destroy" );
        $( "#newsDialog" ).dialog({
            autoOpen: false,
            height: 400,
            width: 600,
            modal: true,
            close: function() {
            }
        });
    });
</script>

<?php
$bandDetails = $this->Session->read('band');
?>
<!-- News Dialog-->
<div id="newsDialog" title="News">
    <div id="newsEditArea">
        <?php
        echo $this->element('News/create_band_news');
        ?>
    </div>
</div>

<a href="#" id="addNews" onclick='resetNewsForm(); $("#newsDialog").dialog( "open" );'>Add News</a>

<table cellpadding='0' cellspacing='0' class="dataview" style="border: 1px solid #7D8893;">
    <thead>
        <tr>
            <th>Title</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php foreach ($bandDetails['BandNews'] as $news): ?>
        <tr>
            <td>
                <?php echo $this->Html->link($news['title'], $news['newsurl']
                        , array('class' => 'button', 'target' => '_blank'));
                ?>
            </td>
            <td width="80px">
                <?php
                echo $this->Js->writeBuffer(array('inline' => 'true'));
                ?>
                <a href="#" id="deleteNews" onclick="deleteNews(<?php echo $news['id'] ?>);" class="icon delete" title="Delete News" style='margin-left: 10px; width: 16px;'></a>
                <a href="#" id="editNews" onclick="editNews(<?php echo $news['id'] ?>);" class="icon edit" title="Edit News" style='margin-left: 10px; width: 16px;'></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
