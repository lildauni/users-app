//show users in table
$(document).ready(function () {
  $.get("router/routes.php?action=getUsers", function (result) {
    for (var i = 0; i < result.user.length; i++) {
      createRow(result.user[i]);
    }
  }, "json");
});

//show creation form
$(document).on("click", ".add", function (e) {
  e.preventDefault();
  let modal = document.querySelector(".user-window");
  $(".user-form").trigger("reset");
  $(".response-message").html("");
  let title = "Add user";
  let btn = document.querySelector(".window-btn");
  btn.setAttribute("id", "createUser");
  $(".user_id").val("");
  modal.classList.add("open");
  $("#UserModalLabel").html(title);
  $("#button").html(btn);
});

//show edition form
$(document).on("click", ".edit", function (e) {
  e.preventDefault();

  let form = document.querySelector(".user-window");
  let modal = document.querySelector(".message-window");
  $(".user-form").trigger("reset");
  let edit_id = $(this).attr("id");
  let box = document.querySelector(".active-checkbox");
  let title = "Edit user";
  let data = {
    id: edit_id,
  }
  $("#UserModalLabel").html(title);
  $.post("router/routes.php?action=getUserById", data, function (result) {
    if (result.error) {
      let tr = document.querySelector('tr[data-id="' + result.id + '"]');
      let first_name = tr.querySelector('.first_name');
      let last_name = tr.querySelector('.last_name');
      message = "User " + first_name.textContent + last_name.textContent + " does not exist";
      $(".message").html(message);
      modal.classList.add("open");
      return;
    }
    form.classList.add("open");
    $("#first-name").val(result.user.first_name);
    $("#last-name").val(result.user.last_name);
    $("#role option[value=" + result.user.role + "]").prop("selected", true);
    $(".user_id").val(result.user.id);
    if (result.user.status == 'true') {
      box.checked = true;
    }
  }, "json");
});

//user operations
$(document).on("click", ".window-btn", function (e) {
  e.preventDefault();

  let modal = document.querySelector(".user-window");
  let box = document.querySelector(".active-checkbox");
  let status = box.checked;
  let data = {
    first_name: $("#first-name").val(),
    last_name: $("#last-name").val(),
    status: status,
    role: $("#role").val(),
    id: $(".user_id").attr("value"),
  };
  if (data.id) {
    $.post("router/routes.php?action=editUser", data, function (result) {
      if (result.error) {
        $(".response-message").html(result.error.message);
        return;
      }
      modal.classList.remove("open");
      switch (result.user.role) {
        case '1':
          result.user.role = "Admin";
          break;
        case '2':
          result.user.role = "User";
          break;
      }
      let tr = document.querySelector('tr[data-id="' + result.user.id + '"]');
      let first_name = tr.querySelector(".first_name");
      first_name.innerHTML = result.user.first_name + " ";
      let last_name = tr.querySelector(".last_name");
      last_name.innerHTML = result.user.last_name;
      let role = tr.querySelector(".role");
      role.innerHTML = result.user.role;
      let status = tr.querySelector(".status");
      if (result.user.status == 'true') {
        status.classList.add("active");
      } else {
        status.classList.remove("active");
      }
    }, "json");
  }
  else {
    $.post("router/routes.php?action=createUser", data, function (result) {
      if (result.error) {
        $(".response-message").html(result.error.message);
        return;
      }
      modal.classList.remove("open");
      createRow(result.user);
      check();
    }, "json");
  }
})

//showing delete confirm
$(document).on("click", ".delete", function (e) {
  e.preventDefault();
  let delete_id = $(this).attr("id");
  let modal = document.querySelector(".confirm-window");
  let btn = document.querySelector(".window-confirm");
  btn.setAttribute("data-id", delete_id);
  btn.setAttribute("id", "delete-user");
  let tr = document.querySelector('tr[data-id="' + delete_id + '"]');
  let first_name = tr.querySelector('.first_name');
  let last_name = tr.querySelector('.last_name');
  message = "Are you sure you want to delete user " + first_name.textContent + last_name.textContent + "?";
  $(".delete-user").html(message);
  modal.classList.add("open");
});

//delete user
$(document).on("click", "#delete-user", function () {
  let id = $(this).attr("data-id");
  let modal = document.querySelector(".confirm-window");
  modal.classList.remove("open");
  let data = {
    id: id
  }
  $.post("router/routes.php?action=deleteUser", data, function (result) {
    let table = document.querySelector(".tbody");
    let tr = table.querySelector('tr[data-id="' + result.id + '"]');
    $(tr).remove();
    check();
  }, "json");
})


//checkboxes selection
$(document).on("click", ".user-checkbox", function () {
  check();
});
$(document).on("click", ".main-checkbox", function () {
  $(".user-checkbox").prop("checked", this.checked);
});

function check() {
  let all = $(".user-checkbox").length;
  let checked = $(".user-checkbox:checked").length;
  let check = all > 0 && all == checked;
  $(".main-checkbox").prop("checked", check);
}
function uncheck() {
  $(".user-checkbox").prop("checked", false);
  $(".main-checkbox").prop("checked", false);
}

