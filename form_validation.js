$('document').ready(function() {
(function() {
$('form').ajaxForm({
beforeSubmit: function() {
$("#email-form").validate({
rules: {
u_name: {
required: true,
minlength : 3
},
u_email: {
required: true,
email: true
},
attach: {
required: true
},
message: {
required: true
}
},
messages: {
u_name: {
required:"Please enter name",
minlength: "Please enter a valid name"
},
u_email:{
required: "Please enter your email",
minlength: "Please enter a valid email address",
},
attach: "Please Choose CV",
message: "Please enter message"
},
});
var flag= $('#email-form').valid();
if(!flag){
return false;
}
},
complete: function(xhr) {
$("#email-form").addClass("hidden");
$("#success_message").removeClass("hidden");
}
});
})();
});