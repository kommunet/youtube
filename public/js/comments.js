function postThreadedComment(comment_form_id) 
{
	if (CheckLogin() == false)
		return false;

	var form = document.forms[comment_form_id];

	if (ThreadedCommentHandler(form)) {
		var add_button = form.add_comment_button;
		add_button.value = "Adding comment..";
		add_button.disabled = true;

	} 
}
function ThreadedCommentHandler(comment_form)
{
        var comment = comment_form.comment;
        var comment_button = comment_form.comment_button;

        if (comment.value.length == 0 || comment.value == null)
        {
                alert("You must enter a comment!");
                comment.focus();
                return false;
        }

        if (comment.value.length > 500)
        {
                alert("Your comment must be shorter than 500 characters!");
                comment.focus();
                return false;
        }

		postForm(comment_form.name, true, commentResponse);
        return true;
}
function commentResponse(xmlHttpRequest)
{
	response_str = xmlHttpRequest.responseText;
	response_code = response_str.substr(0, response_str.indexOf(" "));
	form_id = response_str.substr(response_str.indexOf(" ")+1);
	
	var form = document.forms[form_id];
	var dstDiv = form.add_comment_button;
	var discard_button = form.discard_comment_button;

	if (response_code == "OK") {
        dstDiv.value = "Thanks for the comment!";
        dstDiv.disabled = true;
		discard_button.disabled = true;
		discard_button.style.display  = "none";
	} else if (response_code == "LOGIN") {
            alert("An error occured while posting the comment. Please relogin and try again.");
            dstDiv.disabled = false;
	} else {
        if(response_code == "BLOCKED") {
            alert("You have been blocked from commenting on this user's videos.");
            dstDiv.disabled = true;
        } else {
            alert("An error occured while posting the comment.");
            dstDiv.disabled = false;
        }
        dstDiv.value = "Post Comment";
    } 

}







function removeComment(form)
{
	if (CheckLogin() == false)
		return false;

	if (!confirm("Really remove comment?"))
		return true;

	var formVars = new Array();
	for (var i = 0; i < form.elements.length; i++)
	{
		var formElement = form.elements[i];
		formVars[formElement.name] = formElement.value;
	}

	postUrl("comment_servlet",  urlEncodeDict(formVars), true, execOnSuccess(commentRemoved));

	var remove_btn = document.getElementById('remove_button_' + form.comment_id.value);
	remove_btn.value = "Removing comment...";
	remove_btn.disabled = true
	return true;
}
function commentRemoved(xmlHttpRequest)
{
	response_str = xmlHttpRequest.responseText;
	response_code = response_str.substr(0, response_str.indexOf(" "));
	form_id = response_str.substr(response_str.indexOf(" ")+1);
	
	if(response_code == "OK") {
		var comment_container = document.getElementById("container_comment_form_id_" + form_id);
		var remove_btn = document.getElementById('remove_button_' + form_id);
		remove_btn.value = "Comment Removed";
		return true;
	} else if (response_code == "LOGIN") {
            alert("An error occured while removing the comment. Please relogin and try again.");
	} else {
		alert("An error occured while removing the comment.");
	} 
}
		





function hideCommentReplyForm(form_id) {
	var div_id = "div_" + form_id;
	var reply_id = "reply_" + form_id;
	toggleVisibility(reply_id, true);
	toggleVisibility(div_id, false);
	//setInnerHTML(div_id, "");
}