//group actions
$(document).on("click", ".checkbox-action", function () {
  let confirm = document.querySelector(".confirm-window");
  let modal = document.querySelector(".message-window");
  let option = $(this).closest('.form').find(".option-select").val();
  let btn = document.querySelector(".window-confirm");
  let message;
  let box = document.querySelectorAll(".user-checkbox:checked");
  if (option == "Please select") {
    message = "Choose option for group actions with users";
    $(".message").html(message);
    modal.classList.add("open");
    return;
  }
  if (box.length == 0) {
    message = "Choose users for group actions";
    $(".message").html(message);
    modal.classList.add("open");
    return;
  }
  if (option == "deleteUsers") {
    if (box.length > 1) {
      message = "Are you sure you want to delete these users?";
      $(".delete-user").html(message);
    } else {
      let tr = document.querySelector('tr[data-id="' + box[0].id + '"]');
      let first_name = tr.querySelector('.first_name');
      let last_name = tr.querySelector('.last_name');
      message = "Are you sure you want to delete user " + first_name.textContent + last_name.textContent + "?";
      $(".delete-user").html(message);
    }
    btn.setAttribute("id", "delete-users");
    confirm.classList.add("open");
    return;
  }
  let id = "";
  for (let i = 0; i < box.length; i++) {
    id += box[i].id + ",";
  }
  let data = {
    id: id
  }

  $.post("router/routes.php?action=" + option, data, function (result) {
    if (data.error) {
      let tr = document.querySelector('tr[data-id="' + data.id + '"]');
      let first_name = tr.querySelector('.first_name');
      let last_name = tr.querySelector('.last_name');
      message = "User " + first_name.textContent + last_name.textContent + " does not exist";
      $(".message").html(message);
      modal.classList.add("open");
      return;
    }
    for (let i = 0; i < result.id.length; i++) {
      tr = document.querySelector('tr[data-id="' + result.id[i] + '"]');
      let status = tr.querySelector(".status");
      if (option == "activeUsers") {
        status.classList.add("active");
      }
      if (option == "unactiveUsers") {
        status.classList.remove("active");
      }
    }
    uncheck();
  }, "json");
});

//delete users
$(document).on("click", "#delete-users", function () {
  let box = document.querySelectorAll(".user-checkbox:checked");
  let modal = document.querySelector(".confirm-window");
  let btn = document.querySelector(".window-confirm");
  let id = "";
  if (box.length == 0) {
    id = btn.id;
  }
  for (let i = 0; i < box.length; i++) {
    id += box[i].id + ",";
  }
  data = {
    id: id
  }
  modal.classList.remove("open");
  $.post("router/routes.php?action=deleteUsers", data, function (result) {
    let table = document.querySelector(".tbody");
    let tr = "";
    for (let i = 0; i < result.id.length; i++) {
      tr = table.querySelector('tr[data-id="' + result.id[i] + '"]');
      $(tr).remove();
    }
    uncheck();
  }, "json");
});

//windows close
$(document).on("click", ".message-close", function () {
  let modal = document.querySelector(".message-window");
  modal.classList.remove("open");
});
$(document).on("click", ".confirm-close", function () {
  let modal = document.querySelector(".confirm-window");
  modal.classList.remove("open");
});
$(document).on("click", ".user-close", function () {
  let modal = document.querySelector(".user-window");
  modal.classList.remove("open");
});

function createRow(data) {
  let tr = document.createElement("tr");
  let tdCheckbox = document.createElement("td");
  let tdName = document.createElement("td");
  let tdRole = document.createElement("td");
  let tdStatus = document.createElement("td");
  let tdButtons = document.createElement("td");
  let status = document.createElement("div");

  tr.setAttribute("data-id", data.id);
  tdCheckbox.classList.add("align-middle");
  tdName.classList.add("text-nowrap", "align-middle");
  tdRole.classList.add("text-nowrap", "align-middle");
  tdStatus.classList.add("text-center", "align-middle");
  tdButtons.classList.add("text-center", "align-middle");
  status.classList.add("status");
  if (data.status == 'true') {
    status.classList.add("active");
  }
  switch (data.role) {
    case '1':
      data.role = "Admin";
      break;
    case '2':
      data.role = "User";
      break;
  }
  str = '<div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">';
  str += '<input type="checkbox" class="custom-control-input user-checkbox" id="' + data.id + '">';
  str += '<label class="custom-control-label" for="' + data.id + '"></label></div>';
  tdCheckbox.innerHTML = str;
  tr.appendChild(tdCheckbox);

  tdName.innerHTML = '<span class="first_name">' + data.first_name + ' </span><span class="last_name">' + data.last_name + "";
  tr.appendChild(tdName);

  tdRole.innerHTML = '<span class="role">' + data.role + "</span>";
  tr.appendChild(tdRole);

  status.innerHTML = '<i class="fa fa-circle status-circle"></i></td>';
  tdStatus.appendChild(status);
  tr.appendChild(tdStatus);

  str = '<div class="btn-group align-top">';
  str += '<button class="btn btn-sm btn-outline-secondary badge edit" id=' + data.id + ' type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>';
  str += '<button class="btn btn-sm btn-outline-secondary badge delete" id=' + data.id + ' type="button"><i class="fa fa-trash"></i></button></div>';
  tdButtons.innerHTML = str;
  tr.appendChild(tdButtons);

  $(".tbody").append(tr);
}