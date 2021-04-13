
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});





$(document).ready(function () {
       listComment();


       $("#submitButton").click(function () {
    
            $("#comment-message").css('display', 'none');


            var frm = $('#frm-comment');

            $.ajax({
              url: frm.attr('action'),
              type: frm.attr('method'),
              data: frm.serialize(),
            })
            .done(function( response ) {
              if (response['message'] == true) {
                $("#comment-message").css('display', 'inline-block');
                $("#name").val("");
                $("#comment").val("");
                $("#commentId").val("");
               listComment();
              }else{
                alert("Failed to add comments !");
                return false;
              }
            });
        });

});


function listComment() {
	$.ajax ({
		type:"POST",
		url: "pulldata",
		data: {_token: $('meta[name="csrf-token"]').attr('content')},
		dataType:'JSON',
		success:function(response) {

            var comments = "";
            var replies = "";
            var item = "";
            var parent = -1;
            var results = new Array();
            var list = $("<ul class='outer-comment'>");
            var item = $("<li>").html(comments);


            console.log(response.data);

            $.each(response.data, function(k, v) {

            	var commentId = v['comment_id'];
                	parent = v['parent_comment_id'];

                if (parent == "0")
                {
                    comments = "<div class='comment-row'>"+
                                    "<div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + v['comment_sender_name'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + v['date'] + "</span></div>" + 
                                    "<div class='comment-text'>" + v['comment'] + "</div>"+
                                    "<div><a class='btn-reply' onClick='postReply(" + commentId + ")'>Reply</a></div>"+
                                "</div>";

                    var item = $("<li>").html(comments);
                    list.append(item);
                    var reply_list = $('<ul>');
                    item.append(reply_list);
                    listReplies(commentId, response.data, reply_list);
                }

            });	

            $("#output").html(list);	
		}
	});
 
}


function listReplies(commentId, data, list) {
    for (var i = 0; (i < data.length); i++)
    {
        if (commentId == data[i].parent_comment_id)
        {
            var comments = "<div class='comment-row'>"+
            " <div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['comment_sender_name'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['date'] + "</span></div>" + 
            "<div class='comment-text'>" + data[i]['comment'] + "</div>"+
            "<div><a class='btn-reply' onClick='postReply(" + data[i]['comment_id'] + ")'>Reply</a></div>"+
            "</div>";
            var item = $("<li>").html(comments);
            var reply_list = $('<ul>');
            list.append(item);
            item.append(reply_list);
            listReplies(data[i].comment_id, data, reply_list);
        }
    }
}


