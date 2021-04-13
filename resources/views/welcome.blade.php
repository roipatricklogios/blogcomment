<html>
  
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<style>
body {
    font-family: Arial;
    width: 550px;
}

.comment-form-container {
    background: #F0F0F0;
    border: #e0dfdf 1px solid;
    padding: 20px;
    border-radius: 2px;
}

.input-row {
    margin-bottom: 20px;
}

.input-field {
    width: 100%;
    border-radius: 2px;
    padding: 10px;
    border: #e0dfdf 1px solid;
}

.btn-submit {
    padding: 10px 20px;
    background: #333;
    border: #1d1d1d 1px solid;
    color: #f0f0f0;
    font-size: 0.9em;
    width: 100px;
    border-radius: 2px;
    cursor:pointer;
}

ul {
    list-style-type: none;
}

.comment-row {
    border-bottom: #e0dfdf 1px solid;
    margin-bottom: 15px;
    padding: 15px;
}

.outer-comment {
    background: #F0F0F0;
    padding: 20px;
    border: #dedddd 1px solid;
}

span.commet-row-label {
    font-style: italic;
}

span.posted-by {
    color: #09F;
}

.comment-info {
    font-size: 0.8em;
}
.comment-text {
    margin: 10px 0px;
}
.btn-reply {
    font-size: 0.8em;
    text-decoration: underline;
    color: #888787;
    cursor:pointer;
}
#comment-message {
    margin-left: 20px;
    color: #189a18;
    display: none;
}
</style>
<title>Test Blog Comment</title>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>


<body>
    <h1>Test Blog Comment</h1>
    <div class="comment-form-container">
        <form id="frm-comment" action="{{ url('/reply') }}" method="post">
            {{csrf_field()}}
            <div class="input-row">
                <input type="hidden" name="comment_id" id="commentId"
                    placeholder="Name" /> <input class="input-field"
                    type="text" name="name" id="name" placeholder="Name" />
            </div>
            <div class="input-row">
                <textarea class="input-field" type="text" name="comment"
                    id="comment" placeholder="Add a Comment">  </textarea>
            </div>
            <div>
                <input type="button" class="btn-submit" id="submitButton"
                    value="Publish" /><div id="comment-message">Comments Added Successfully!</div>
            </div>

        </form>
    </div>
    <div id="output">
    </div>
    <script>
            function postReply(commentId) {
                $('#commentId').val(commentId);
                $("#name").focus();
            }

            // $("#submitButton").click(function () {
            //        $("#comment-message").css('display', 'none');
            //     var str = $("#frm-comment").serialize();

            //     $.ajax({
            //         url: "comment-add.php",
            //         data: str,
            //         type: 'post',
            //         success: function (response)
            //         {
            //             var result = eval('(' + response + ')');
            //             if (response)
            //             {
            //                 $("#comment-message").css('display', 'inline-block');
            //                 $("#name").val("");
            //                 $("#comment").val("");
            //                 $("#commentId").val("");
            //                listComment();
            //             } else
            //             {
            //                 alert("Failed to add comments !");
            //                 return false;
            //             }
            //         }
            //     });
            // });
            
        </script>
</body>

</html>