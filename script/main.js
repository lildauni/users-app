//show users in table
$(document).ready(function () {
  fetch();
});

//creating user
$(document).on("click", "#createUser", function (e) {
  e.preventDefault();
  let box=document.querySelector(".active-checkbox");
  let modal=document.querySelector(".user-window");
  let status="not-active";
  if(box.checked){
    status="active";
  }
  let data = {
    first_name: $("#first-name").val(),
    last_name: $("#last-name").val(),
    status: status,
    role: $("#role").val(),
  };
  $.ajax({
    url: "router/routes.php?action=createUser",
    type: "post",
    dataType: "json",
    data: data,
    success: function (data) {
      if(data.error){
        $(".response-message").html(data.error.message);
        return
      }
      modal.classList.remove("open");
      fetch();
      
      
    },
  });
});

//show creation form
$(document).on("click", "#add", function(e){
  e.preventDefault();
  let modal=document.querySelector(".user-window");
  $("form")[0].reset();
  $(".response-message").html("");
  let title="Add user";
  let btn=document.querySelector(".window-btn");
  btn.setAttribute("id", "createUser");
  modal.classList.add("open");
  $("#UserModalLabel").html(title);
  $("#button").html(btn);
});

//show edition form
$(document).on("click", "#edit", function(e){
  e.preventDefault();

  let modal=document.querySelector(".user-window");
  $(".response-message").html("");
  $("form")[0].reset();
  let edit_id=$(this).attr("value");
  let btn = document.querySelector(".window-btn");
  let box=document.querySelector(".active-checkbox");
  let title = "Edit user";
  btn.setAttribute("id", "editUser");
  btn.setAttribute("value", edit_id);
  $("#UserModalLabel").html(title);
  modal.classList.add("open");

  $.ajax({
    url:"router/routes.php?action=getUserById",
    type:"post",
    data:{
      id:edit_id
    },
    success:function(data){
      let a=JSON.parse(data);
      console.log(a.user[0].status);
      $("#first-name").val(a.user[0].first_name);
      $("#last-name").val(a.user[0].last_name);
      $('#role option[value='+a.user[0].role+']').prop('selected', true);
      if(a.user[0].status=="active"){
        box.checked=true;
      }
    }
  })
})

//editing user
$(document).on("click", "#editUser", function(e){
  e.preventDefault();

  let modal=document.querySelector(".user-window");
  let box=document.querySelector(".active-checkbox");
  let status="not-active";
  if(box.checked){
    status="active";
  }
  let data = {
    first_name: $("#first-name").val(),
    last_name: $("#last-name").val(),
    status: status,
    role: $("#role").val(),
    id: $("#editUser").attr("value")
  };
  
  $.ajax({
    url:"router/routes.php?action=editUser",
    type:"post",
    data:data,
    success:function(data){
      if(data.error){
        $(".response-message").html(data.error.message);
        return
      }
      modal.classList.remove("open");
      fetch();
    }
  })
})

//showing delete confirm
$(document).on("click", "#delete", function(e){
  e.preventDefault();
  let delete_id=$(this).attr("value");
  let modal=document.querySelector(".confirm-window");
  let btn=document.querySelector(".window-confirm");
  btn.setAttribute("id", delete_id);
  modal.classList.add("open");
  // $.ajax({
  //   url:"router/routes.php?action=deleteUsers",
  //   type:"post",
  //   data:{
  //     id:delete_id
  //   },
  //   success:function(data){
  //     fetch();
  //   }
  // });
});

