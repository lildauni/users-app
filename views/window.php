<div class="user-window">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UserModalLabel"></h5>
                <button type="button" class="close user-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user-form">
                    <div class="form-group">
                        <label for="first-name" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control" id="first-name">
                    </div>
                    <div class="form-group">
                        <label for="last-name" class="col-form-label">Last Name:</label>
                        <input type="text" class="form-control" id="last-name">
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Status</label>
                        <div class="checkbox">
                            <input type="checkbox" class="active-checkbox" id="active-checkbox">
                            <label for="active-checkbox" class="dot-checkbox"></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-form-label">Role</label>
                        <select class="form-select" id="role" aria-label="Пример выбора по умолчанию">
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                    </div>
                    <input type="hidden" class="user_id">
                    <div class="response-message"></div>
                </form>
            </div>
            <div class="modal-footer" id="modal-footer">
                <button type="button" class="btn btn-secondary user-close">Close</button>
                <button type="button" class="btn window-btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>