//showing user function
function fetch(){
  $.ajax({
    url: "router/routes.php?action=getUsers",
    type: "post",
    data: {
    },
    success: function (response) {
      let data = JSON.parse(response);
      if(data.error){
        $(".result").html(data.error.message);
        return
      }
      let trStr = '';
      for (var i = 0; i < data.user.length ; i++) {
        trStr += '<tr>';
        trStr += '<td class="align-middle">';
        trStr += '<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">';
        trStr += '<input type="checkbox" class="custom-control-input user-checkbox" id="'+data.user[i].id+'">';
        trStr += '<label class="custom-control-label" for="'+data.user[i].id+'"></label>';
        trStr += '</div></td>';
        trStr += '<td class="text-nowrap align-middle">' + data.user[i].first_name + " " + data.user[i].last_name+'</td>';
        trStr += '<td class="text-nowrap align-middle"><span>' + data.user[i].role + '</span></td>';
        trStr += '<td class="text-center align-middle"><i class="fa fa-circle '+data.user[i].status+'-circle"></i></td>';
        trStr += '<td class="text-center align-middle">';
        trStr += '<div class="btn-group align-top">';
        trStr += '<button class="btn btn-sm btn-outline-secondary badge" id="edit" value='+data.user[i].id+' type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>';
        trStr += '<button class="btn btn-sm btn-outline-secondary badge" value='+data.user[i].id+' id="delete" type="button"><i class="fa fa-trash"></i></button>';
        trStr += ' </div></td>';
        trStr += '</tr>';
      }
      $("#tbody").html(trStr);
    },
  });
};

//checkboxes selection
$(document).on("click", ".user-checkbox", function(){
  let all=$(".user-checkbox").length;
  let checked=$(".user-checkbox:checked").length; 
  let check = (all>0 && all==checked);
  $(".main-checkbox").prop("checked", check);
})
$(document).on("click", ".main-checkbox", function(){
  $(".user-checkbox").prop("checked", this.checked);
});

//group actions
$(document).on("click", ".checkbox-action-1", function(){
  let confirm=document.querySelector(".confirm-window");
  let modal=document.querySelector(".message-window");
  let option=$(".option-select-1").val();
  let message;
  let box=document.querySelectorAll(".user-checkbox:checked");
  if(option=="Please select"){
    message="Choose option for group actions with users";
    $("#message").html(message);
    modal.classList.add("open");
    return
  }
  if(box.length==0){
    message="Choose users for group actions";
    $("#message").html(message);
    modal.classList.add("open");
    return
  }
  if(option=="deleteUsers"){
    confirm.classList.add("open");
    return
  }
  let id=[];
  for(let i=0;i<box.length;i++){
    id.push(box[i].id);
  }

  $.ajax({
    url:'router/routes.php?action='+option,
    type:"post",
    data:{
      id:id
    },
    success:function(data){
      fetch();
    }
  });
});

//group actions-2
$(document).on("click", ".checkbox-action-2", function(){
  let confirm=document.querySelector(".confirm-window");
  let modal=document.querySelector(".message-window"); 
  let option=$(".option-select-2").val();
  let box=document.querySelectorAll(".user-checkbox:checked");
  if(option=="Please select"){
    message="Choose option";
    $("#message").html(message);
    modal.classList.add("open");
    return
  }
  if(box.length==0){
    message="Choose user";
    $("#message").html(message);
    modal.classList.add("open");
    return
  }
  let id=[];
  for(let i=0;i<box.length;i++){
    id.push(box[i].id);
  }
  if(option=="deleteUsers"){
    confirm.classList.add("open");
    return
  }
  $.ajax({
    url:'router/routes.php?action='+option,
    type:"post",
    data:{
      id:id
    },
    success:function(data){
      fetch();
    }
  });
});

//delete users
$(document).on("click", ".window-confirm", function(){
  let box=document.querySelectorAll(".user-checkbox:checked");
  let modal=document.querySelector(".confirm-window");
  let btn=document.querySelector(".window-confirm");
  let id=[];
  if(btn.id){
    id.push(btn.id);
  }else{
    for(let i=0;i<box.length;i++){
      id.push(box[i].id);
    }
  }
  modal.classList.remove("open");
  $.ajax({
    url:'router/routes.php?action=deleteUsers',
    type:"post",
    data:{
      id:id
    },
    success:function(data){
      fetch();
    }
  });
});

//windows close
$(document).on("click", ".message-close", function(){
  let modal=document.querySelector(".message-window");
  modal.classList.remove("open");
});
$(document).on("click", ".confirm-close", function(){
  let modal=document.querySelector(".confirm-window");
  modal.classList.remove("open");
});
$(document).on("click", ".user-close", function(){
  let modal=document.querySelector(".user-window");
  modal.classList.remove("open");
});